<?php

namespace Naugrim\BMEcat\Nodes\Product;

use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Nodes\Contracts;
use Naugrim\BMEcat\Nodes\Contracts\NodeInterface;

/**
 * @implements NodeInterface<self>
 */
#[Serializer\XmlRoot('KEYWORD')]
class Keyword implements Contracts\NodeInterface
{
    /**
     *
     * @var string
     */
    #[Serializer\Type('string')]
    #[Serializer\XmlValue]
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
     * @return Keyword
     */
    public function setValue(string $value) : Keyword
    {
        $this->value = $value;
        return $this;
    }
}
