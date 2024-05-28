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

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param string[] $value
     */
    public function setValue(array $value): self
    {
        $this->value = $value;
        return $this;
    }

    public function setUnit(string $unit): self
    {
        $this->unit = $unit;
        return $this;
    }

    public function setOrder(int $order): self
    {
        $this->order = $order;
        return $this;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function setValueDetails(string $valueDetails): self
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
