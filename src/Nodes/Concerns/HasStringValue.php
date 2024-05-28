<?php

namespace Naugrim\BMEcat\Nodes\Concerns;

use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Nodes\Contracts\NodeInterface;

/**
 * @template TNode of NodeInterface
 */
trait HasStringValue
{
    #[Serializer\XmlValue]
    #[Serializer\Type('string')]
    protected string $value = '';

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     * @return NodeInterface<TNode>
     */
    public function setValue(string $value): NodeInterface
    {
        $this->value = $value;
        return $this;
    }
}
