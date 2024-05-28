<?php

namespace Naugrim\BMEcat\Nodes\Product\Config;


use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Nodes\Contracts;
use Naugrim\BMEcat\Nodes\Product\PriceDetails;


#[Serializer\XmlRoot('PART_ALTERNATIVE')]
class PartAlternative implements Contracts\NodeInterface
{
    /**
     *
     *
     * @var string
     */
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('SUPPLIER_PIDREF')]
    protected string $supplier_pid_ref;

    /**
     *
     *
     * @var string
     */
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('SUPPLIER_IDREF')]
    protected string $supplier_id_ref = null;

    /**
     *
     *
     * @var int
     */
    #[Serializer\Expose]
    #[Serializer\Type('int')]
    #[Serializer\SerializedName('PRODUCT_ORDER')]
    #[Serializer\XmlElement(cdata: false)]
    protected int $order;

    /**
     *
     *
     * @var bool
     */
    #[Serializer\Expose]
    #[Serializer\Type('boolean')]
    #[Serializer\SerializedName('DEFAULT_FLAG')]
    protected boolean $default_flag = null;

    /**
     *
     *
     * @var string
     */
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('CONFIG_CODE')]
    protected string $code = null;

    /**
     *
     *
     * @var PriceDetails
     */
    #[Serializer\Expose]
    #[Serializer\SerializedName('PRODUCT_PRICE_DETAILS')]
    #[Serializer\Type(\Naugrim\BMEcat\Nodes\Product\PriceDetails::class)]
    protected \Naugrim\BMEcat\Nodes\Product\PriceDetails $priceDetails = null;

}
