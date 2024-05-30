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
            $instance->{$setterName}($value); // @phpstan-ignore method.dynamicName
        }

        return $instance;
    }
}
