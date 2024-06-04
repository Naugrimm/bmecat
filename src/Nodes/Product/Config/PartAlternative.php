<?php

namespace Naugrim\BMEcat\Nodes\Product\Config;

use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Nodes\Contracts;
use Naugrim\BMEcat\Nodes\Contracts\NodeInterface;
use Naugrim\BMEcat\Nodes\Product\PriceDetails;

/**
 * @implements NodeInterface<self>
 * @method self setSupplierPidRef(string $supplierPidRef)
 * @method string getSupplierPidRef()
 * @method self setSupplierIdRef(string|null $supplierIdRef)
 * @method string|null getSupplierIdRef()
 * @method self setOrder(int $order)
 * @method int getOrder()
 * @method self setDefaultFlag(bool|null $defaultFlag)
 * @method bool|null getDefaultFlag()
 * @method self setCode(string|null $code)
 * @method string|null getCode()
 * @method self setPriceDetails(null|array|\Naugrim\BMEcat\Nodes\Product\PriceDetails $priceDetails)
 * @method \Naugrim\BMEcat\Nodes\Product\PriceDetails|null getPriceDetails()
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
}
