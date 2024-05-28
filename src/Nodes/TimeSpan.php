<?php

namespace Naugrim\BMEcat\Nodes;

use JMS\Serializer\Annotation as Serializer;

/**
 *
 * @Serializer\XmlRoot("TimeSpan")
 */
class TimeSpan implements Contracts\NodeInterface
{
    /**
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("TIME_BASE")
     * @Serializer\XmlElement(cdata=false)
     *
     * @var string
     */
    protected $base;

    /**
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("TIME_VALUE_DURATION")
     * @Serializer\SkipWhenEmpty
     *
     * @var string|null
     */
    protected $value_duration;

    /**
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("TIME_VALUE_INTERVAL")
     * @Serializer\SkipWhenEmpty
     *
     * @var string|null
     */
    protected $value_interval;

    /**
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("TIME_VALUE_START")
     * @Serializer\SkipWhenEmpty
     *
     * @var string|null
     */
    protected $value_start;

    /**
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("TIME_VALUE_END")
     * @Serializer\SkipWhenEmpty
     *
     * @var string|null
     */
    protected $value_end;


    /**
     * @Serializer\Expose
     * @Serializer\Type("array<Naugrim\BMEcat\Nodes\TimeSpan>")
     * @Serializer\XmlList(inline=true, entry="SUB_TIME_SPANS")
     *
     * @var TimeSpan[]
     */
    protected $subTimeSpans;

}