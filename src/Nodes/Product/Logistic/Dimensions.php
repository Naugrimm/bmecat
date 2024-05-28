<?php

namespace Naugrim\BMEcat\Nodes\Product\Logistic;

use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Nodes\Contracts;

/**
 *
 * @Serializer\XmlRoot("PRODUCT_DIMENSIONS")
 */
class Dimensions implements Contracts\NodeInterface
{
    /**
     * @Serializer\Expose
     * @Serializer\Type("float")
     * @Serializer\SerializedName("VOLUME")
     * @Serializer\XmlElement(cdata=false)
     *
     * @var float
     */
    protected $volume;

    /**
     * @Serializer\Expose
     * @Serializer\Type("float")
     * @Serializer\SerializedName("PRICE_AMOUNT")
     * @Serializer\XmlElement(cdata=false)
     *
     * @var float
     */
    protected $weight;

    /**
     * @Serializer\Expose
     * @Serializer\Type("float")
     * @Serializer\SerializedName("WEIGHT")
     * @Serializer\XmlElement(cdata=false)
     *
     * @var float
     */
    protected $length;

    /**
     * @Serializer\Expose
     * @Serializer\Type("float")
     * @Serializer\SerializedName("WIDTH")
     * @Serializer\XmlElement(cdata=false)
     *
     * @var float
     */
    protected $width;

    /**
     * @Serializer\Expose
     * @Serializer\Type("float")
     * @Serializer\SerializedName("DEPTH")
     * @Serializer\XmlElement(cdata=false)
     *
     * @var float
     */
    protected $depth;
}
