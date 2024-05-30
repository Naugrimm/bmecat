<?php

namespace Naugrim\BMEcat\Tests\Fixtures\Node;

use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Nodes\Contracts\NodeInterface;

/**
 * @implements NodeInterface<self>
 */
class Node implements NodeInterface
{
    use \Naugrim\BMEcat\Nodes\Concerns\HasSerializableAttributes;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    public string $someString;

    /**
     * @var string[]
     */
    #[Serializer\Expose]
    #[Serializer\Type('array<string>')]
    public array $someArray;

    #[Serializer\Expose]
    #[Serializer\Type(Node::class)]
    public Node $anotherNode;

    #[Serializer\Expose]
    #[Serializer\Type('array<float>')]
    public float $someFloat;
}
