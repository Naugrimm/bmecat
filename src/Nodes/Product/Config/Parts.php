<?php

namespace Naugrim\BMEcat\Nodes\Product\Config;

use /** @noinspection PhpUnusedAliasInspection */
    JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Nodes\BuyerPid;
use Naugrim\BMEcat\Nodes\Contracts;
use Naugrim\BMEcat\Nodes\Product\PriceDetails;

/**
 *
 * @Serializer\XmlRoot("CONFIG_PARTS")
 */
class Parts implements Contracts\NodeInterface
{

    /**
     *
     * @Serializer\Expose
     * @Serializer\Type("array<Naugrim\BMEcat\Nodes\Product\Config\PartAlternative>")
     * @Serializer\XmlList(inline=true, entry="PART_ALTERNATIVE")
     *
     * @var PartAlternative[]
     */
    protected $alternatives;

    /**
     *
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("PART_SELECTION_TYPE")
     *
     * @var string
     */
    protected $selection_type = null;

}