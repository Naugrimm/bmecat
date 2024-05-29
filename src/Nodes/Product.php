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

    public function getMode(): string
    {
        return $this->mode;
    }

    public function setMode(string $mode): void
    {
        $this->mode = $mode;
    }

    public function setDetails(Details $details): self
    {
        $this->details = $details;
        return $this;
    }

    public function getDetails(): Details
    {
        return $this->details;
    }

    /**
     * @param PriceDetails[]|array<string, mixed>[] $priceDetails
     * @throws InvalidSetterException
     * @throws UnknownKeyException
     */
    public function setPriceDetails(array $priceDetails): self
    {
        $this->priceDetails = [];
        foreach ($priceDetails as $priceDetail) {
            if (! $priceDetail instanceof PriceDetails) {
                $priceDetail = NodeBuilder::fromArray($priceDetail, \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], PriceDetails::class));
            }

            $this->addPriceDetail($priceDetail);
        }

        return $this;
    }

    public function addPriceDetail(PriceDetails $price): self
    {
        $this->priceDetails[] = $price;
        return $this;
    }

    /**
     * @param Mime[]|array<string, mixed>[] $mimes
     * @throws InvalidSetterException
     * @throws UnknownKeyException
     */
    public function setMimes(array $mimes): self
    {
        $this->mimes = [];
        foreach ($mimes as $mime) {
            if (! $mime instanceof Mime) {
                $mime = NodeBuilder::fromArray($mime, \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Mime::class));
            }

            $this->addMime($mime);
        }

        return $this;
    }

    public function addMime(Mime $mime): self
    {
        $this->mimes[] = $mime;
        return $this;
    }

    public function setId(SupplierPid $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getOrderDetails(): OrderDetails
    {
        return $this->orderDetails;
    }

    public function setOrderDetails(OrderDetails $orderDetails): self
    {
        $this->orderDetails = $orderDetails;
        return $this;
    }

    public function getId(): ?SupplierPid
    {
        return $this->id;
    }

    /**
     * @param Features[]|array<string, mixed>[] $features
     * @throws InvalidSetterException
     * @throws UnknownKeyException
     */
    public function setFeatures(array $features): self
    {
        $this->features = [];
        foreach ($features as $feature) {
            if (! $feature instanceof Features) {
                $feature = NodeBuilder::fromArray($feature, \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Features::class));
            }

            $this->addFeatures($feature);
        }

        return $this;
    }

    public function addFeatures(Features $features): self
    {
        $this->features[] = $features;
        return $this;
    }

    /**
     * @return Features[]
     */
    public function getFeatures(): array
    {
        return $this->features;
    }

    /**
     * @return PriceDetails[]
     */
    public function getPriceDetails(): array
    {
        return $this->priceDetails;
    }

    /**
     * @return Mime[]
     */
    public function getMimes(): array
    {
        return $this->mimes;
    }
}
