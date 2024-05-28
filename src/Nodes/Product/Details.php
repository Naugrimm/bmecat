<?php


namespace Naugrim\BMEcat\Nodes\Product;

use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Nodes\BuyerPid;
use Naugrim\BMEcat\Nodes\Contracts;
use Naugrim\BMEcat\Nodes\Contracts\NodeInterface;
use Naugrim\BMEcat\Nodes\SpecialTreatmentClass;

/**
 * @implements NodeInterface<self>
 */
#[Serializer\XmlRoot('PRODUCT_DETAILS')]
class Details implements Contracts\NodeInterface
{
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('DESCRIPTION_SHORT')]
    protected ?string $descriptionShort;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('DESCRIPTION_LONG')]
    protected ?string $descriptionLong = null;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('EAN')]
    protected ?string $ean = null;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('SUPPLIER_ALT_PID')]
    protected ?string $supplierAltPid = null;

    /**
     *
     *
     * @var BuyerPid[]
     */
    #[Serializer\Expose]
    #[Serializer\Type('array<Naugrim\BMEcat\Nodes\BuyerPidNode>')]
    #[Serializer\XmlList(entry: 'BUYER_PID', inline: true)]
    protected array $buyerPids = [];

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('MANUFACTURER_PID')]
    protected ?string $manufacturerPid = null;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('MANUFACTURER_IDREF')]
    protected ?string $manufacturerIDRef;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('MANUFACTURER_NAME')]
    protected ?string $manufacturerName = null;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('MANUFACTURER_TYPE_DESCR')]
    protected ?string $manufacturerTypeDescription = null;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('ERP_GROUP_BUYER')]
    protected ?string $erpGroupBuyer = null;


    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('ERP_GROUP_SUPPLIER')]
    protected ?string $erpGroupSupplier = null;

    /**
     *
     *
     * @var float
     */
    #[Serializer\Expose]
    #[Serializer\Type('float')]
    #[Serializer\SerializedName('DELIVERY_TIME')]
    #[Serializer\XmlElement(cdata: false)]
    protected ?float $deliveryTime = null;

    /**
     *
     *
     * @var SpecialTreatmentClass[]
     */
    #[Serializer\Expose]
    #[Serializer\Type('array<Naugrim\BMEcat\Nodes\SpecialTreatmentClass>')]
    #[Serializer\XmlList(entry: 'SPECIAL_TREATMENT_CLASS', inline: true)]
    protected array $specialTreatmentClasses = [];

    /**
     *
     *
     * @var Keyword[]
     */
    #[Serializer\Expose]
    #[Serializer\Type('array<Naugrim\BMEcat\Nodes\Product\Keyword>')]
    #[Serializer\XmlList(entry: 'KEYWORD', inline: true)]
    protected array $keywords = [];


    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('REMARKS')]
    protected ?string $remarks = null;


    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('SEGMENT')]
    protected ?string $segment = null;


    #[Serializer\Expose]
    #[Serializer\Type('int')]
    #[Serializer\SerializedName('PRODUCT_ORDER')]
    #[Serializer\XmlElement(cdata: false)]
    protected ?int $productOrder = null;

    /**
     *
     *
     * @var Status[]
     */
    #[Serializer\Expose]
    #[Serializer\Type('array<Naugrim\BMEcat\Nodes\Product\Status>')]
    #[Serializer\XmlList(entry: 'PRODUCT_STATUS', inline: true)]
    protected array $productStatus = [];

    /**
     * @var string[]
     */
    #[Serializer\Expose]
    #[Serializer\Type('array<string>')]
    #[Serializer\XmlList(entry: 'PRODUCT_TYPE', inline: true)]
    protected array $productTypes = [];

    /**
     * @param BuyerPid $buyerAid
     * @return Details
     */
    public function addBuyerPid(BuyerPid $buyerAid) : Details
    {
        $this->buyerPids[] = $buyerAid;
        return $this;
    }

    /**
     * @param SpecialTreatmentClass $specialTreatmentClass
     * @return Details
     */
    public function addSpecialTreatmentClass(SpecialTreatmentClass $specialTreatmentClass) : Details
    {
        $this->specialTreatmentClasses[] = $specialTreatmentClass;
        return $this;
    }

    /**
     * @param Keyword $keyword
     * @return Details
     */
    public function addKeyword(Keyword $keyword) : Details
    {
        $this->keywords[] = $keyword;
        return $this;
    }

    /**
     * @param Status $productStatus
     * @return Details
     */
    public function addProductStatus(Status $productStatus) : Details
    {
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

    public function getDescriptionLong(): ?string
    {
        return $this->descriptionLong;
    }


    public function getDescriptionShort(): ?string
    {
        return $this->descriptionShort;
    }


    public function getEan(): ?string
    {
        return $this->ean;
    }


    public function getManufacturerName(): ?string
    {
        return $this->manufacturerName;
    }


    public function getSegment(): ?string
    {
        return $this->segment;
    }


    public function getSupplierAltPid(): ?string
    {
        return $this->supplierAltPid;
    }

    /**
     * @return BuyerPid[]
     */
    public function getBuyerPids() : array
    {
        return $this->buyerPids;
    }


    public function getManufacturerPid(): ?string
    {
        return $this->manufacturerPid;
    }


    public function getManufacturerTypeDescription(): ?string
    {
        return $this->manufacturerTypeDescription;
    }


    public function getErpGroupBuyer(): ?string
    {
        return $this->erpGroupBuyer;
    }


    public function getErpGroupSupplier(): ?string
    {
        return $this->erpGroupSupplier;
    }

    public function getDeliveryTime(): ?float
    {
        return $this->deliveryTime;
    }

    /**
     * @return SpecialTreatmentClass[]
     */
    public function getSpecialTreatmentClasses() : array
    {
        return $this->specialTreatmentClasses;
    }

    /**
     * @return Keyword[]
     */
    public function getKeywords() : array
    {
        return $this->keywords;
    }


    public function getRemarks(): ?string
    {
        return $this->remarks;
    }

    public function getProductOrder(): ?int
    {
        return $this->productOrder;
    }

    /**
     * @return Status[]
     */
    public function getProductStatus() : array
    {
        return $this->productStatus;
    }
}
