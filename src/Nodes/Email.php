<?php

namespace Naugrim\BMEcat\Nodes;

use Naugrim\BMEcat\Nodes\Concerns\HasStringValue;
use Naugrim\BMEcat\Nodes\Contracts\NodeInterface;

/**
 * @implements NodeInterface<self>
 */
class Email implements NodeInterface
{
    /**
     * @use HasStringValue<self>
     */
    use HasStringValue;
}
