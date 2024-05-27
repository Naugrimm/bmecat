<?php


namespace Naugrim\BMEcat\Nodes\Product;

use /** @noinspection PhpUnusedAliasInspection */
    JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Nodes\Contracts;

/**
 *
 * @Serializer\XmlRoot("FEATURE")
 */
class Feature implements Contracts\NodeInterface
{
    /**
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("FNAME")
     *
     * @var string
     */
    protected $name;

    /**
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("VARIANTS")
     * @Serializer\SkipWhenEmpty
     * @Serializer\Exclude(if="methodResultIsset(object, 'getValue')")
     *
     * @var string
     */
    protected $variants;

    /**
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("FVALUE")
     * @Serializer\Exclude(if="methodResultIsset(object, 'getVariants')")
     *
     * @var string
     */
    protected $value;

    /**
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("FUNIT")
     *
     * @var string
     */
    protected $unit;

    /**
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("FORDER")
     *
     * @var string
     */
    protected $order;

    /**
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("FDESCR")
     *
     * @var string
     */
    protected $description;

    /**
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("FVALUE_DETAILS")
     *
     * @var string
     */
    protected $valueDetails;

    /**
     * @param mixed $name
     * @return Feature
     */
    public function setName($name) : Feature
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param string $variants
     * @return Feature
     */
    public function setVariants($variants) : Feature
    {
        $this->variants = $variants;
        return $this;
    }

    /**
     * @param string $value
     * @return Feature
     */
    public function setValue($value) : Feature
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @param string $unit
     * @return Feature
     */
    public function setUnit($unit) : Feature
    {
        $this->unit = $unit;
        return $this;
    }

    /**
     * @param string $order
     * @return Feature
     */
    public function setOrder($order) : Feature
    {
        $this->order = $order;
        return $this;
    }

    /**
     * @param string $description
     * @return Feature
     */
    public function setDescription($description) : Feature
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @param string $valueDetails
     * @return Feature
     */
    public function setValueDetails($valueDetails) : Feature
    {
        $this->valueDetails = $valueDetails;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getVariants()
    {
        return $this->variants;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * @return string
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getValueDetails()
    {
        return $this->valueDetails;
    }
}
