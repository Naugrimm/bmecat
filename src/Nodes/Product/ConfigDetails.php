<?php

namespace Naugrim\BMEcat\Nodes\Product;

use /** @noinspection PhpUnusedAliasInspection */
    JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Nodes\Contracts;
use Naugrim\BMEcat\Nodes\Product\Config\PartAlternative;
use Naugrim\BMEcat\Nodes\Product\Config\Parts;
use Naugrim\BMEcat\Nodes\Product\Config\Step;

/**
 *
 * @Serializer\XmlRoot("PRODUCT_CONFIG_DETAILS")
 */
class ConfigDetails implements Contracts\NodeInterface
{

    /**
     *
     * @Serializer\Expose
     * @Serializer\Type("array<Naugrim\BMEcat\Nodes\Product\Config\Step>")
     * @Serializer\XmlList(inline=true, entry="CONFIG_STEP")
     *
     * @var Step[]
     */
    protected $steps;
}