<?php


namespace Naugrim\BMEcat\Nodes\Product;

use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Nodes\Contracts;


#[Serializer\XmlRoot('PRODUCT_PRICE')]
class Price implements Contracts\NodeInterface
{
    /**
     *
     * @var string
     */
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('price_type')]
    #[Serializer\XmlAttribute]
    protected string $type = 'gros_list';

    /**
     *
     * @var float
     */
    #[Serializer\Expose]
    #[Serializer\Type('float')]
    #[Serializer\SerializedName('PRICE_AMOUNT')]
    #[Serializer\XmlElement(cdata: false)]
    protected float $price;

    /**
     *
     * @var string
     */
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('PRICE_CURRENCY')]
    #[Serializer\XmlElement(cdata: false)]
    protected string $currency = 'EUR';

    /**
     *
     * @var string
     */
    #[Serializer\Expose]
    #[Serializer\Type('float')]
    #[Serializer\SerializedName('TAX')]
    #[Serializer\XmlElement(cdata: false)]
    protected float $tax;

    /**
     *
     * @var float
     */
    #[Serializer\Expose]
    #[Serializer\Type('float')]
    #[Serializer\SerializedName('PRICE_FACTOR')]
    protected float $priceFactor;

    /**
     *
     * @var float
     */
    #[Serializer\Expose]
    #[Serializer\Type('float')]
    #[Serializer\SerializedName('LOWER_BOUND')]
    protected float $lowerBound;

    /**
     *
     * @param string $currency
     * @return Price
     */
    public function setCurrency(string $currency) : Price
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     *
     * @param float $price
     * @return Price
     */
    public function setPrice(float $price) : Price
    {
        $this->price = $price;
        return $this;
    }

    /**
     *
     * @return float
     */
    public function getPrice(): float
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
