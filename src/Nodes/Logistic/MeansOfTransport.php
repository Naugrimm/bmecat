<?php

namespace Naugrim\BMEcat\Nodes;

use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Nodes\Concerns\HasSerializableAttributes;
use Naugrim\BMEcat\Nodes\Concerns\HasTypeAttribute;
use Naugrim\BMEcat\Nodes\Contracts\NodeInterface;

/**
 * @implements NodeInterface<self>
 */
final class MeansOfTransport implements NodeInterface
{
    use HasSerializableAttributes;

    /**
     * @use HasTypeAttribute<self>
     */
    use HasTypeAttribute;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('MEANS_OF_TRANSPORT_ID')]
    protected ?string $id = null;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('MEANS_OF_TRANSPORT_NAME')]
    protected ?string $name = null;
}
