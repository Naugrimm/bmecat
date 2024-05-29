<?php

namespace Naugrim\BMEcat\Nodes\Product;

use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Builder\NodeBuilder;
use Naugrim\BMEcat\Exception\InvalidSetterException;
use Naugrim\BMEcat\Exception\UnknownKeyException;
use Naugrim\BMEcat\Nodes\Contracts;
use Naugrim\BMEcat\Nodes\Contracts\NodeInterface;

/**
 * @implements NodeInterface<self>
 */
#[Serializer\XmlRoot('PRODUCT_PRICE_DETAILS')]
class PriceDetails implements Contracts\NodeInterface
{
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('VALID_START_DATE')]
    protected string $validStartDate;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('VALID_END_DATE')]
    protected string $validEndDate;

    #[Serializer\Expose]
    #[Serializer\Type('bool')]
    #[Serializer\SerializedName('DAILY_PRICE')]
    protected bool $dailyPrice;

    /**
     * @var Price[]
     */
    #[Serializer\Expose]
    #[Serializer\SerializedName('PRODUCT_PRICE')]
    #[Serializer\Type('array<Naugrim\BMEcat\Nodes\Product\Price>')]
    #[Serializer\XmlList(inline: true, entry: 'PRODUCT_PRICE')]
    protected array $prices = [];

    public function setValidStartDate(string $validStartDate): self
    {
        $this->validStartDate = $validStartDate;
        return $this;
    }

    public function getValidStartDate(): string
    {
        return $this->validStartDate;
    }

    public function setValidEndDate(string $validEndDate): self
    {
        $this->validEndDate = $validEndDate;
        return $this;
    }

    public function getValidEndDate(): string
    {
        return $this->validEndDate;
    }

    public function setDailyPrice(bool $dailyPrice): self
    {
        $this->dailyPrice = $dailyPrice;
        return $this;
    }

    public function isDailyPrice(): bool
    {
        return $this->dailyPrice;
    }

    /**
     * @param Price[]|array<string, mixed>[] $prices
     * @throws InvalidSetterException
     * @throws UnknownKeyException
     */
    public function setPrices(array $prices): self
    {
        $this->prices = [];
        foreach ($prices as $price) {
            if (! $price instanceof Price) {
                $price = NodeBuilder::fromArray($price, \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Price::class));
            }

            $this->addPrice($price);
        }

        return $this;
    }

    public function addPrice(Price $price): self
    {
        $this->prices[] = $price;
        return $this;
    }

    /**
     * @return Price[]
     */
    public function getPrices(): array
    {
        return $this->prices;
    }
}
