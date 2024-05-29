<?php

namespace Naugrim\BMEcat\Nodes;

use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Nodes\Concerns\HasStringValue;
use Naugrim\BMEcat\Nodes\Concerns\HasTypeAttribute;
use Naugrim\BMEcat\Nodes\Contracts\NodeInterface;

/**
 * @implements NodeInterface<self>
 */
#[Serializer\XmlRoot('BUYER_PID')]
class BuyerPid implements NodeInterface
{
    use \Naugrim\BMEcat\Nodes\Concerns\HasSerializableAttributes;
    /**
     * @use HasTypeAttribute<self>
     */
    use HasTypeAttribute;

    /**
     * @use HasStringValue<self>
     */
    use HasStringValue;
}
