<?php


namespace Naugrim\BMEcat\Nodes\Product;

use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Nodes\BuyerPid;
use Naugrim\BMEcat\Nodes\Contracts;
use Naugrim\BMEcat\Nodes\SpecialTreatmentClass;


#[Serializer\XmlRoot('PRODUCT_DETAILS')]
class Details implements Contracts\NodeInterface
{
    /**
     *
     *
     * @var string
     */
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('DESCRIPTION_SHORT')]
    protected string $descriptionShort = '';

    /**
     *
     *
     * @var string
     */
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('DESCRIPTION_LONG')]
    protected string $descriptionLong;

    /**
     *
     *
     * @var string
     */
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('EAN')]
    protected string $ean;

    /**
     *
     *
     * @var string
     */
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('SUPPLIER_ALT_PID')]
    protected string $supplierAltPid;

    /**
     *
     *
     * @var BuyerPid[]
     */
    #[Serializer\Expose]
    #[Serializer\Type('array<Naugrim\BMEcat\Nodes\BuyerPidNode>')]
    #[Serializer\XmlList(inline: true, entry: 'BUYER_PID')]
    protected array $buyerPids;

    /**
     *
     * @var string
     */
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('MANUFACTURER_PID')]
    protected string $manufacturerPid;

    /**
     *
     *
     * @var string
     */
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('MANUFACTURER_IDREF')]
    protected string $manufacturerIDRef;

    /**
     *
     *
     * @var string
     */
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('MANUFACTURER_NAME')]
    protected string $manufacturerName;

    /**
     *
     *
     * @var string
     */
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('MANUFACTURER_TYPE_DESCR')]
    protected string $manufacturerTypeDescription;

    /**
     *
     *
     * @var string
     */
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('ERP_GROUP_BUYER')]
    protected string $erpGroupBuyer;

    /**
     *
     *
     * @var string
     */
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('ERP_GROUP_SUPPLIER')]
    protected string $erpGroupSupplier;

    /**
     *
     *
     * @var float
     */
    #[Serializer\Expose]
    #[Serializer\Type('float')]
    #[Serializer\SerializedName('DELIVERY_TIME')]
    #[Serializer\XmlElement(cdata: false)]
    protected float $deliveryTime;

    /**
     *
     *
     * @var SpecialTreatmentClass[]
     */
    #[Serializer\Expose]
    #[Serializer\Type('array<Naugrim\BMEcat\Nodes\SpecialTreatmentClass>')]
    #[Serializer\XmlList(inline: true, entry: 'SPECIAL_TREATMENT_CLASS')]
    protected array $specialTreatmentClasses;

    /**
     *
     *
     * @var Keyword[]
     */
    #[Serializer\Expose]
    #[Serializer\Type('array<Naugrim\BMEcat\Nodes\Product\Keyword>')]
    #[Serializer\XmlList(inline: true, entry: 'KEYWORD')]
    protected array $keywords;

    /**
     *
     *
     * @var string
     */
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('REMARKS')]
    protected string $remarks;

    /**
     *
     *
     * @var string
     */
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('SEGMENT')]
    protected string $segment;

    /**
     *
     *
     * @var int
     */
    #[Serializer\Expose]
    #[Serializer\Type('int')]
    #[Serializer\SerializedName('PRODUCT_ORDER')]
    #[Serializer\XmlElement(cdata: false)]
    protected int $productOrder;

    /**
     *
     *
     * @var Status[]
     */
    #[Serializer\Expose]
    #[Serializer\Type('array<Naugrim\BMEcat\Nodes\Product\Status>')]
    #[Serializer\XmlList(inline: true, entry: 'PRODUCT_STATUS')]
    protected array $productStatus;

    /**
     *
     *
     * @var string[]
     */
    #[Serializer\Expose]
    #[Serializer\Type('array<string>')]
    #[Serializer\XmlList(inline: true, entry: 'PRODUCT_TYPE')]
    protected array $productTypes;

    /**
     * @param BuyerPid $buyerAid
     * @return Details
     */
    public function addBuyerPid(BuyerPid $buyerAid) : Details
    {
        if ($this->buyerPids === null) {
            $this->buyerPids = [];
        }

        $this->buyerPids[] = $buyerAid;
        return $this;
    }

    /**
     * @param SpecialTreatmentClass $specialTreatmentClass
     * @return Details
     */
    public function addSpecialTreatmentClass(SpecialTreatmentClass $specialTreatmentClass) : Details
    {
        if ($this->specialTreatmentClasses === null) {
            $this->specialTreatmentClasses = [];
        }

        $this->specialTreatmentClasses[] = $specialTreatmentClass;
        return $this;
    }

    /**
     * @param Keyword $keyword
     * @return Details
     */
    public function addKeyword(Keyword $keyword) : Details
    {
        if ($this->keywords === null) {
            $this->keywords = [];
        }

        $this->keywords[] = $keyword;
        return $this;
    }

    /**
     * @param Status $productStatus
     * @return Details
     */
    public function addProductStatus(Status $productStatus) : Details
    {
        if ($this->productStatus === null) {
            $this->productStatus = [];
        }

        $this->productStatus[] = $productStatus;
        return $this;
    }

    /**
     *
     * @return Details
     */
    #[Serializer\PreSerialize]
    #[Serializer\PostSerialize]
    public function nullBuyerPids() : Details
    {
        if ($this->buyerPids === []) {
            $this->buyerPids = null;
        }

        return $this;
    }

    /**
     *
     * @return Details
     */
    #[Serializer\PreSerialize]
    #[Serializer\PostSerialize]
    public function nullSpecialTreatmentClasses() : Details
    {
        if ($this->specialTreatmentClasses === []) {
            $this->specialTreatmentClasses = null;
        }

        return $this;
    }

    /**
     *
     * @return Details
     */
    #[Serializer\PreSerialize]
    #[Serializer\PostSerialize]
    public function nullKeywords() : Details
    {
        if ($this->keywords === []) {
            $this->keywords = null;
        }

        return $this;
    }

    /**
     *
     * @return Details
     */
    #[Serializer\PreSerialize]
    #[Serializer\PostSerialize]
    public function nullProductStatus() : Details
    {
        if ($this->productStatus === []) {
            $this->productStatus = null;
        }

        return $this;
    }

    /**
     * @param string $descriptionShort
     * @return Details
     */
    public function setDescriptionShort(string $descriptionShort) : Details
    {
        $this->descriptionShort = $descriptionShort;
        return $this;
    }

    /**
     * @param string $descriptionLong
     * @return Details
     */
    public function setDescriptionLong(string $descriptionLong) : Details
    {
        $this->descriptionLong = $descriptionLong;
        return $this;
    }

    /**
     * @param string $ean
     * @return Details
     */
    public function setEan(string $ean) : Details
    {
        $this->ean = $ean;
        return $this;
    }

    /**
     * @param string $supplierAltPid
     * @return Details
     */
    public function setSupplierAltPid(string $supplierAltPid) : Details
    {
        $this->supplierAltPid = $supplierAltPid;
        return $this;
    }

    /**
     * @param string $manufacturerPid
     * @return Details
     */
    public function setManufacturerPid(string $manufacturerPid) : Details
    {
        $this->manufacturerPid = $manufacturerPid;
        return $this;
    }

    /**
     * @param string $manufacturerName
     * @return Details
     */
    public function setManufacturerName(string $manufacturerName) : Details
    {
        $this->manufacturerName = $manufacturerName;
        return $this;
    }

    /**
     * @param string $manufacturerTypeDescription
     * @return Details
     */
    public function setManufacturerTypeDescription(string $manufacturerTypeDescription) : Details
    {
        $this->manufacturerTypeDescription = $manufacturerTypeDescription;
        return $this;
    }

    /**
     * @param string $erpGroupBuyer
     * @return Details
     */
    public function setErpGroupBuyer(string $erpGroupBuyer) : Details
    {
        $this->erpGroupBuyer = $erpGroupBuyer;
        return $this;
    }

    /**
     * @param string $erpGroupSupplier
     * @return Details
     */
    public function setErpGroupSupplier(string $erpGroupSupplier) : Details
    {
        $this->erpGroupSupplier = $erpGroupSupplier;
        return $this;
    }

    /**
     * @param float $deliveryTime
     * @return Details
     */
    public function setDeliveryTime(float $deliveryTime) : Details
    {
        $this->deliveryTime = $deliveryTime;
        return $this;
    }

    /**
     * @param string $remarks
     * @return Details
     */
    public function setRemarks(string $remarks) : Details
    {
        $this->remarks = $remarks;
        return $this;
    }

    /**
     * @param int $productOrder
     * @return Details
     */
    public function setProductOrder(int $productOrder) : Details
    {
        $this->productOrder = $productOrder;
        return $this;
    }

    /**
     * @param string $segment
     * @return Details
     */
    public function setSegment(string $segment) : Details
    {
        $this->segment = $segment;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescriptionLong(): string
    {
        return $this->descriptionLong;
    }

    /**
     * @return string
     */
    public function getDescriptionShort(): string
    {
        return $this->descriptionShort;
    }

    /**
     * @return string
     */
    public function getEan(): string
    {
        return $this->ean;
    }

    /**
     * @return string
     */
    public function getManufacturerName(): string
    {
        return $this->manufacturerName;
    }

    /**
     * @return string
     */
    public function getSegment(): string
    {
        return $this->segment;
    }

    /**
     * @return string
     */
    public function getSupplierAltPid(): string
    {
        return $this->supplierAltPid;
    }

    /**
     * @return BuyerPid[]
     */
    public function getBuyerPids()
    {
        if ($this->buyerPids === null) {
            return [];
        }

        return $this->buyerPids;
    }

    /**
     * @return string
     */
    public function getManufacturerPid(): string
    {
        return $this->manufacturerPid;
    }

    /**
     * @return string
     */
    public function getManufacturerTypeDescription(): string
    {
        return $this->manufacturerTypeDescription;
    }

    /**
     * @return string
     */
    public function getErpGroupBuyer(): string
    {
        return $this->erpGroupBuyer;
    }

    /**
     * @return string
     */
    public function getErpGroupSupplier(): string
    {
        return $this->erpGroupSupplier;
    }

    /**
     * @return float
     */
    public function getDeliveryTime(): float
    {
        return $this->deliveryTime;
    }

    /**
     * @return SpecialTreatmentClass[]
     */
    public function getSpecialTreatmentClasses()
    {
        if ($this->specialTreatmentClasses === null) {
            return [];
        }

        return $this->specialTreatmentClasses;
    }

    /**
     * @return Keyword[]
     */
    public function getKeywords()
    {
        if ($this->keywords === null) {
            return [];
        }

        return $this->keywords;
    }

    /**
     * @return string
     */
    public function getRemarks(): string
    {
        return $this->remarks;
    }

    /**
     * @return int
     */
    public function getProductOrder(): int
    {
        return $this->productOrder;
    }

    /**
     * @return Status[]
     */
    public function getProductStatus()
    {
        if ($this->productStatus === null) {
            return [];
        }

        return $this->productStatus;
    }
}
