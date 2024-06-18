<?php

namespace Naugrim\BMEcat\Nodes;

use Naugrim\BMEcat\Nodes\Concerns\HasStringValue;
use Naugrim\BMEcat\Nodes\Contracts\NodeInterface;

/**
 * @implements NodeInterface<self>
 * @method self setValue(string $value)
 * @method string getValue()
 */
class Email implements NodeInterface
{
    use \Naugrim\BMEcat\Nodes\Concerns\HasSerializableAttributes;
    /**
     * @use HasStringValue<self>
     */
    use HasStringValue;
}
