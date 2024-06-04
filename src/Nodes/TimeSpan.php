<?php

namespace Naugrim\BMEcat\Nodes;

use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Nodes\Contracts\NodeInterface;

/**
 * @implements NodeInterface<self>
 * @method self setBase(string $base)
 * @method string getBase()
 * @method self setValueDuration(string|null $valueDuration)
 * @method string|null getValueDuration()
 * @method self setValueInterval(string|null $valueInterval)
 * @method string|null getValueInterval()
 * @method self setValueStart(string|null $valueStart)
 * @method string|null getValueStart()
 * @method self setValueEnd(string|null $valueEnd)
 * @method string|null getValueEnd()
 * @method self setSubTimeSpans(\Naugrim\BMEcat\Nodes\TimeSpan|array $subTimeSpans)
 * @method Naugrim\BMEcat\Nodes\TimeSpan[] getSubTimeSpans()
 */
#[Serializer\XmlRoot('TimeSpan')]
class TimeSpan implements Contracts\NodeInterface
{
    use \Naugrim\BMEcat\Nodes\Concerns\HasSerializableAttributes;
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('TIME_BASE')]
    #[Serializer\XmlElement(cdata: false)]
    protected string $base;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('TIME_VALUE_DURATION')]
    #[Serializer\SkipWhenEmpty]
    protected ?string $valueDuration = null;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('TIME_VALUE_INTERVAL')]
    #[Serializer\SkipWhenEmpty]
    protected ?string $valueInterval = null;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('TIME_VALUE_START')]
    #[Serializer\SkipWhenEmpty]
    protected ?string $valueStart = null;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('TIME_VALUE_END')]
    #[Serializer\SkipWhenEmpty]
    protected ?string $valueEnd = null;

    /**
     * @var TimeSpan[]
     */
    #[Serializer\Expose]
    #[Serializer\Type('array<Naugrim\BMEcat\Nodes\TimeSpan>')]
    #[Serializer\XmlList(entry: 'SUB_TIME_SPANS', inline: true)]
    protected array $subTimeSpans;
}
