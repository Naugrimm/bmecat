<?php

namespace Naugrim\BMEcat\Nodes\Product\Config;

use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Nodes\Contracts;
use Naugrim\BMEcat\Nodes\Contracts\NodeInterface;
use Naugrim\BMEcat\Nodes\Product\PriceDetails;

/**
 * @implements NodeInterface<self>
 */
#[Serializer\XmlRoot('PART_ALTERNATIVE')]
class PartAlternative implements Contracts\NodeInterface
{
    use \Naugrim\BMEcat\Nodes\Concerns\HasSerializableAttributes;
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('SUPPLIER_PIDREF')]
    protected string $supplierPidRef;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('SUPPLIER_IDREF')]
    protected ?string $supplierIdRef = null;

    #[Serializer\Expose]
    #[Serializer\Type('int')]
    #[Serializer\SerializedName('PRODUCT_ORDER')]
    #[Serializer\XmlElement(cdata: false)]
    protected int $order;

    #[Serializer\Expose]
    #[Serializer\Type('bool')]
    #[Serializer\SerializedName('DEFAULT_FLAG')]
    protected ?bool $defaultFlag = null;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('CONFIG_CODE')]
    protected ?string $code = null;

    #[Serializer\Expose]
    #[Serializer\SerializedName('PRODUCT_PRICE_DETAILS')]
    #[Serializer\Type(PriceDetails::class)]
    protected ?PriceDetails $priceDetails = null;

    public function setSupplierPidRef(string $supplier_pid_ref): self
    {
        $this->supplier_pid_ref = $supplier_pid_ref;
        return $this;
    }

    public function getSupplierPidRef(): string
    {
        return $this->supplier_pid_ref;
    }

    public function setSupplierIdRef(?string $supplier_id_ref): self
    {
        $this->supplier_id_ref = $supplier_id_ref;
        return $this;
    }

    public function getSupplierIdRef(): ?string
    {
        return $this->supplier_id_ref;
    }

    public function setDefaultFlag(?bool $default_flag): self
    {
        $this->default_flag = $default_flag;
        return $this;
    }

    public function getDefaultFlag(): ?bool
    {
        return $this->default_flag;
    }
}
