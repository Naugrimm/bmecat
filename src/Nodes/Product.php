<?php


namespace Naugrim\BMEcat\Nodes;

use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Builder\NodeBuilder;
use Naugrim\BMEcat\Exception\InvalidSetterException;
use Naugrim\BMEcat\Exception\UnknownKeyException;
use Naugrim\BMEcat\Nodes\Product\ConfigDetails;
use Naugrim\BMEcat\Nodes\Product\Details;
use Naugrim\BMEcat\Nodes\Product\Features;
use Naugrim\BMEcat\Nodes\Product\LogisticDetails;
use Naugrim\BMEcat\Nodes\Product\OrderDetails;
use Naugrim\BMEcat\Nodes\Product\PriceDetails;


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

    /**
     *
     *
     * @var SupplierPid
     */
    #[Serializer\Expose]
    #[Serializer\Type(\Naugrim\BMEcat\Nodes\SupplierPid::class)]
    #[Serializer\SerializedName('SUPPLIER_PID')]
    protected \Naugrim\BMEcat\Nodes\SupplierPid $id;

    /**
     *
     *
     * @var Details
     */
    #[Serializer\Expose]
    #[Serializer\SerializedName('PRODUCT_DETAILS')]
    #[Serializer\Type(\Naugrim\BMEcat\Nodes\Product\Details::class)]
    protected \Naugrim\BMEcat\Nodes\Product\Details $details;


    /**
     *
     *
     * @var Features[]
     */
    #[Serializer\Expose]
    #[Serializer\Type('array<Naugrim\BMEcat\Nodes\Product\Features>')]
    #[Serializer\XmlList(inline: true, entry: 'PRODUCT_FEATURES')]
    protected array $features = [];

    /**
     *
     * @var OrderDetails
     */
    #[Serializer\Expose]
    #[Serializer\SerializedName('PRODUCT_ORDER_DETAILS')]
    #[Serializer\Type(\Naugrim\BMEcat\Nodes\Product\OrderDetails::class)]
    protected \Naugrim\BMEcat\Nodes\Product\OrderDetails $orderDetails;

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
    #[Serializer\Type(\Naugrim\BMEcat\Nodes\Product\LogisticDetails::class)]
    protected \Naugrim\BMEcat\Nodes\Product\LogisticDetails $logisticDetails;

    /**
     *
     * @var ConfigDetails
     */
    #[Serializer\Expose]
    #[Serializer\SerializedName('PRODUCT_CONFIG_DETAILS')]
    #[Serializer\Type(\Naugrim\BMEcat\Nodes\Product\ConfigDetails::class)]
    protected \Naugrim\BMEcat\Nodes\Product\ConfigDetails $configDetails;

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
    public function getDetails(): \Naugrim\BMEcat\Nodes\Product\Details
    {
        return $this->details;
    }

    /**
     *
     * @param PriceDetails[] $priceDetails
     * @return Product
     * @throws InvalidSetterException
     * @throws UnknownKeyException
     */
    public function setPriceDetails(array $priceDetails) : Product
    {
        $this->priceDetails = [];
        foreach ($priceDetails as $priceDetail) {
            if (is_array($priceDetail)) {
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
        if ($this->priceDetails === null) {
            $this->priceDetails = [];
        }

        $this->priceDetails[] = $price;
        return $this;
    }

    /**
     * @param Mime[] $mimes
     * @return Product
     * @throws InvalidSetterException
     * @throws UnknownKeyException
     */
    public function setMimes(array $mimes): Product
    {
        $this->mimes = [];
        foreach ($mimes as $mime) {
            if (is_array($mime)) {
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
        if ($this->mimes === null) {
            $this->mimes = [];
        }

        $this->mimes[] = $mime;
        return $this;
    }

    /**
     *
     * @return Product
     */
    #[Serializer\PreSerialize]
    #[Serializer\PostSerialize]
    public function nullPriceDetails() : Product
    {
        if ($this->priceDetails === []) {
            $this->priceDetails = null;
        }

        return $this;
    }

    /**
     *
     * @return Product
     */
    #[Serializer\PreSerialize]
    #[Serializer\PostSerialize]
    public function nullMime() : Product
    {
        if ($this->mimes === []) {
            $this->mimes = null;
        }

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

    /**
     * @return OrderDetails|null
     */
    public function getOrderDetails(): \Naugrim\BMEcat\Nodes\Product\OrderDetails
    {
        return $this->orderDetails;
    }

    /**
     * @param OrderDetails $orderDetails
     * @return Product
     */
    public function setOrderDetails(OrderDetails $orderDetails) : Product
    {
        $this->orderDetails = $orderDetails;
        return $this;
    }

    /**
     *
     * @return SupplierPid
     */
    public function getId(): \Naugrim\BMEcat\Nodes\SupplierPid
    {
        return $this->id;
    }

    /**
     *
     * @return Product
     */
    #[Serializer\PreSerialize]
    #[Serializer\PostSerialize]
    public function nullFeatures() : Product
    {
        if ($this->features === []) {
            $this->features = null;
        }

        return $this;
    }

    /**
     * @param Features[] $features
     * @return Product
     * @throws InvalidSetterException
     * @throws UnknownKeyException
     */
    public function setFeatures(array $features): Product
    {
        $this->features = [];
        foreach ($features as $feature) {
            if (is_array($feature)) {
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
        if ($this->features === null) {
            $this->features = [];
        }

        $this->features [] = $features;
        return $this;
    }

    /**
     *
     * @return Features[]
     */
    public function getFeatures()
    {
        if ($this->features === null) {
            return [];
        }

        return $this->features;
    }

    /**
     *
     * @return PriceDetails[]
     */
    public function getPriceDetails()
    {
        if ($this->priceDetails === null) {
            return [];
        }

        return $this->priceDetails;
    }

    /**
     * @return Mime[]|null
     */
    public function getMimes(): array
    {
        return $this->mimes;
    }
}
