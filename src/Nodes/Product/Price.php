<?php

namespace Naugrim\BMEcat\Nodes\Product;

use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Nodes\Contracts;
use Naugrim\BMEcat\Nodes\Contracts\NodeInterface;

/**
 * @implements NodeInterface<self>
 * @method self setType(string $type)
 * @method string getType()
 * @method self setPrice(float $price)
 * @method float getPrice()
 * @method self setCurrency(string $currency)
 * @method string getCurrency()
 * @method self setTax(float|null $tax)
 * @method float|null getTax()
 * @method self setPriceFactor(float|null $priceFactor)
 * @method float|null getPriceFactor()
 * @method self setLowerBound(float|null $lowerBound)
 * @method float|null getLowerBound()
 */
#[Serializer\XmlRoot('PRODUCT_PRICE')]
class Price implements Contracts\NodeInterface
{
    use \Naugrim\BMEcat\Nodes\Concerns\HasSerializableAttributes;
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
}
