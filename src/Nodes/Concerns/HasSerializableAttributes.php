<?php

declare(strict_types=1);

namespace Naugrim\BMEcat\Nodes\Concerns;

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
            throw new RuntimeException('There is no serializable attribute with the name: ' . $propertyName);
        }

        if (str_starts_with($name, 'get') && property_exists($this, $propertyName)) {
            return $this->{$propertyName}; // @phpstan-ignore property.dynamicName
        } elseif (str_starts_with($name, 'set')) {
            $valueToSet = $arguments[0];

            if (is_scalar($valueToSet) || $valueToSet instanceof NodeInterface) {
                $this->{$propertyName} = $valueToSet; // @phpstan-ignore property.dynamicName
                return $this;
            }

            $type = $this->getTypeAnnotationFromProperty($property);

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
        } catch (ReflectionException $e) {
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
