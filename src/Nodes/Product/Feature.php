<?php


namespace Naugrim\BMEcat\Nodes\Product;

use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Nodes\Contracts;
use Naugrim\BMEcat\Nodes\Contracts\NodeInterface;

/**
 * @implements NodeInterface<self>
 */
#[Serializer\XmlRoot('FEATURE')]
class Feature implements Contracts\NodeInterface
{

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('FNAME')]
    protected string $name;

    /**
     * @var string[]
     */
    #[Serializer\Expose]
    #[Serializer\Type('array<string>')]
    #[Serializer\XmlList(entry: 'FVALUE', inline: true)]
    protected array $value = [];


    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('FUNIT')]
    protected ?string $unit = null;


    #[Serializer\Expose]
    #[Serializer\Type('int')]
    #[Serializer\SerializedName('FORDER')]
    protected ?int $order = null;


    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('FDESCR')]
    protected ?string $description = null;


    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('FVALUE_DETAILS')]
    protected ?string $valueDetails = null;

    /**
     * @return Feature
     */
    public function setName(string $name) : Feature
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param string[] $value
     * @return Feature
     */
    public function setValue(array $value) : Feature
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
     * @param int $order
     * @return Feature
     */
    public function setOrder(int $order) : Feature
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


    public function getName(): string
    {
        return $this->name;
    }


    /**
     * @return ?string[]
     */
    public function getValue(): ?array
    {
        return $this->value;
    }


    public function getUnit(): ?string
    {
        return $this->unit;
    }


    public function getOrder(): ?int
    {
        return $this->order;
    }


    public function getDescription(): ?string
    {
        return $this->description;
    }


    public function getValueDetails(): ?string
    {
        return $this->valueDetails;
    }
}
