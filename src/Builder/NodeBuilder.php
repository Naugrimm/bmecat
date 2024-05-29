<?php

namespace Naugrim\BMEcat\Builder;

use Naugrim\BMEcat\Exception\InvalidSetterException;
use Naugrim\BMEcat\Exception\UnknownKeyException;
use Naugrim\BMEcat\Nodes\Contracts\NodeInterface;
use Naugrim\BMEcat\Tests\Fixtures\Node\Node;
use ReflectionClass;
use ReflectionException;
use ReflectionMethod;
use ReflectionNamedType;

class NodeBuilder
{
    /**
     * @template TNode of NodeInterface
     * @param array<string, mixed> $data
     * @param TNode|class-string<TNode> $instance
     * @return TNode
     * @throws InvalidSetterException
     * @throws UnknownKeyException
     */
    public static function fromArray(array $data, NodeInterface|string $instance): NodeInterface
    {
        if (is_string($instance)) {
            $instance = new $instance;
        }

        foreach ($data as $name => $value) {
            $setterName = 'set' . ucfirst($name);
            if (! method_exists($instance, $setterName)) {
                throw new UnknownKeyException(
                    'There is no setter for the property ' . $name . ' in the class ' . $instance::class
                );
            }

            if (is_scalar($value) || is_object($value)) {
                $instance->{$setterName}($value); //@phpstan-ignore method.dynamicName
                continue;
            }

            // if the value is an array, try to recursively construct the object

            try {
                $reflectionMethod = new ReflectionMethod($instance, $setterName);
                $setterParams = $reflectionMethod->getParameters();
                // @codeCoverageIgnoreStart
            } catch (ReflectionException) {
                throw new InvalidSetterException(
                    'Reflecting the setter method ' . $instance::class . '::' . $setterName . ' failed.'
                );
            }

            // @codeCoverageIgnoreEnd
            $firstSetterParam = array_shift($setterParams);
            if ($firstSetterParam === null) {
                throw new InvalidSetterException(
                    'The setter for the property ' . $name . ' in the class ' . $instance::class . ' must have exactly one argument.'
                );
            }

            if ($firstSetterParam->getType() === null) {
                throw new InvalidSetterException(
                    'The setter for the property ' . $name . ' in the class ' . $instance::class . ' must have exactly one argument and this argument must have a type hint.'
                );
            }

            if (! $firstSetterParam->getType() instanceof ReflectionNamedType) {
                throw new InvalidSetterException(
                    'The type hint for the setter for the property ' . $name . ' in the class ' . $instance::class . ' cannot be parsed.'
                );
            }

            $paramType = $firstSetterParam->getType()
                ->getName();

            if ($paramType === 'self') {
                $paramType = $instance::class;
            }

            if ($firstSetterParam->getType()->isBuiltin() || ! class_exists($paramType)) {
                $instance->{$setterName}($value); //@phpstan-ignore method.dynamicName
                continue;
            }

            $paramClassReflection = new ReflectionClass($paramType);

            /**
             * when we type hint another NodeInterface here we MUST pass an array with the child nodes properties
             */
            $paramClass = $paramClassReflection->newInstance();
            if ($paramClass instanceof NodeInterface && is_array($value)) {
                $value = self::fromArray($value, $paramClass);
                $instance->{$setterName}($value); //@phpstan-ignore method.dynamicName
            }

            /**
             * in all other cases we try to set the value directly and let the type system fail if there are any errors
             */
            $instance->{$setterName}($value); //@phpstan-ignore method.dynamicName
        }

        return $instance;
    }
}
