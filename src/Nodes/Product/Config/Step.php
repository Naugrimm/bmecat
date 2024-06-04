<?php

namespace Naugrim\BMEcat\Nodes\Product\Config;

use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Nodes\Contracts;
use Naugrim\BMEcat\Nodes\Contracts\NodeInterface;
use Naugrim\BMEcat\Nodes\Product\PriceDetails;

/**
 * @implements NodeInterface<self>
 * @method self setId(string $id)
 * @method string getId()
 * @method self setHeader(string $header)
 * @method string getHeader()
 * @method self setDescriptionShort(string $descriptionShort)
 * @method string getDescriptionShort()
 * @method self setDescriptionLong(string $descriptionLong)
 * @method string getDescriptionLong()
 * @method self setOrder(int $order)
 * @method int getOrder()
 * @method self setCode(string|null $code)
 * @method string|null getCode()
 * @method self setPriceDetails(null|array|\Naugrim\BMEcat\Nodes\Product\PriceDetails $priceDetails)
 * @method \Naugrim\BMEcat\Nodes\Product\PriceDetails|null getPriceDetails()
 * @method self setParts(array|\Naugrim\BMEcat\Nodes\Product\Config\Parts $parts)
 * @method \Naugrim\BMEcat\Nodes\Product\Config\Parts getParts()
 * @method self setMinOccurrence(int $minOccurrence)
 * @method int getMinOccurrence()
 * @method self setMaxOccurrence(int $maxOccurrence)
 * @method int getMaxOccurrence()
 */
#[Serializer\XmlRoot('CONFIG_STEP')]
class Step implements Contracts\NodeInterface
{
    use \Naugrim\BMEcat\Nodes\Concerns\HasSerializableAttributes;
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('STEP_ID')]
    #[Serializer\XmlElement(cdata: false)]
    protected string $id;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('STEP_HEADER')]
    protected string $header;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('STEP_DESCR_SHORT')]
    protected string $descriptionShort = '';

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('STEP_DESCR_LONG')]
    protected string $descriptionLong;

    #[Serializer\Expose]
    #[Serializer\Type('int')]
    #[Serializer\SerializedName('STEP_ORDER')]
    #[Serializer\XmlElement(cdata: false)]
    protected int $order;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('CONFIG_CODE')]
    protected ?string $code = null;

    #[Serializer\Expose]
    #[Serializer\SerializedName('PRODUCT_PRICE_DETAILS')]
    #[Serializer\Type(PriceDetails::class)]
    protected ?PriceDetails $priceDetails = null;

    #[Serializer\Expose]
    #[Serializer\SerializedName('CONFIG_PARTS')]
    #[Serializer\Type(Parts::class)]
    protected Parts $parts;

    #[Serializer\Expose]
    #[Serializer\Type('int')]
    #[Serializer\SerializedName('MIN_OCCURANCE')]
    #[Serializer\XmlElement(cdata: false)]
    protected int $minOccurrence;

    #[Serializer\Expose]
    #[Serializer\Type('int')]
    #[Serializer\SerializedName('MAX_OCCURANCE')]
    #[Serializer\XmlElement(cdata: false)]
    protected int $maxOccurrence;
}
