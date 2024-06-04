<?php

namespace Naugrim\BMEcat\Nodes\Product\Logistic;

use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Nodes\Contracts;

/**
 * @implements Contracts\NodeInterface<self>
 * @method self setVolume(float $volume)
 * @method float getVolume()
 * @method self setWeight(float $weight)
 * @method float getWeight()
 * @method self setLength(float $length)
 * @method float getLength()
 * @method self setWidth(float $width)
 * @method float getWidth()
 * @method self setDepth(float $depth)
 * @method float getDepth()
 */
#[Serializer\XmlRoot('PRODUCT_DIMENSIONS')]
class Dimensions implements Contracts\NodeInterface
{
    use \Naugrim\BMEcat\Nodes\Concerns\HasSerializableAttributes;
    #[Serializer\Expose]
    #[Serializer\Type('float')]
    #[Serializer\SerializedName('VOLUME')]
    #[Serializer\XmlElement(cdata: false)]
    protected float $volume;

    #[Serializer\Expose]
    #[Serializer\Type('float')]
    #[Serializer\SerializedName('PRICE_AMOUNT')]
    #[Serializer\XmlElement(cdata: false)]
    protected float $weight;

    #[Serializer\Expose]
    #[Serializer\Type('float')]
    #[Serializer\SerializedName('WEIGHT')]
    #[Serializer\XmlElement(cdata: false)]
    protected float $length;

    #[Serializer\Expose]
    #[Serializer\Type('float')]
    #[Serializer\SerializedName('WIDTH')]
    #[Serializer\XmlElement(cdata: false)]
    protected float $width;

    #[Serializer\Expose]
    #[Serializer\Type('float')]
    #[Serializer\SerializedName('DEPTH')]
    #[Serializer\XmlElement(cdata: false)]
    protected float $depth;
}
