<?php

declare(strict_types=1);

namespace Naugrim\BMEcat\Nodes\Concerns;

use DateTime;
use DateTimeInterface;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Type;
use Naugrim\BMEcat\Builder\NodeBuilder;
use Naugrim\BMEcat\Exception\InvalidSetterException;
use Naugrim\BMEcat\Exception\UnknownKeyException;
use Naugrim\BMEcat\Nodes\Contracts\NodeInterface;
use ReflectionClass;
use ReflectionException;
use ReflectionProperty;
use RuntimeException;

trait HasSerializableAttributes
{
    /**
     * @param string $name
     * @param mixed[] $arguments
     * @return ($arguments is empty ? mixed : self)
     * @throws InvalidSetterException
     * @throws UnknownKeyException
     */
    public function __call(string $name, array $arguments): mixed
    {
        if (! str_starts_with($name, 'get') && ! str_starts_with($name, 'set')) {
            throw new RuntimeException(
                'Invalid method called: ' . $name . '. We only support dynamically calling get* and set* methods here'
            );
        }

        $propertyName = lcfirst(substr($name, 3));

        $property = $this->getSerializableAttribute($propertyName);
        if ($property === null) {
            throw new UnknownKeyException('There is no serializable attribute with the name ' . $this::class.'::'.$propertyName);
        }

        if (str_starts_with($name, 'get') && property_exists($this, $propertyName)) {
            return $this->{$propertyName}; // @phpstan-ignore property.dynamicName
        } elseif (str_starts_with($name, 'set')) {
            $valueToSet = $arguments[0];

            $type = $this->getTypeAnnotationFromProperty($property);
            if (str_starts_with($type, 'DateTimeInterface') || str_starts_with($type, '\DateTimeInterface')) {
                return $this->handleDateTimeInterfaceSetter($propertyName, $type, $valueToSet);
            }

            if (is_scalar($valueToSet) || $valueToSet instanceof NodeInterface) {
                /**
                 * the value to set is either a scalar or already a NodeInterface
                 * in both cases, we assign it directly to the property. PHP will complain
                 * if the wrong type is assigned
                 */
                $this->{$propertyName} = $valueToSet; // @phpstan-ignore property.dynamicName
                return $this;
            }

            if (str_starts_with($type, 'array') && is_array($valueToSet)) {
                return $this->handleArraySetter($propertyName, $type, $valueToSet);
            }

            if (! $this->typeAnnotationImplementsNodeInterface($type)) {
                $this->{$propertyName} = $valueToSet; // @phpstan-ignore property.dynamicName
                return $this;
            }

            if (!is_array($valueToSet)) {
                $this->{$propertyName} = $valueToSet; // @phpstan-ignore property.dynamicName
                return $this;
            }

            $this->{$propertyName} = NodeBuilder::fromArray($valueToSet, $type); // @phpstan-ignore property.dynamicName
            return $this;
        }

        throw new RuntimeException(
            'Invalid method called: ' . $name . '. We only support dynamically calling get* and set* methods here'
        );
    }

    /**
     * @param mixed[] $valueToSet
     * @throws InvalidSetterException
     * @throws UnknownKeyException
     */
    private function handleArraySetter(string $propertyName, string $type, array $valueToSet) : static
    {
        if (preg_match('/^array<(?<itemType>.*)>$/', $type, $matches) !== 1) {
            /**
             * no type was given in the array. set the value directly
             */
            $this->{$propertyName} = $valueToSet; // @phpstan-ignore property.dynamicName
            return $this;
        }

        $newValues = [];

        $itemType = $matches['itemType'];
        if (str_contains($itemType, '\\') && !str_starts_with($itemType, '\\')) {
            $itemType = '\\'.$itemType;
        }

        foreach ($valueToSet as $singleValueToSet) {
            if (is_scalar($singleValueToSet) || $singleValueToSet instanceof NodeInterface) {
                $newValues[] = $singleValueToSet;
                continue;
            }

            if (! $this->typeAnnotationImplementsNodeInterface($itemType)) {
                $newValues[] = $singleValueToSet;
                continue;
            }

            if (! is_array($singleValueToSet)) {
                $newValues[] = $singleValueToSet;
                continue;
            }

            $newValues[] = NodeBuilder::fromArray($singleValueToSet, $itemType);
        }

        $this->{$propertyName} = $newValues; // @phpstan-ignore property.dynamicName

        return $this;
    }

    private function handleDateTimeInterfaceSetter(string $propertyName, string $type, string|DateTimeInterface $valueToSet) : static
    {
        if ($valueToSet instanceof DateTimeInterface) {
            $this->{$propertyName} = DateTime::createFromInterface($valueToSet); // @phpstan-ignore property.dynamicName
            return $this;
        }

        if (preg_match("/^\\\\?DateTimeInterface<'(?<format>.+)'>$/", $type, $matches) !== 1) {
            /**
             * no format was given, try to set the date directly
             */
            $this->{$propertyName} = new DateTime($valueToSet); // @phpstan-ignore property.dynamicName
            return $this;
        }

        $this->{$propertyName} = DateTime::createFromFormat($matches['format'], $valueToSet); // @phpstan-ignore property.dynamicName
        return $this;
    }

    private function getTypeAnnotationFromProperty(ReflectionProperty $property) : string
    {
        $typeAttribute = $property->getAttributes(Type::class)[0];
        $typeName = $typeAttribute->newInstance()->name;
        if ($typeName === null) {
            throw new RuntimeException('Could not get the type '.Type::class.' for the property '.$property->name);
        }

        return $typeName;
    }

    /**
     * @template T
     * @return ($type is class-string<NodeInterface<T>> ? true : false)
     */
    private function typeAnnotationImplementsNodeInterface(string $type) : bool
    {
        $implements = class_implements($type);
        if ($implements === false) {
            return false;
        }

        return in_array(
            NodeInterface::class,
            $implements,
            true
        );
    }

    private function getSerializableAttribute(string $name): ?ReflectionProperty
    {
        $reflection = new ReflectionClass($this);

        try {
            $property = $reflection->getProperty($name);
        } catch (ReflectionException) {
            return null;
        }

        /**
         * we need to expose this attribute during serialization to handle it here
         */
        if (count($property->getAttributes(Expose::class)) !== 1) {
            return null;
        }

        /**
         * the attribute must have a type hint to handle it here
         */
        if ($property->getType() === null) {
            return null;
        }

        /**
         * we must have a type attribute to handle it here
         */
        if (count($property->getAttributes(Type::class)) !== 1) {
            return null;
        }

        return $property;
    }
}
