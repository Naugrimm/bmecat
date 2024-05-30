<?php

namespace Naugrim\BMEcat\Nodes;

use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Builder\NodeBuilder;
use Naugrim\BMEcat\Exception\InvalidSetterException;
use Naugrim\BMEcat\Exception\UnknownKeyException;
use Naugrim\BMEcat\Nodes\Contracts\NodeInterface;
use Naugrim\BMEcat\Nodes\Product\ConfigDetails;
use Naugrim\BMEcat\Nodes\Product\Details;
use Naugrim\BMEcat\Nodes\Product\Features;
use Naugrim\BMEcat\Nodes\Product\LogisticDetails;
use Naugrim\BMEcat\Nodes\Product\OrderDetails;
use Naugrim\BMEcat\Nodes\Product\PriceDetails;

/**
 * @implements NodeInterface<self>
 */
#[Serializer\XmlRoot('PRODUCT')]
class Product implements Contracts\NodeInterface
{
    use \Naugrim\BMEcat\Nodes\Concerns\HasSerializableAttributes;
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('mode')]
    #[Serializer\XmlAttribute]
    protected string $mode = 'new';

    #[Serializer\Expose]
    #[Serializer\Type(SupplierPid::class)]
    #[Serializer\SerializedName('SUPPLIER_PID')]
    protected ?SupplierPid $id = null;

    #[Serializer\Expose]
    #[Serializer\SerializedName('PRODUCT_DETAILS')]
    #[Serializer\Type(Details::class)]
    protected Details $details;

    /**
     * @var Features[]
     */
    #[Serializer\Expose]
    #[Serializer\Type('array<Naugrim\BMEcat\Nodes\Product\Features>')]
    #[Serializer\XmlList(entry: 'PRODUCT_FEATURES', inline: true)]
    protected array $features = [];

    #[Serializer\Expose]
    #[Serializer\SerializedName('PRODUCT_ORDER_DETAILS')]
    #[Serializer\Type(OrderDetails::class)]
    protected OrderDetails $orderDetails;

    /**
     * @var PriceDetails[]
     */
    #[Serializer\Expose]
    #[Serializer\SerializedName('PRODUCT_PRICE_DETAILS')]
    #[Serializer\Type('array<Naugrim\BMEcat\Nodes\Product\PriceDetails>')]
    #[Serializer\XmlList(inline: true, entry: 'PRODUCT_PRICE_DETAILS')]
    protected array $priceDetails = [];

    /**
     * @var Mime[]
     */
    #[Serializer\Expose]
    #[Serializer\SerializedName('MIME_INFO')]
    #[Serializer\Type('array<Naugrim\BMEcat\Nodes\Mime>')]
    #[Serializer\XmlList(entry: 'MIME')]
    protected array $mimes = [];

    #[Serializer\Expose]
    #[Serializer\SerializedName('PRODUCT_LOGISTIC_DETAILS')]
    #[Serializer\Type(LogisticDetails::class)]
    protected LogisticDetails $logisticDetails;

    #[Serializer\Expose]
    #[Serializer\SerializedName('PRODUCT_CONFIG_DETAILS')]
    #[Serializer\Type(ConfigDetails::class)]
    protected ConfigDetails $configDetails;

    public function setMode(string $mode): void
    {
        $this->mode = $mode;
    }

    public function addPriceDetail(PriceDetails $price): self
    {
        $this->priceDetails[] = $price;
        return $this;
    }

    public function addMime(Mime $mime): self
    {
        $this->mimes[] = $mime;
        return $this;
    }

    public function addFeatures(Features $features): self
    {
        $this->features[] = $features;
        return $this;
    }
}
