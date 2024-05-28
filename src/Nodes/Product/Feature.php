<?php


namespace Naugrim\BMEcat\Nodes\Product;

use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Nodes\Contracts;


#[Serializer\XmlRoot('FEATURE')]
class Feature implements Contracts\NodeInterface
{
    /**
     *
     * @var string
     */
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('FNAME')]
    protected string $name;

    /**
     *
     * @var string
     */
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('VARIANTS')]
    #[Serializer\SkipWhenEmpty]
    #[Serializer\Exclude(if: "methodResultIsset(object, 'getValue')")]
    protected string $variants;

    /**
     *
     * @var string
     */
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('FVALUE')]
    #[Serializer\Exclude(if: "methodResultIsset(object, 'getVariants')")]
    protected string $value;

    /**
     *
     * @var string
     */
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('FUNIT')]
    protected string $unit;

    /**
     *
     * @var string
     */
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('FORDER')]
    protected string $order;

    /**
     *
     * @var string
     */
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('FDESCR')]
    protected string $description;

    /**
     *
     * @var string
     */
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('FVALUE_DETAILS')]
    protected string $valueDetails;

    /**
     * @return Feature
     */
    public function setName(mixed $name) : Feature
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param string $variants
     * @return Feature
     */
    public function setVariants(string $variants) : Feature
    {
        $this->variants = $variants;
        return $this;
    }

    /**
     * @param string $value
     * @return Feature
     */
    public function setValue(string $value) : Feature
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @param string $unit
     * @return Feature
     */
    public function setUnit(string $unit) : Feature
    {
        $this->unit = $unit;
        return $this;
    }

    /**
     * @param string $order
     * @return Feature
     */
    public function setOrder(string $order) : Feature
    {
        $this->order = $order;
        return $this;
    }

    /**
     * @param string $description
     * @return Feature
     */
    public function setDescription(string $description) : Feature
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @param string $valueDetails
     * @return Feature
     */
    public function setValueDetails(string $valueDetails) : Feature
    {
        $this->valueDetails = $valueDetails;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getVariants(): string
    {
        return $this->variants;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function getUnit(): string
    {
        return $this->unit;
    }

    /**
     * @return string
     */
    public function getOrder(): string
    {
        return $this->order;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getValueDetails(): string
    {
        return $this->valueDetails;
    }
}
