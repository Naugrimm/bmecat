<?php

namespace Naugrim\BMEcat\Nodes;

use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Nodes\Contracts\NodeInterface;
use Naugrim\BMEcat\Nodes\Concerns\HasStringValue;
use Naugrim\BMEcat\Nodes\Concerns\HasTypeAttribute;

/**
 * @implements NodeInterface<self>
 */
class InternationalPid implements NodeInterface
{
    /**
     * @use HasTypeAttribute<self>
     */
    use HasTypeAttribute;

    /**
     * @use HasStringValue<self>
     */
    use HasStringValue;
}
