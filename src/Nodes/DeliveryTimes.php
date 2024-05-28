<?php

namespace Naugrim\BMEcat\Nodes;

use JMS\Serializer\Annotation as Serializer;

/**
 *
 * @Serializer\XmlRoot("DELIVERY_TIMES")
 */
class DeliveryTimes implements Contracts\NodeInterface
{

    /**
     *
     * @Serializer\Expose
     * @Serializer\Type("array<string>")
     * @Serializer\XmlList(inline=true, entry="TERRITORY")
     *
     * @var string[]
     */
    protected $territories;

    /**
     *
     * @Serializer\Expose
     * @Serializer\Type("array<Naugrim\BMEcat\Nodes\TimeSpan>")
     * @Serializer\XmlList(inline=true, entry="TIME_SPAN")
     *
     * @var TimeSpan[]
     */
    protected $timeSpans;

    /**
     * @Serializer\Expose
     * @Serializer\Type("float")
     * @Serializer\SerializedName("LEADTIME")
     * @Serializer\XmlElement(cdata=false)
     *
     * @var float
     */
    protected $leadTime = null;
}