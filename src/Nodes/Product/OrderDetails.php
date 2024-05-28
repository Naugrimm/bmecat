<?php

namespace Naugrim\BMEcat\Nodes\Product;

use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Nodes\Contracts;
use Naugrim\BMEcat\Nodes\Contracts\NodeInterface;

/**
 * @implements NodeInterface<self>
 */
#[Serializer\XmlRoot('PRODUCT_ORDER_DETAILS')]
class OrderDetails implements Contracts\NodeInterface
{
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('ORDER_UNIT')]
    #[Serializer\XmlElement(cdata: false)]
    protected string $orderUnit;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('CONTENT_UNIT')]
    #[Serializer\XmlElement(cdata: false)]
    protected string $contentUnit;

    #[Serializer\Expose]
    #[Serializer\Type('float')]
    #[Serializer\SerializedName('NO_CU_PER_OU')]
    #[Serializer\XmlElement(cdata: false)]
    protected ?float $noCuPerOu = null;

    #[Serializer\Expose]
    #[Serializer\Type('float')]
    #[Serializer\SerializedName('PRICE_QUANTITY')]
    #[Serializer\XmlElement(cdata: false)]
    protected ?float $priceQuantity = null;

    #[Serializer\Expose]
    #[Serializer\Type('float')]
    #[Serializer\SerializedName('QUANTITY_MIN')]
    #[Serializer\XmlElement(cdata: false)]
    protected ?float $quantityMin = null;

    #[Serializer\Expose]
    #[Serializer\Type('float')]
    #[Serializer\SerializedName('QUANTITY_INTERVAL')]
    #[Serializer\XmlElement(cdata: false)]
    protected ?float $quantityInterval = null;

    public function getOrderUnit(): string
    {
        return $this->orderUnit;
    }

    public function setOrderUnit(string $orderUnit): self
    {
        $this->orderUnit = $orderUnit;
        return $this;
    }

    public function getContentUnit(): string
    {
        return $this->contentUnit;
    }

    public function setContentUnit(string $contentUnit): self
    {
        $this->contentUnit = $contentUnit;
        return $this;
    }

    public function getNoCuPerOu(): ?float
    {
        return $this->noCuPerOu;
    }

    public function setNoCuPerOu(float $noCuPerOu): self
    {
        $this->noCuPerOu = $noCuPerOu;
        return $this;
    }

    public function getPriceQuantity(): ?float
    {
        return $this->priceQuantity;
    }

    public function setPriceQuantity(float $priceQuantity): self
    {
        $this->priceQuantity = $priceQuantity;
        return $this;
    }

    public function getQuantityMin(): ?float
    {
        return $this->quantityMin;
    }

    public function setQuantityMin(float $quantityMin): self
    {
        $this->quantityMin = $quantityMin;
        return $this;
    }

    public function getQuantityInterval(): ?float
    {
        return $this->quantityInterval;
    }

    public function setQuantityInterval(float $quantityInterval): self
    {
        $this->quantityInterval = $quantityInterval;
        return $this;
    }
}
