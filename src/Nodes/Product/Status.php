<?php

namespace Naugrim\BMEcat\Nodes\Product;

use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Nodes\Contracts;
use Naugrim\BMEcat\Nodes\Contracts\NodeInterface;

/**
 * @implements NodeInterface<self>
 * @method self setType(string $type)
 * @method string getType()
 * @method self setValue(string $value)
 * @method string getValue()
 */
#[Serializer\XmlRoot('PRODUCT_STATUS')]
class Status implements Contracts\NodeInterface
{
    use \Naugrim\BMEcat\Nodes\Concerns\HasSerializableAttributes;
    #[Serializer\Type('string')]
    #[Serializer\XmlAttribute]
    protected string $type = '';

    #[Serializer\XmlValue]
    #[Serializer\Type('string')]
    protected string $value = '';
}
