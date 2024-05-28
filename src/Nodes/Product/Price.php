<?php


namespace Naugrim\BMEcat\Nodes\Product;

use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Nodes\Contracts;

/**
 *
 * @Serializer\XmlRoot("PRODUCT_PRICE")
 */
class Price implements Contracts\NodeInterface
{
    /**
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("price_type")
     * @Serializer\XmlAttribute
     *
     * @var string
     */
    protected $type = 'gros_list';

    /**
     * @Serializer\Expose
     * @Serializer\Type("float")
     * @Serializer\SerializedName("PRICE_AMOUNT")
     * @Serializer\XmlElement(cdata=false)
     *
     * @var float
     */
    protected $price;

    /**
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("PRICE_CURRENCY")
     * @Serializer\XmlElement(cdata=false)
     *
     * @var string
     */
    protected $currency = 'EUR';

    /**
     * @Serializer\Expose
     * @Serializer\Type("float")
     * @Serializer\SerializedName("TAX")
     * @Serializer\XmlElement(cdata=false)
     *
     * @var string
     */
    protected $tax = null;

    /**
     * @Serializer\Expose
     * @Serializer\Type("float")
     * @Serializer\SerializedName("PRICE_FACTOR")
     *
     * @var float
     */
    protected $priceFactor;

    /**
     * @Serializer\Expose
     * @Serializer\Type("float")
     * @Serializer\SerializedName("LOWER_BOUND")
     *
     * @var float
     */
    protected $lowerBound;

    /**
     *
     * @param string $currency
     * @return Price
     */
    public function setCurrency($currency) : Price
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     *
     * @param float $price
     * @return Price
     */
    public function setPrice($price) : Price
    {
        $this->price = $price;
        return $this;
    }

    /**
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param string $type
     * @return Price
     */
    public function setType(string $type): Price
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param float $priceFactor
     * @return Price
     */
    public function setPriceFactor(float $priceFactor): Price
    {
        $this->priceFactor = $priceFactor;
        return $this;
    }

    /**
     * @return float
     */
    public function getPriceFactor(): float
    {
        return $this->priceFactor;
    }

    /**
     * @param float $lowerBound
     * @return Price
     */
    public function setLowerBound(float $lowerBound): Price
    {
        $this->lowerBound = $lowerBound;
        return $this;
    }

    /**
     * @return float
     */
    public function getLowerBound(): float
    {
        return $this->lowerBound;
    }
}
