<?php

namespace Naugrim\BMEcat\Nodes;

use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Nodes\Concerns\HasStringValue;
use Naugrim\BMEcat\Nodes\Concerns\HasTypeAttribute;
use Naugrim\BMEcat\Nodes\Contracts\NodeInterface;

class Fax implements NodeInterface
{
    use HasTypeAttribute;
    use HasStringValue;
}
