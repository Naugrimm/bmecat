<?php

namespace Naugrim\BMEcat\Nodes\Product\Config;

use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Nodes\Contracts;
use Naugrim\BMEcat\Nodes\Contracts\NodeInterface;
use Naugrim\BMEcat\Nodes\Product\PriceDetails;

/**
 * @implements NodeInterface<self>
 */
#[Serializer\XmlRoot('CONFIG_STEP')]
class Step implements Contracts\NodeInterface
{
    /**
     *
     * @var string
     */
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('STEP_ID')]
    #[Serializer\XmlElement(cdata: false)]
    protected string $id;

    /**
     *
     *
     * @var string
     */
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('STEP_HEADER')]
    protected string $header;

    /**
     *
     *
     * @var string
     */
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('STEP_DESCR_SHORT')]
    protected string $descriptionShort = '';

    /**
     *
     *
     * @var string
     */
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('STEP_DESCR_LONG')]
    protected string $descriptionLong;

    /**
     *
     *
     * @var int
     */
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

    /**
     *
     *
     * @var Parts
     */
    #[Serializer\Expose]
    #[Serializer\SerializedName('CONFIG_PARTS')]
    #[Serializer\Type(Parts::class)]
    protected Parts $parts;

    /**
     *
     *
     * @var int
     */
    #[Serializer\Expose]
    #[Serializer\Type('int')]
    #[Serializer\SerializedName('MIN_OCCURANCE')]
    #[Serializer\XmlElement(cdata: false)]
    protected int $min_occurrence;

    /**
     *
     *
     * @var int
     */
    #[Serializer\Expose]
    #[Serializer\Type('int')]
    #[Serializer\SerializedName('MAX_OCCURANCE')]
    #[Serializer\XmlElement(cdata: false)]
    protected int $max_occurrence;
}
