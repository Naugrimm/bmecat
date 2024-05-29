<?php

namespace Naugrim\BMEcat\Nodes;

use Naugrim\BMEcat\Nodes\Concerns\HasStringValue;
use Naugrim\BMEcat\Nodes\Concerns\HasTypeAttribute;
use Naugrim\BMEcat\Nodes\Contracts\NodeInterface;

/**
 * @implements NodeInterface<self>
 */
class Fax implements NodeInterface
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
