<?php

namespace Naugrim\BMEcat\Nodes\Product;

use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Nodes\Contracts;


#[Serializer\XmlRoot('PRODUCT_ORDER_DETAILS')]
class OrderDetails implements Contracts\NodeInterface
{
    /**
     *
     * @var string
     */
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('ORDER_UNIT')]
    #[Serializer\XmlElement(cdata: false)]
    protected string $orderUnit;

    /**
     *
     * @var string
     */
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('CONTENT_UNIT')]
    #[Serializer\XmlElement(cdata: false)]
    protected string $contentUnit;

    /**
     *
     * @var float
     */
    #[Serializer\Expose]
    #[Serializer\Type('float')]
    #[Serializer\SerializedName('NO_CU_PER_OU')]
    #[Serializer\XmlElement(cdata: false)]
    protected float $noCuPerOu = 1.0;

    /**
     *
     * @var float
     */
    #[Serializer\Expose]
    #[Serializer\Type('float')]
    #[Serializer\SerializedName('PRICE_QUANTITY')]
    #[Serializer\XmlElement(cdata: false)]
    protected float $priceQuantity = 1.0;

    /**
     *
     * @var int
     */
    #[Serializer\Expose]
    #[Serializer\Type('float')]
    #[Serializer\SerializedName('QUANTITY_MIN')]
    #[Serializer\XmlElement(cdata: false)]
    protected float $quantityMin = 1.0;

    /**
     *
     * @var int
     */
    #[Serializer\Expose]
    #[Serializer\Type('float')]
    #[Serializer\SerializedName('QUANTITY_INTERVAL')]
    #[Serializer\XmlElement(cdata: false)]
    protected float $quantityInterval = 1.0;

    /**
     * @return string
     */
    public function getOrderUnit(): string
    {
        return $this->orderUnit;
    }

    /**
     * @param string $orderUnit
     * @return OrderDetails
     */
    public function setOrderUnit(string $orderUnit) : OrderDetails
    {
        $this->orderUnit = $orderUnit;
        return $this;
    }

    /**
     * @return string
     */
    public function getContentUnit(): string
    {
        return $this->contentUnit;
    }

    /**
     * @param string $contentUnit
     * @return OrderDetails
     */
    public function setContentUnit(string $contentUnit) : OrderDetails
    {
        $this->contentUnit = $contentUnit;
        return $this;
    }

    /**
     * @return float
     */
    public function getNoCuPerOu(): int|string
    {
        if ($this->noCuPerOu === null) {
            return 1;
        }

        return $this->noCuPerOu;
    }

    /**
     * @param float $noCuPerOu
     * @return OrderDetails
     */
    public function setNoCuPerOu(string $noCuPerOu) : OrderDetails
    {
        $this->noCuPerOu = $noCuPerOu;
        return $this;
    }

    /**
     * @return float
     */
    public function getPriceQuantity(): int|string
    {
        if ($this->priceQuantity === null) {
            return 1;
        }

        return $this->priceQuantity;
    }

    /**
     * @param float $priceQuantity
     * @return OrderDetails
     */
    public function setPriceQuantity(string $priceQuantity) : OrderDetails
    {
        $this->priceQuantity = $priceQuantity;
        return $this;
    }

    /**
     * @return int
     */
    public function getQuantityMin(): int|string
    {
        if ($this->quantityMin === null) {
            return 1;
        }

        return $this->quantityMin;
    }

    /**
     * @param int $quantityMin
     * @return OrderDetails
     */
    public function setQuantityMin(string $quantityMin) : OrderDetails
    {
        $this->quantityMin = $quantityMin;
        return $this;
    }

    /**
     * @return int
     */
    public function getQuantityInterval(): int|string
    {
        if ($this->quantityInterval === null) {
            return 1;
        }

        return $this->quantityInterval;
    }

    /**
     * @param int $quantityInterval
     * @return OrderDetails
     */
    public function setQuantityInterval(string $quantityInterval) : OrderDetails
    {
        $this->quantityInterval = $quantityInterval;
        return $this;
    }
}
