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
