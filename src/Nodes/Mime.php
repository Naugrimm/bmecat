<?php

namespace Naugrim\BMEcat\Nodes;

use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Nodes\Contracts\NodeInterface;

/**
 * @implements NodeInterface<self>
 * @method self setType(string|null $type)
 * @method string|null getType()
 * @method self setSource(string $source)
 * @method string getSource()
 * @method self setDescription(string|null $description)
 * @method string|null getDescription()
 * @method self setAlt(string|null $alt)
 * @method string|null getAlt()
 * @method self setPurpose(string|null $purpose)
 * @method string|null getPurpose()
 * @method self setOrder(int|null $order)
 * @method int|null getOrder()
 */
#[Serializer\XmlRoot('MIME')]
class Mime implements Contracts\NodeInterface
{
    use \Naugrim\BMEcat\Nodes\Concerns\HasSerializableAttributes;
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('MIME_TYPE')]
    protected ?string $type = null;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('MIME_SOURCE')]
    protected string $source;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('MIME_DESCR')]
    protected ?string $description = null;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('MIME_ALT')]
    protected ?string $alt = null;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('MIME_PURPOSE')]
    #[Serializer\XmlElement(cdata: false)]
    protected ?string $purpose = null;

    #[Serializer\Expose]
    #[Serializer\Type('int')]
    #[Serializer\SerializedName('MIME_ORDER')]
    #[Serializer\XmlElement(cdata: false)]
    protected ?int $order = null;
}
