<?php

namespace Naugrim\BMEcat\Nodes\Product;

use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Nodes\Contracts;

/**
 *
 * @Serializer\XmlRoot("KEYWORD")
 */
class Keyword implements Contracts\NodeInterface
{
    /**
     * @Serializer\Type("string")
     * @Serializer\XmlValue
     *
     * @var string
     */
    protected $value = '';

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $value
     * @return Keyword
     */
    public function setValue($value) : Keyword
    {
        $this->value = $value;
        return $this;
    }
}
