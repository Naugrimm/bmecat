<?php

namespace Naugrim\BMEcat\Nodes\Product;

use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Nodes\Contracts;
use Naugrim\BMEcat\Nodes\Contracts\NodeInterface;

/**
 * @implements NodeInterface<self>
 * @method self setValue(string $value)
 * @method string getValue()
 */
#[Serializer\XmlRoot('KEYWORD')]
class Keyword implements Contracts\NodeInterface
{
    use \Naugrim\BMEcat\Nodes\Concerns\HasSerializableAttributes;

    #[Serializer\Type('string')]
    #[Serializer\Expose]
    #[Serializer\XmlValue]
    protected string $value = '';
}
