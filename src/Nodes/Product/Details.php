<?php

namespace Naugrim\BMEcat\Nodes\Product;

use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Nodes\BuyerPid;
use Naugrim\BMEcat\Nodes\Contracts;
use Naugrim\BMEcat\Nodes\Contracts\NodeInterface;
use Naugrim\BMEcat\Nodes\SpecialTreatmentClass;

/**
 * @implements NodeInterface<self>
 * @method self setDescriptionShort(string|null $descriptionShort)
 * @method string|null getDescriptionShort()
 * @method self setDescriptionLong(string|null $descriptionLong)
 * @method string|null getDescriptionLong()
 * @method self setEan(string|null $ean)
 * @method string|null getEan()
 * @method self setSupplierAltPid(string|null $supplierAltPid)
 * @method string|null getSupplierAltPid()
 * @method self setBuyerPids(\Naugrim\BMEcat\Nodes\BuyerPidNode[]|array<string, mixed> $buyerPids)
 * @method \Naugrim\BMEcat\Nodes\BuyerPidNode[] getBuyerPids()
 * @method self setManufacturerPid(string|null $manufacturerPid)
 * @method string|null getManufacturerPid()
 * @method self setManufacturerIDRef(string|null $manufacturerIDRef)
 * @method string|null getManufacturerIDRef()
 * @method self setManufacturerName(string|null $manufacturerName)
 * @method string|null getManufacturerName()
 * @method self setManufacturerTypeDescription(string|null $manufacturerTypeDescription)
 * @method string|null getManufacturerTypeDescription()
 * @method self setErpGroupBuyer(string|null $erpGroupBuyer)
 * @method string|null getErpGroupBuyer()
 * @method self setErpGroupSupplier(string|null $erpGroupSupplier)
 * @method string|null getErpGroupSupplier()
 * @method self setDeliveryTime(float|null $deliveryTime)
 * @method float|null getDeliveryTime()
 * @method self setSpecialTreatmentClasses(\Naugrim\BMEcat\Nodes\SpecialTreatmentClass[]|array<string, mixed> $specialTreatmentClasses)
 * @method \Naugrim\BMEcat\Nodes\SpecialTreatmentClass[] getSpecialTreatmentClasses()
 * @method self setKeywords(\Naugrim\BMEcat\Nodes\Product\Keyword[]|array<string, mixed> $keywords)
 * @method \Naugrim\BMEcat\Nodes\Product\Keyword[] getKeywords()
 * @method self setRemarks(string|null $remarks)
 * @method string|null getRemarks()
 * @method self setSegment(string|null $segment)
 * @method string|null getSegment()
 * @method self setProductOrder(int|null $productOrder)
 * @method int|null getProductOrder()
 * @method self setProductStatus(\Naugrim\BMEcat\Nodes\Product\Status[]|array<string, mixed> $productStatus)
 * @method \Naugrim\BMEcat\Nodes\Product\Status[] getProductStatus()
 * @method self setProductTypes(string[] $productTypes)
 * @method string[] getProductTypes()
 */
#[Serializer\XmlRoot('PRODUCT_DETAILS')]
class Details implements Contracts\NodeInterface
{
    use \Naugrim\BMEcat\Nodes\Concerns\HasSerializableAttributes;
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('DESCRIPTION_SHORT')]
    protected ?string $descriptionShort = null;

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
    protected ?string $manufacturerIDRef = null;

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

    #[Serializer\Expose]
    #[Serializer\Type('float')]
    #[Serializer\SerializedName('DELIVERY_TIME')]
    #[Serializer\XmlElement(cdata: false)]
    protected ?float $deliveryTime = null;

    /**
     * @var SpecialTreatmentClass[]
     */
    #[Serializer\Expose]
    #[Serializer\Type('array<Naugrim\BMEcat\Nodes\SpecialTreatmentClass>')]
    #[Serializer\XmlList(entry: 'SPECIAL_TREATMENT_CLASS', inline: true)]
    protected array $specialTreatmentClasses = [];

    /**
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

    public function addBuyerPid(BuyerPid $buyerAid): self
    {
        $this->buyerPids[] = $buyerAid;
        return $this;
    }

    public function addSpecialTreatmentClass(SpecialTreatmentClass $specialTreatmentClass): self
    {
        $this->specialTreatmentClasses[] = $specialTreatmentClass;
        return $this;
    }

    public function addKeyword(Keyword $keyword): self
    {
        $this->keywords[] = $keyword;
        return $this;
    }

    public function addProductStatus(Status $productStatus): self
    {
        $this->productStatus[] = $productStatus;
        return $this;
    }

    #[Serializer\PreSerialize]
    #[Serializer\PostSerialize]
    public function nullBuyerPids(): self
    {
        return $this;
    }

    #[Serializer\PreSerialize]
    #[Serializer\PostSerialize]
    public function nullSpecialTreatmentClasses(): self
    {
        return $this;
    }

    #[Serializer\PreSerialize]
    #[Serializer\PostSerialize]
    public function nullKeywords(): self
    {
        return $this;
    }

    #[Serializer\PreSerialize]
    #[Serializer\PostSerialize]
    public function nullProductStatus(): self
    {
        return $this;
    }
}
