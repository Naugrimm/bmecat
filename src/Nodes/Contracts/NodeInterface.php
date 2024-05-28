<?php


namespace Naugrim\BMEcat\Nodes\Contracts;

use JMS\Serializer\Annotation as Serializer;

#[Serializer\ExclusionPolicy('all')]
interface NodeInterface
{
}
