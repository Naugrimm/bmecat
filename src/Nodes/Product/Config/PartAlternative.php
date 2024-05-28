<?php

namespace Naugrim\BMEcat\Nodes\Product\Config;


use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Nodes\Contracts;
use Naugrim\BMEcat\Nodes\Product\PriceDetails;

/**
 *
 * @Serializer\XmlRoot("PART_ALTERNATIVE")
 */
class PartAlternative implements Contracts\NodeInterface
{
    /**
     *
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("SUPPLIER_PIDREF")
     *
     * @var string
     */
    protected $supplier_pid_ref;

    /**
     *
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("SUPPLIER_IDREF")
     *
     * @var string
     */
    protected $supplier_id_ref = null;

    /**
     *
     * @Serializer\Expose
     * @Serializer\Type("int")
     * @Serializer\SerializedName("PRODUCT_ORDER")
     * @Serializer\XmlElement(cdata=false)
     *
     * @var int
     */
    protected $order;

    /**
     *
     * @Serializer\Expose
     * @Serializer\Type("boolean")
     * @Serializer\SerializedName("DEFAULT_FLAG")
     *
     * @var bool
     */
    protected $default_flag = null;
    /**
     *
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("CONFIG_CODE")
     *
     * @var string
     */
    protected $code = null;

    /**
     *
     * @Serializer\Expose
     * @Serializer\SerializedName("PRODUCT_PRICE_DETAILS")
     * @Serializer\Type("Naugrim\BMEcat\Nodes\Product\PriceDetails")
     *
     * @var PriceDetails
     */
    protected $priceDetails = null;

}
