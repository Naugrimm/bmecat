<?php

namespace Naugrim\BMEcat\Nodes\Product;

use /** @noinspection PhpUnusedAliasInspection */
    JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Nodes\Contracts;
use Naugrim\BMEcat\Nodes\DeliveryTimes;
use Naugrim\BMEcat\Nodes\Product\Logistic\CustomsTariffNumber;
use Naugrim\BMEcat\Nodes\Product\Logistic\Dimensions;
use Naugrim\BMEcat\Nodes\TimeSpan;

/**
 *
 * @Serializer\XmlRoot("PRODUCT_LOGISTIC_DETAILS")
 */
class LogisticDetails implements Contracts\NodeInterface
{

    /**
     *
     * @Serializer\Expose
     * @Serializer\Type("array<Naugrim\BMEcat\Nodes\Product\Logistic\CustomsTariffNumber>")
     * @Serializer\XmlList( inline=true, entry="CUSTOMS_TARIFF_NUMBER")
     *
     * @var CustomsTariffNumber[]
     */
    protected $customs_tariff_numbers = [];

    /**
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("STATISTICS_FACTOR")
     * @Serializer\XmlElement(cdata=false)
     *
     * @var float
     */
    protected $statistics_factor = null;

    /**
     *
     * @Serializer\Expose
     * @Serializer\Type("array<string>")
     * @Serializer\XmlList(inline=true, entry="COUNTRY_OF_ORIGIN")
     *
     * @var string[]
     */
    protected $country_of_origin = [];

    /**
     *
     * @Serializer\Expose
     * @Serializer\SerializedName("PRODUCT_DIMENSIONS")
     * @Serializer\Type("Naugrim\BMEcat\Nodes\Product\Logistic\Dimensions")
     *
     * @var Dimensions
     */
    protected $dimensions = null;

    /**
     *
     * @Serializer\Expose
     * @Serializer\Type("array<Naugrim\BMEcat\Nodes\DeliveryTimes>")
     * @Serializer\XmlList(inline=true, entry="DELIVERY_TIMES")
     *
     * @var DeliveryTimes[]
     */
    protected $deliveryTimes = [];
}