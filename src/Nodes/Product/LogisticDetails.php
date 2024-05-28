<?php

namespace Naugrim\BMEcat\Nodes\Product;

use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Nodes\Contracts;
use Naugrim\BMEcat\Nodes\DeliveryTimes;
use Naugrim\BMEcat\Nodes\Product\Logistic\CustomsTariffNumber;
use Naugrim\BMEcat\Nodes\Product\Logistic\Dimensions;
use Naugrim\BMEcat\Nodes\TimeSpan;


#[Serializer\XmlRoot('PRODUCT_LOGISTIC_DETAILS')]
class LogisticDetails implements Contracts\NodeInterface
{

    /**
     *
     *
     * @var CustomsTariffNumber[]
     */
    #[Serializer\Expose]
    #[Serializer\Type('array<Naugrim\BMEcat\Nodes\Product\Logistic\CustomsTariffNumber>')]
    #[Serializer\XmlList(inline: true, entry: 'CUSTOMS_TARIFF_NUMBER')]
    protected array $customs_tariff_numbers = [];

    /**
     *
     * @var float
     */
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('STATISTICS_FACTOR')]
    #[Serializer\XmlElement(cdata: false)]
    protected string $statistics_factor = null;

    /**
     *
     *
     * @var string[]
     */
    #[Serializer\Expose]
    #[Serializer\Type('array<string>')]
    #[Serializer\XmlList(inline: true, entry: 'COUNTRY_OF_ORIGIN')]
    protected array $country_of_origin = [];

    /**
     *
     *
     * @var Dimensions
     */
    #[Serializer\Expose]
    #[Serializer\SerializedName('PRODUCT_DIMENSIONS')]
    #[Serializer\Type(Dimensions::class)]
    protected Dimensions $dimensions = null;

    /**
     *
     *
     * @var DeliveryTimes[]
     */
    #[Serializer\Expose]
    #[Serializer\Type('array<Naugrim\BMEcat\Nodes\DeliveryTimes>')]
    #[Serializer\XmlList(inline: true, entry: 'DELIVERY_TIMES')]
    protected array $deliveryTimes = [];
}
