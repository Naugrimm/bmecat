<?php

namespace Naugrim\BMEcat\Nodes\Product;

use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Nodes\Contracts;
use Naugrim\BMEcat\Nodes\Contracts\NodeInterface;

/**
 * @implements NodeInterface<self>
 */
#[Serializer\XmlRoot('PRODUCT_STATUS')]
class Status implements Contracts\NodeInterface
{
    /**
     *
     * @var string
     */
    #[Serializer\Type('string')]
    #[Serializer\XmlAttribute]
    protected string $type = '';

    /**
     *
     * @var string
     */
    #[Serializer\XmlValue]
    #[Serializer\Type('string')]
    protected string $value = '';

    /**
     * @param string $type
     * @return Status
     */
    public function setType(string $type) : Status
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     * @return Status
     */
    public function setValue(string $value): Status
    {
        $this->value = $value;
        return $this;
    }
}
