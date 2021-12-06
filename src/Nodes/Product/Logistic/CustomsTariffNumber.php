<?php

namespace Naugrim\BMEcat\Nodes\Product\Logistic;

use /** @noinspection PhpUnusedAliasInspection */
    JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Nodes\Contracts;

/**
 *
 * @Serializer\XmlRoot("CUSTOMS_TARIFF_NUMBER")
 */
class CustomsTariffNumber implements Contracts\NodeInterface
{
    /**
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("CUSTOMS_NUMBER")
     * @Serializer\XmlElement(cdata=false)
     *
     * @var string
     */
    protected $number;

    /**
     *
     * @Serializer\Expose
     * @Serializer\Type("array<string>")
     * @Serializer\XmlList(inline=true, entry="TERRITORY")
     *
     * @var string[]
     */
    protected $territories;
}