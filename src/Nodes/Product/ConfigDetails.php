<?php

namespace Naugrim\BMEcat\Nodes\Product;

use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Nodes\Contracts;
use Naugrim\BMEcat\Nodes\Contracts\NodeInterface;
use Naugrim\BMEcat\Nodes\Product\Config\PartAlternative;
use Naugrim\BMEcat\Nodes\Product\Config\Parts;
use Naugrim\BMEcat\Nodes\Product\Config\Step;

/**
 * @implements NodeInterface<self>
 */
#[Serializer\XmlRoot('PRODUCT_CONFIG_DETAILS')]
class ConfigDetails implements Contracts\NodeInterface
{

    /**
     *
     *
     * @var Step[]
     */
    #[Serializer\Expose]
    #[Serializer\Type('array<Naugrim\BMEcat\Nodes\Product\Config\Step>')]
    #[Serializer\XmlList(inline: true, entry: 'CONFIG_STEP')]
    protected array $steps;
}
