<?php

namespace Naugrim\BMEcat\Nodes\Product;

use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Nodes\Contracts;

/**
 *
 * @Serializer\XmlRoot("PRODUCT_STATUS")
 */
class Status implements Contracts\NodeInterface
{
    /**
     * @Serializer\Type("string")
     * @Serializer\XmlAttribute
     *
     * @var string
     */
    protected $type = '';

    /**
     * @Serializer\XmlValue
     * @Serializer\Type("string")
     *
     * @var string
     */
    protected $value = '';

    /**
     * @param string $type
     * @return Status
     */
    public function setType($type) : Status
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getType()
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
