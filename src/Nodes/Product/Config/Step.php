<?php

namespace Naugrim\BMEcat\Nodes\Product\Config;

use /** @noinspection PhpUnusedAliasInspection */
    JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Nodes\Contracts;
use Naugrim\BMEcat\Nodes\Product\PriceDetails;

/**
 *
 * @Serializer\XmlRoot("CONFIG_STEP")
 */
class Step implements Contracts\NodeInterface
{
    /**
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("STEP_ID")
     * @Serializer\XmlElement(cdata=false)
     *
     * @var string
     */
    protected $id;

    /**
     *
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("STEP_HEADER")
     *
     * @var string
     */
    protected $header;

    /**
     *
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("STEP_DESCR_SHORT")
     *
     * @var string
     */
    protected $descriptionShort = '';

    /**
     *
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("STEP_DESCR_LONG")
     *
     * @var string
     */
    protected $descriptionLong;

    /**
     *
     * @Serializer\Expose
     * @Serializer\Type("int")
     * @Serializer\SerializedName("STEP_ORDER")
     * @Serializer\XmlElement(cdata=false)
     *
     * @var int
     */
    protected $order;

    /**
     *
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("CONFIG_CODE")
     *
     * @var string
     */
    protected $code = null;

    /**
     *
     * @Serializer\Expose
     * @Serializer\SerializedName("PRODUCT_PRICE_DETAILS")
     * @Serializer\Type("Naugrim\BMEcat\Nodes\Product\PriceDetails")
     *
     * @var PriceDetails
     */
    protected $priceDetails = null;

    /**
     *
     * @Serializer\Expose
     * @Serializer\SerializedName("CONFIG_PARTS")
     * @Serializer\Type("Naugrim\BMEcat\Nodes\Product\Config\Parts")
     *
     * @var Parts
     */
    protected $parts;

    /**
     *
     * @Serializer\Expose
     * @Serializer\Type("int")
     * @Serializer\SerializedName("MIN_OCCURANCE")
     * @Serializer\XmlElement(cdata=false)
     *
     * @var int
     */
    protected $min_occurrence;
    /**
     *
     * @Serializer\Expose
     * @Serializer\Type("int")
     * @Serializer\SerializedName("MAX_OCCURANCE")
     * @Serializer\XmlElement(cdata=false)
     *
     * @var int
     */
    protected $max_occurrence;
}