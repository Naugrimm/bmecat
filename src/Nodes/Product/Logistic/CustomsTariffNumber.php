<?php

namespace Naugrim\BMEcat\Nodes\Product\Logistic;

use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Nodes\Contracts;


#[Serializer\XmlRoot('CUSTOMS_TARIFF_NUMBER')]
class CustomsTariffNumber implements Contracts\NodeInterface
{
    /**
     *
     * @var string
     */
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('CUSTOMS_NUMBER')]
    #[Serializer\XmlElement(cdata: false)]
    protected string $number;

    /**
     *
     *
     * @var string[]
     */
    #[Serializer\Expose]
    #[Serializer\Type('array<string>')]
    #[Serializer\XmlList(inline: true, entry: 'TERRITORY')]
    protected array $territories;
}
