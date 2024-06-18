<?php

namespace Naugrim\BMEcat\Nodes\Contact;

use Naugrim\BMEcat\Nodes\Concerns\HasStringValue;
use Naugrim\BMEcat\Nodes\Concerns\HasTypeAttribute;
use Naugrim\BMEcat\Nodes\Contracts\NodeInterface;

/**
 * @implements NodeInterface<self>
 * @method self setType(string $type)
 * @method string getType()
 * @method self setValue(string $value)
 * @method string getValue()
 */
class Role implements NodeInterface
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
