<?php

namespace Naugrim\BMEcat\Nodes\Product;

use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Nodes\Contracts;
use Naugrim\BMEcat\Nodes\Contracts\NodeInterface;

/**
 * @implements NodeInterface<self>
 * @method self setOrderUnit(string $orderUnit)
 * @method string getOrderUnit()
 * @method self setContentUnit(string $contentUnit)
 * @method string getContentUnit()
 * @method self setNoCuPerOu(float|null $noCuPerOu)
 * @method float|null getNoCuPerOu()
 * @method self setPriceQuantity(float|null $priceQuantity)
 * @method float|null getPriceQuantity()
 * @method self setQuantityMin(float|null $quantityMin)
 * @method float|null getQuantityMin()
 * @method self setQuantityInterval(float|null $quantityInterval)
 * @method float|null getQuantityInterval()
 */
#[Serializer\XmlRoot('PRODUCT_ORDER_DETAILS')]
class OrderDetails implements Contracts\NodeInterface
{
    use \Naugrim\BMEcat\Nodes\Concerns\HasSerializableAttributes;
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
}
