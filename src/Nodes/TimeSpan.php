<?php

namespace Naugrim\BMEcat\Nodes;

use JMS\Serializer\Annotation as Serializer;


#[Serializer\XmlRoot('TimeSpan')]
class TimeSpan implements Contracts\NodeInterface
{
    /**
     *
     * @var string
     */
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('TIME_BASE')]
    #[Serializer\XmlElement(cdata: false)]
    protected string $base;

    /**
     *
     * @var string|null
     */
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('TIME_VALUE_DURATION')]
    #[Serializer\SkipWhenEmpty]
    protected string $value_duration;

    /**
     *
     * @var string|null
     */
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('TIME_VALUE_INTERVAL')]
    #[Serializer\SkipWhenEmpty]
    protected string $value_interval;

    /**
     *
     * @var string|null
     */
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('TIME_VALUE_START')]
    #[Serializer\SkipWhenEmpty]
    protected string $value_start;

    /**
     *
     * @var string|null
     */
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('TIME_VALUE_END')]
    #[Serializer\SkipWhenEmpty]
    protected string $value_end;


    /**
     *
     * @var TimeSpan[]
     */
    #[Serializer\Expose]
    #[Serializer\Type('array<Naugrim\BMEcat\Nodes\TimeSpan>')]
    #[Serializer\XmlList(inline: true, entry: 'SUB_TIME_SPANS')]
    protected array $subTimeSpans;

}