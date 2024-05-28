<?php

namespace Naugrim\BMEcat\Nodes\Product\Logistic;

use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Nodes\Contracts;

/**
 * @implements Contracts\NodeInterface<self>
 */
#[Serializer\XmlRoot('CUSTOMS_TARIFF_NUMBER')]
class CustomsTariffNumber implements Contracts\NodeInterface
{
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

    public function setNumber(string $number): self
    {
        $this->number = $number;
        return $this;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    /**
     * @param string[] $territories
     * @return $this
     */
    public function setTerritories(array $territories): self
    {
        $this->territories = $territories;
        return $this;
    }

    /**
     * @return string[]
     */
    public function getTerritories(): array
    {
        return $this->territories;
    }
}
