<?php

namespace Naugrim\BMEcat\Nodes\Product;

use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Nodes\Contracts;
use Naugrim\BMEcat\Nodes\Contracts\NodeInterface;

/**
 * @implements NodeInterface<self>
 */
#[Serializer\XmlRoot('PRODUCT_PRICE')]
class Price implements Contracts\NodeInterface
{
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('price_type')]
    #[Serializer\XmlAttribute]
    protected string $type = 'gros_list';

    #[Serializer\Expose]
    #[Serializer\Type('float')]
    #[Serializer\SerializedName('PRICE_AMOUNT')]
    #[Serializer\XmlElement(cdata: false)]
    protected float $price;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('PRICE_CURRENCY')]
    #[Serializer\XmlElement(cdata: false)]
    protected string $currency = 'EUR';

    #[Serializer\Expose]
    #[Serializer\Type('float')]
    #[Serializer\SerializedName('TAX')]
    #[Serializer\XmlElement(cdata: false)]
    protected ?float $tax = null;

    #[Serializer\Expose]
    #[Serializer\Type('float')]
    #[Serializer\SerializedName('PRICE_FACTOR')]
    protected ?float $priceFactor = null;

    #[Serializer\Expose]
    #[Serializer\Type('float')]
    #[Serializer\SerializedName('LOWER_BOUND')]
    protected ?float $lowerBound = null;

    public function setCurrency(string $currency): self
    {
        $this->currency = $currency;
        return $this;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;
        return $this;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setPriceFactor(float $priceFactor): self
    {
        $this->priceFactor = $priceFactor;
        return $this;
    }

    public function getPriceFactor(): ?float
    {
        return $this->priceFactor;
    }

    public function setLowerBound(float $lowerBound): self
    {
        $this->lowerBound = $lowerBound;
        return $this;
    }

    public function getLowerBound(): ?float
    {
        return $this->lowerBound;
    }
}
