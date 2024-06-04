<?php

namespace Naugrim\BMEcat\Nodes\Product\Logistic;

use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Nodes\Contracts;

/**
 * @implements Contracts\NodeInterface<self>
 * @method self setNumber(string $number)
 * @method string getNumber()
 * @method self setTerritories(array $territories)
 * @method string[] getTerritories()
 */
#[Serializer\XmlRoot('CUSTOMS_TARIFF_NUMBER')]
class CustomsTariffNumber implements Contracts\NodeInterface
{
    use \Naugrim\BMEcat\Nodes\Concerns\HasSerializableAttributes;
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('CUSTOMS_NUMBER')]
    #[Serializer\XmlElement(cdata: false)]
    protected string $number;

    /**
     * @var string[]
     */
    #[Serializer\Expose]
    #[Serializer\Type('array<string>')]
    #[Serializer\XmlList(entry: 'TERRITORY', inline: true)]
    protected array $territories = [];
}
