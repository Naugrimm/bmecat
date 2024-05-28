<?php

namespace Naugrim\BMEcat\Nodes;

use JMS\Serializer\Annotation as Serializer;

/**
 *
 * @Serializer\XmlRoot("SPECIAL_TREATMENT_CLASS")
 */
class SpecialTreatmentClass implements Contracts\NodeInterface
{
    /**
     * @Serializer\Type("string")
     * @Serializer\XmlAttribute
     *
     * @var string
     */
    private $type = '';

    /**
     * @Serializer\Type("string")
     * @Serializer\XmlValue
     *
     * @var string
     */
    protected $value = '';

    /**
     * @param string $type
     * @return SpecialTreatmentClass
     */
    public function setType($type) : SpecialTreatmentClass
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     * @return SpecialTreatmentClass
     */
    public function setValue(string $value): SpecialTreatmentClass
    {
        $this->value = $value;
        return $this;
    }
}
