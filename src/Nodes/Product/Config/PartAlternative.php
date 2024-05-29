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
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('SUPPLIER_PIDREF')]
    protected string $supplier_pid_ref;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('SUPPLIER_IDREF')]
    protected ?string $supplier_id_ref = null;

    #[Serializer\Expose]
    #[Serializer\Type('int')]
    #[Serializer\SerializedName('PRODUCT_ORDER')]
    #[Serializer\XmlElement(cdata: false)]
    protected int $order;

    #[Serializer\Expose]
    #[Serializer\Type('bool')]
    #[Serializer\SerializedName('DEFAULT_FLAG')]
    protected ?bool $default_flag = null;

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

    public function setOrder(int $order): self
    {
        $this->order = $order;
        return $this;
    }

    public function getOrder(): int
    {
        return $this->order;
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

    public function setCode(?string $code): self
    {
        $this->code = $code;
        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setPriceDetails(?PriceDetails $priceDetails): self
    {
        $this->priceDetails = $priceDetails;
        return $this;
    }

    public function getPriceDetails(): ?PriceDetails
    {
        return $this->priceDetails;
    }
}
