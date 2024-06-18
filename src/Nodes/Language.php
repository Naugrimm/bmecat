<?php

namespace Naugrim\BMEcat\Nodes;

use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Nodes\Concerns\HasStringValue;
use Naugrim\BMEcat\Nodes\Contracts\NodeInterface;

/**
 * @implements NodeInterface<self>
 * @method self setValue(string $value)
 * @method string getValue()
 * @method self setType(bool|null $type)
 * @method bool|null getType()
 */
class Language implements NodeInterface
{
    use \Naugrim\BMEcat\Nodes\Concerns\HasSerializableAttributes;

    /**
     * @use HasStringValue<self>
     */
    use HasStringValue;

    #[Serializer\Expose]
    #[Serializer\Type('bool')]
    #[Serializer\SerializedName('default')]
    #[Serializer\XmlAttribute]
    protected ?bool $type = null;
}
