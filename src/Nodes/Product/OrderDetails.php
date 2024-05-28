<?php

namespace Naugrim\BMEcat\Nodes\Product;

use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Nodes\Contracts;

/**
 *
 * @Serializer\XmlRoot("PRODUCT_ORDER_DETAILS")
 */
class OrderDetails implements Contracts\NodeInterface
{
    /**
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("ORDER_UNIT")
     * @Serializer\XmlElement(cdata=false)
     *
     * @var string
     */
    protected $orderUnit;

    /**
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("CONTENT_UNIT")
     * @Serializer\XmlElement(cdata=false)
     *
     * @var string
     */
    protected $contentUnit;

    /**
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("NO_CU_PER_OU")
     * @Serializer\XmlElement(cdata=false)
     *
     * @var float
     */
    protected $noCuPerOu = 1;

    /**
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("PRICE_QUANTITY")
     * @Serializer\XmlElement(cdata=false)
     *
     * @var float
     */
    protected $priceQuantity = 1;

    /**
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("QUANTITY_MIN")
     * @Serializer\XmlElement(cdata=false)
     *
     * @var int
     */
    protected $quantityMin = 1;

    /**
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("QUANTITY_INTERVAL")
     * @Serializer\XmlElement(cdata=false)
     *
     * @var int
     */
    protected $quantityInterval = 1;

    /**
     * @return string
     */
    public function getOrderUnit()
    {
        return $this->orderUnit;
    }

    /**
     * @param string $orderUnit
     * @return OrderDetails
     */
    public function setOrderUnit($orderUnit) : OrderDetails
    {
        $this->orderUnit = $orderUnit;
        return $this;
    }

    /**
     * @return string
     */
    public function getContentUnit()
    {
        return $this->contentUnit;
    }

    /**
     * @param string $contentUnit
     * @return OrderDetails
     */
    public function setContentUnit($contentUnit) : OrderDetails
    {
        $this->contentUnit = $contentUnit;
        return $this;
    }

    /**
     * @return float
     */
    public function getNoCuPerOu()
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
    public function setNoCuPerOu($noCuPerOu) : OrderDetails
    {
        $this->noCuPerOu = $noCuPerOu;
        return $this;
    }

    /**
     * @return float
     */
    public function getPriceQuantity()
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
    public function setPriceQuantity($priceQuantity) : OrderDetails
    {
        $this->priceQuantity = $priceQuantity;
        return $this;
    }

    /**
     * @return int
     */
    public function getQuantityMin()
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
    public function setQuantityMin($quantityMin) : OrderDetails
    {
        $this->quantityMin = $quantityMin;
        return $this;
    }

    /**
     * @return int
     */
    public function getQuantityInterval()
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
    public function setQuantityInterval($quantityInterval) : OrderDetails
    {
        $this->quantityInterval = $quantityInterval;
        return $this;
    }
}
