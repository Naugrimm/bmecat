<?php

namespace Naugrim\BMEcat\Nodes;

use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Nodes\Contracts\NodeInterface;

/**
 * @implements NodeInterface<self>
 */
#[Serializer\XmlRoot('SPECIAL_TREATMENT_CLASS')]
class SpecialTreatmentClass implements Contracts\NodeInterface
{
    use \Naugrim\BMEcat\Nodes\Concerns\HasSerializableAttributes;
    #[Serializer\Type('string')]
    #[Serializer\XmlAttribute]
    private string $type = '';

    #[Serializer\Type('string')]
    #[Serializer\XmlValue]
    protected string $value = '';
}
