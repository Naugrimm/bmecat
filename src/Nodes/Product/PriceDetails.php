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
    use \Naugrim\BMEcat\Nodes\Concerns\HasSerializableAttributes;
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

    public function isDailyPrice(): bool
    {
        return $this->dailyPrice;
    }

    public function addPrice(Price $price): self
    {
        $this->prices[] = $price;
        return $this;
    }
}
