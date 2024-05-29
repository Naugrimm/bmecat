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
    #[Serializer\Type('string')]
    #[Serializer\XmlAttribute]
    private string $type = '';

    #[Serializer\Type('string')]
    #[Serializer\XmlValue]
    protected string $value = '';

    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function setValue(string $value): self
    {
        $this->value = $value;
        return $this;
    }
}
