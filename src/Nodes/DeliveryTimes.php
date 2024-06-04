<?php

namespace Naugrim\BMEcat\Nodes;

use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Nodes\Contracts\NodeInterface;

/**
 * @implements NodeInterface<self>
 * @method self setTerritories(string $territories)
 * @method string getTerritories()
 * @method self setTimeSpans(\Naugrim\BMEcat\Nodes\TimeSpan[]|array $timeSpans)
 * @method \Naugrim\BMEcat\Nodes\TimeSpan[]|array getTimeSpans()
 * @method self setLeadTime(float|null $leadTime)
 * @method float|null getLeadTime()
 */
#[Serializer\XmlRoot('DELIVERY_TIMES')]
class DeliveryTimes implements Contracts\NodeInterface
{
    use \Naugrim\BMEcat\Nodes\Concerns\HasSerializableAttributes;
    /**
     * @var string[]
     */
    #[Serializer\Expose]
    #[Serializer\Type('array<string>')]
    #[Serializer\XmlList(inline: true, entry: 'TERRITORY')]
    protected array $territories;

    /**
     * @var TimeSpan[]
     */
    #[Serializer\Expose]
    #[Serializer\Type('array<Naugrim\BMEcat\Nodes\TimeSpan>')]
    #[Serializer\XmlList(inline: true, entry: 'TIME_SPAN')]
    protected array $timeSpans;

    #[Serializer\Expose]
    #[Serializer\Type('float')]
    #[Serializer\SerializedName('LEADTIME')]
    #[Serializer\XmlElement(cdata: false)]
    protected ?float $leadTime = null;
}
