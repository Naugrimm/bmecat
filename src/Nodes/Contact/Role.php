<?php

namespace Naugrim\BMEcat\Nodes\Contact;

use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Nodes\Concerns\HasStringValue;
use Naugrim\BMEcat\Nodes\Concerns\HasTypeAttribute;
use Naugrim\BMEcat\Nodes\Contracts\NodeInterface;

class Role implements NodeInterface
{
    use HasTypeAttribute, HasStringValue;
}
