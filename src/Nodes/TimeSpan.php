<?php

namespace Naugrim\BMEcat\Nodes;

use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Nodes\Contracts\NodeInterface;

/**
 * @implements NodeInterface<self>
 */
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

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('TIME_VALUE_DURATION')]
    #[Serializer\SkipWhenEmpty]
    protected ?string $value_duration = null;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('TIME_VALUE_INTERVAL')]
    #[Serializer\SkipWhenEmpty]
    protected ?string $value_interval = null;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('TIME_VALUE_START')]
    #[Serializer\SkipWhenEmpty]
    protected ?string $value_start = null;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('TIME_VALUE_END')]
    #[Serializer\SkipWhenEmpty]
    protected ?string $value_end = null;

    /**
     *
     * @var TimeSpan[]
     */
    #[Serializer\Expose]
    #[Serializer\Type('array<Naugrim\BMEcat\Nodes\TimeSpan>')]
    #[Serializer\XmlList(entry: 'SUB_TIME_SPANS', inline: true)]
    protected array $subTimeSpans;

}
