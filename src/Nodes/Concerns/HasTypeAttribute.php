<?php

namespace Naugrim\BMEcat\Nodes\Concerns;

use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Nodes\Contracts\NodeInterface;

/**
 * @template TNode of NodeInterface
 */
trait HasTypeAttribute
{
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('type')]
    #[Serializer\XmlAttribute]
    protected string $type;

    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return NodeInterface<TNode>
     */
    public function setType(string $type): NodeInterface
    {
        $this->type = $type;
        return $this;
    }
}
