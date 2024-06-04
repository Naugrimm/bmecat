<?php

namespace Naugrim\BMEcat\Nodes\Logistic;

use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Nodes\Concerns\HasSerializableAttributes;
use Naugrim\BMEcat\Nodes\Contracts\NodeInterface;

/**
 * @implements NodeInterface<Transport>
 * @method self setIncoterm(string $incoterm)
 * @method string getIncoterm()
 * @method self setLocation(string|null $location)
 * @method string|null getLocation()
 * @method self setTransportRemark(string|null $transportRemark)
 * @method string|null getTransportRemark()
 */
final class Transport implements NodeInterface
{
    use HasSerializableAttributes;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('INCOTERM')]
    protected string $incoterm;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('LOCATION')]
    protected ?string $location = null;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('TRANSPORT_REMARK')]
    protected ?string $transportRemark = null;
}
