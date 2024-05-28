<?php


namespace Naugrim\BMEcat\Nodes\Product;

use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Builder\NodeBuilder;
use Naugrim\BMEcat\Exception\InvalidSetterException;
use Naugrim\BMEcat\Exception\UnknownKeyException;
use Naugrim\BMEcat\Nodes\Contracts;


#[Serializer\XmlRoot('PRODUCT_PRICE_DETAILS')]
class PriceDetails implements Contracts\NodeInterface
{
    /**
     *
     *
     * @var string
     */
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('VALID_START_DATE')]
    protected string $validStartDate;

    /**
     *
     *
     * @var string
     */
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('VALID_END_DATE')]
    protected string $validEndDate;

    /**
     *
     *
     * @var bool
     */
    #[Serializer\Expose]
    #[Serializer\Type('bool')]
    #[Serializer\SerializedName('DAILY_PRICE')]
    protected bool $dailyPrice;

    /**
     *
     *
     * @var Price[]
     */
    #[Serializer\Expose]
    #[Serializer\SerializedName('PRODUCT_PRICE')]
    #[Serializer\Type('array<Naugrim\BMEcat\Nodes\Product\Price>')]
    #[Serializer\XmlList(inline: true, entry: 'PRODUCT_PRICE')]
    protected array $prices = [];


    /**
     * @param string $validStartDate
     * @return PriceDetails
     */
    public function setValidStartDate(string $validStartDate): PriceDetails
    {
        $this->validStartDate = $validStartDate;
        return $this;
    }

    /**
     * @return string
     */
    public function getValidStartDate(): string
    {
        return $this->validStartDate;
    }

    /**
     * @param string $validEndDate
     * @return PriceDetails
     */
    public function setValidEndDate(string $validEndDate): PriceDetails
    {
        $this->validEndDate = $validEndDate;
        return $this;
    }

    /**
     * @return string
     */
    public function getValidEndDate(): string
    {
        return $this->validEndDate;
    }

    /**
     * @param bool $dailyPrice
     * @return PriceDetails
     */
    public function setDailyPrice(bool $dailyPrice): PriceDetails
    {
        $this->dailyPrice = $dailyPrice;
        return $this;
    }

    /**
     * @return bool
     */
    public function isDailyPrice(): bool
    {
        return $this->dailyPrice;
    }

    /**
     * @param Price[] $prices
     * @return PriceDetails
     * @throws InvalidSetterException
     * @throws UnknownKeyException
     */
    public function setPrices(array $prices): PriceDetails
    {
        $this->prices = [];
        foreach ($prices as $price) {
            if (is_array($price)) {
                $price = NodeBuilder::fromArray($price, new Price());
            }

            $this->addPrice($price);
        }

        return $this;
    }

    public function addPrice(Price $price): static
    {
        if ($this->prices === null) {
            $this->prices = [];
        }

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
