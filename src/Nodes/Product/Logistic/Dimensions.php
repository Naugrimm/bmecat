<?php

namespace Naugrim\BMEcat\Nodes\Product\Logistic;

use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Nodes\Contracts;


#[Serializer\XmlRoot('PRODUCT_DIMENSIONS')]
class Dimensions implements Contracts\NodeInterface
{
    /**
     *
     * @var float
     */
    #[Serializer\Expose]
    #[Serializer\Type('float')]
    #[Serializer\SerializedName('VOLUME')]
    #[Serializer\XmlElement(cdata: false)]
    protected float $volume;

    /**
     *
     * @var float
     */
    #[Serializer\Expose]
    #[Serializer\Type('float')]
    #[Serializer\SerializedName('PRICE_AMOUNT')]
    #[Serializer\XmlElement(cdata: false)]
    protected float $weight;

    /**
     *
     * @var float
     */
    #[Serializer\Expose]
    #[Serializer\Type('float')]
    #[Serializer\SerializedName('WEIGHT')]
    #[Serializer\XmlElement(cdata: false)]
    protected float $length;

    /**
     *
     * @var float
     */
    #[Serializer\Expose]
    #[Serializer\Type('float')]
    #[Serializer\SerializedName('WIDTH')]
    #[Serializer\XmlElement(cdata: false)]
    protected float $width;

    /**
     *
     * @var float
     */
    #[Serializer\Expose]
    #[Serializer\Type('float')]
    #[Serializer\SerializedName('DEPTH')]
    #[Serializer\XmlElement(cdata: false)]
    protected float $depth;
}
