<?php


namespace Naugrim\BMEcat\Nodes\Product;

use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Nodes\BuyerPid;
use Naugrim\BMEcat\Nodes\Contracts;
use Naugrim\BMEcat\Nodes\SpecialTreatmentClass;

/**
 *
 * @Serializer\XmlRoot("PRODUCT_DETAILS")
 */
class Details implements Contracts\NodeInterface
{
    /**
     *
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("DESCRIPTION_SHORT")
     *
     * @var string
     */
    protected $descriptionShort = '';

    /**
     *
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("DESCRIPTION_LONG")
     *
     * @var string
     */
    protected $descriptionLong;

    /**
     *
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("EAN")
     *
     * @var string
     */
    protected $ean;

    /**
     *
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("SUPPLIER_ALT_PID")
     *
     * @var string
     */
    protected $supplierAltPid;

    /**
     *
     * @Serializer\Expose
     * @Serializer\Type("array<Naugrim\BMEcat\Nodes\BuyerPidNode>")
     * @Serializer\XmlList(inline=true, entry="BUYER_PID")
     *
     * @var BuyerPid[]
     */
    protected $buyerPids;

    /**
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("MANUFACTURER_PID")
     *
     * @var string
     */
    protected $manufacturerPid;

    /**
     *
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("MANUFACTURER_IDREF")
     *
     * @var string
     */
    protected $manufacturerIDRef;

    /**
     *
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("MANUFACTURER_NAME")
     *
     * @var string
     */
    protected $manufacturerName;

    /**
     *
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("MANUFACTURER_TYPE_DESCR")
     *
     * @var string
     */
    protected $manufacturerTypeDescription;

    /**
     *
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("ERP_GROUP_BUYER")
     *
     * @var string
     */
    protected $erpGroupBuyer;

    /**
     *
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("ERP_GROUP_SUPPLIER")
     *
     * @var string
     */
    protected $erpGroupSupplier;

    /**
     *
     * @Serializer\Expose
     * @Serializer\Type("float")
     * @Serializer\SerializedName("DELIVERY_TIME")
     * @Serializer\XmlElement(cdata=false)
     *
     * @var float
     */
    protected $deliveryTime;

    /**
     *
     * @Serializer\Expose
     * @Serializer\Type("array<Naugrim\BMEcat\Nodes\SpecialTreatmentClass>")
     * @Serializer\XmlList(inline=true, entry="SPECIAL_TREATMENT_CLASS")
     *
     * @var SpecialTreatmentClass[]
     */
    protected $specialTreatmentClasses;

    /**
     *
     * @Serializer\Expose
     * @Serializer\Type("array<Naugrim\BMEcat\Nodes\Product\Keyword>")
     * @Serializer\XmlList(inline=true, entry="KEYWORD")
     *
     * @var Keyword[]
     */
    protected $keywords;

    /**
     *
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("REMARKS")
     *
     * @var string
     */
    protected $remarks;

    /**
     *
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("SEGMENT")
     *
     * @var string
     */
    protected $segment;

    /**
     *
     * @Serializer\Expose
     * @Serializer\Type("int")
     * @Serializer\SerializedName("PRODUCT_ORDER")
     * @Serializer\XmlElement(cdata=false)
     *
     * @var int
     */
    protected $productOrder;

    /**
     *
     * @Serializer\Expose
     * @Serializer\Type("array<Naugrim\BMEcat\Nodes\Product\Status>")
     * @Serializer\XmlList(inline=true, entry="PRODUCT_STATUS")
     *
     * @var Status[]
     */
    protected $productStatus;

    /**
     *
     * @Serializer\Expose
     * @Serializer\Type("array<string>")
     * @Serializer\XmlList(inline=true, entry="PRODUCT_TYPE")
     *
     * @var string[]
     */
    protected $productTypes;

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
     * @Serializer\PreSerialize
     * @Serializer\PostSerialize
     * @return Details
     */
    public function nullBuyerPids() : Details
    {
        if (empty($this->buyerPids) === true) {
            $this->buyerPids = null;
        }

        return $this;
    }

    /**
     *
     * @Serializer\PreSerialize
     * @Serializer\PostSerialize
     * @return Details
     */
    public function nullSpecialTreatmentClasses() : Details
    {
        if (empty($this->specialTreatmentClasses) === true) {
            $this->specialTreatmentClasses = null;
        }
        return $this;
    }

