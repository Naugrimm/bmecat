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
    /**
     *
     * @var string
     */
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('mode')]
    #[Serializer\XmlAttribute]
    protected string $mode = 'new';

    #[Serializer\Expose]
    #[Serializer\Type(SupplierPid::class)]
    #[Serializer\SerializedName('SUPPLIER_PID')]
    protected ?SupplierPid $id = null;

    /**
     *
     *
     * @var Details
     */
    #[Serializer\Expose]
    #[Serializer\SerializedName('PRODUCT_DETAILS')]
    #[Serializer\Type(Details::class)]
    protected Details $details;


    /**
     *
     *
     * @var Features[]
     */
    #[Serializer\Expose]
    #[Serializer\Type('array<Naugrim\BMEcat\Nodes\Product\Features>')]
    #[Serializer\XmlList(entry: 'PRODUCT_FEATURES', inline: true)]
    protected array $features = [];

    /**
     *
     * @var OrderDetails
     */
    #[Serializer\Expose]
    #[Serializer\SerializedName('PRODUCT_ORDER_DETAILS')]
    #[Serializer\Type(OrderDetails::class)]
    protected OrderDetails $orderDetails;

    /**
     *
     *
     * @var PriceDetails[]
     */
    #[Serializer\Expose]
    #[Serializer\SerializedName('PRODUCT_PRICE_DETAILS')]
    #[Serializer\Type('array<Naugrim\BMEcat\Nodes\Product\PriceDetails>')]
    #[Serializer\XmlList(inline: true, entry: 'PRODUCT_PRICE_DETAILS')]
    protected array $priceDetails = [];

    /**
     *
     *
     * @var Mime[]
     */
    #[Serializer\Expose]
    #[Serializer\SerializedName('MIME_INFO')]
    #[Serializer\Type('array<Naugrim\BMEcat\Nodes\Mime>')]
    #[Serializer\XmlList(entry: 'MIME')]
    protected array $mimes = [];

    /**
     *
     * @var LogisticDetails
     */
    #[Serializer\Expose]
    #[Serializer\SerializedName('PRODUCT_LOGISTIC_DETAILS')]
    #[Serializer\Type(LogisticDetails::class)]
    protected LogisticDetails $logisticDetails;

    /**
     *
     * @var ConfigDetails
     */
    #[Serializer\Expose]
    #[Serializer\SerializedName('PRODUCT_CONFIG_DETAILS')]
    #[Serializer\Type(ConfigDetails::class)]
    protected ConfigDetails $configDetails;

    /**
     * @return string
     */
    public function getMode(): string
    {
        return $this->mode;
    }

    /**
     * @param string $mode
     */
    public function setMode(string $mode): void
    {
        $this->mode = $mode;
    }


    /**
     *
     * @param Details $details
     * @return Product
     */
    public function setDetails(Details $details) : Product
    {
        $this->details = $details;
        return $this;
    }

    /**
     *
     * @return Details
     */
    public function getDetails(): Details
    {
        return $this->details;
    }

    /**
     *
     * @param PriceDetails[]|array<string, mixed>[] $priceDetails
     * @return Product
     * @throws InvalidSetterException
     * @throws UnknownKeyException
     */
    public function setPriceDetails(array $priceDetails) : Product
    {
        $this->priceDetails = [];
        foreach ($priceDetails as $priceDetail) {
            if (!$priceDetail instanceof PriceDetails) {
                $priceDetail = NodeBuilder::fromArray($priceDetail, new PriceDetails());
            }

            $this->addPriceDetail($priceDetail);
        }

        return $this;
    }

    /**
     *
     * @param PriceDetails $price
     * @return Product
     */
    public function addPriceDetail(PriceDetails $price) : Product
    {
        $this->priceDetails[] = $price;
        return $this;
    }

    /**
     * @param Mime[]|array<string, mixed>[] $mimes
     * @return Product
     * @throws InvalidSetterException
     * @throws UnknownKeyException
     */
    public function setMimes(array $mimes): Product
    {
        $this->mimes = [];
        foreach ($mimes as $mime) {
            if (!$mime instanceof Mime) {
                $mime = NodeBuilder::fromArray($mime, new Mime());
            }

            $this->addMime($mime);
        }

        return $this;
    }

    /**
     * @param Mime $mime
     * @return Product
     */
    public function addMime(Mime $mime) : Product
    {
        $this->mimes[] = $mime;
        return $this;
    }

    /**
     *
     * @param SupplierPid $id
     * @return Product
     */
    public function setId(SupplierPid $id) : Product
    {
        $this->id = $id;
        return $this;
    }

    public function getOrderDetails(): OrderDetails
    {
        return $this->orderDetails;
    }

    public function setOrderDetails(OrderDetails $orderDetails) : self
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
     * @return Product
     * @throws InvalidSetterException
     * @throws UnknownKeyException
     */
    public function setFeatures(array $features): Product
    {
        $this->features = [];
        foreach ($features as $feature) {
            if (! $feature instanceof Features) {
                $feature = NodeBuilder::fromArray($feature, new Features());
            }

            $this->addFeatures($feature);
        }

        return $this;
    }

    /**
     *
     * @param Features $features
     * @return Product
     */
    public function addFeatures(Features $features) : Product
    {
        $this->features[] = $features;
        return $this;
    }

    /**
     *
     * @return Features[]
     */
    public function getFeatures(): array
    {
        return $this->features;
    }

    /**
     *
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
