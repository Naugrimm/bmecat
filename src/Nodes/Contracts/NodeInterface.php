<?php

namespace Naugrim\BMEcat\Nodes\Contracts;

use JMS\Serializer\Annotation as Serializer;

/**
 * @template TNode
 */
#[Serializer\ExclusionPolicy('all')]
interface NodeInterface
{
}