    /**
     *
     * @Serializer\PreSerialize
     * @Serializer\PostSerialize
     * @return Details
     */
    public function nullKeywords() : Details
    {
        if (empty($this->keywords) === true) {
            $this->keywords = null;
        }
        return $this;
    }

    /**
     *
     * @Serializer\PreSerialize
     * @Serializer\PostSerialize
     * @return Details
     */
    public function nullProductStatus() : Details
    {
        if (empty($this->productStatus) === true) {
            $this->productStatus = null;
        }
        return $this;
    }

    /**
     * @param string $descriptionShort
     * @return Details
     */
    public function setDescriptionShort($descriptionShort) : Details
    {
        $this->descriptionShort = $descriptionShort;
        return $this;
    }

    /**
     * @param string $descriptionLong
     * @return Details
     */
    public function setDescriptionLong($descriptionLong) : Details
    {
        $this->descriptionLong = $descriptionLong;
        return $this;
    }

    /**
     * @param string $ean
     * @return Details
     */
    public function setEan($ean) : Details
    {
        $this->ean = $ean;
        return $this;
    }

    /**
     * @param string $supplierAltPid
     * @return Details
     */
    public function setSupplierAltPid($supplierAltPid) : Details
    {
        $this->supplierAltPid = $supplierAltPid;
        return $this;
    }

    /**
     * @param string $manufacturerPid
     * @return Details
     */
    public function setManufacturerPid($manufacturerPid) : Details
    {
        $this->manufacturerPid = $manufacturerPid;
        return $this;
    }

    /**
     * @param string $manufacturerName
     * @return Details
     */
    public function setManufacturerName($manufacturerName) : Details
    {
        $this->manufacturerName = $manufacturerName;
        return $this;
    }

    /**
     * @param string $manufacturerTypeDescription
     * @return Details
     */
    public function setManufacturerTypeDescription($manufacturerTypeDescription) : Details
    {
        $this->manufacturerTypeDescription = $manufacturerTypeDescription;
        return $this;
    }

    /**
     * @param string $erpGroupBuyer
     * @return Details
     */
    public function setErpGroupBuyer($erpGroupBuyer) : Details
    {
        $this->erpGroupBuyer = $erpGroupBuyer;
        return $this;
    }

    /**
     * @param string $erpGroupSupplier
     * @return Details
     */
    public function setErpGroupSupplier($erpGroupSupplier) : Details
    {
        $this->erpGroupSupplier = $erpGroupSupplier;
        return $this;
    }

    /**
     * @param float $deliveryTime
     * @return Details
     */
    public function setDeliveryTime($deliveryTime) : Details
    {
        $this->deliveryTime = $deliveryTime;
        return $this;
    }

    /**
     * @param string $remarks
     * @return Details
     */
    public function setRemarks($remarks) : Details
    {
        $this->remarks = $remarks;
        return $this;
    }

    /**
     * @param int $productOrder
     * @return Details
     */
    public function setProductOrder($productOrder) : Details
    {
        $this->productOrder = $productOrder;
        return $this;
    }

    /**
     * @param string $segment
     * @return Details
     */
    public function setSegment($segment) : Details
    {
        $this->segment = $segment;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescriptionLong()
    {
        return $this->descriptionLong;
    }

    /**
     * @return string
     */
    public function getDescriptionShort()
    {
        return $this->descriptionShort;
    }

    /**
     * @return string
     */
    public function getEan()
    {
        return $this->ean;
    }

    /**
     * @return string
     */
    public function getManufacturerName()
    {
        return $this->manufacturerName;
    }

    /**
     * @return string
     */
    public function getSegment()
    {
        return $this->segment;
    }

    /**
     * @return string
     */
    public function getSupplierAltPid()
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
    public function getManufacturerPid()
    {
        return $this->manufacturerPid;
    }

    /**
     * @return string
     */
    public function getManufacturerTypeDescription()
    {
        return $this->manufacturerTypeDescription;
    }

    /**
     * @return string
     */
    public function getErpGroupBuyer()
    {
        return $this->erpGroupBuyer;
    }

    /**
     * @return string
     */
    public function getErpGroupSupplier()
    {
        return $this->erpGroupSupplier;
    }

    /**
     * @return float
     */
    public function getDeliveryTime()
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
    public function getRemarks()
    {
        return $this->remarks;
    }

    /**
     * @return int
     */
    public function getProductOrder()
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
