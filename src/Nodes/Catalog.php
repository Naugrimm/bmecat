<?php

namespace Naugrim\BMEcat\Nodes;

use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Nodes\Concerns\HasSerializableAttributes;
use Naugrim\BMEcat\Nodes\Contracts\NodeInterface;

/**
 * @implements NodeInterface<self>
 */
#[Serializer\XmlRoot('CATALOG')]
class Catalog implements Contracts\NodeInterface
{
    use HasSerializableAttributes;

    /**
     * @var Language[]
     */
    #[Serializer\Expose]
    #[Serializer\Type('array<'.Language::class.'>')]
    #[Serializer\XmlList(entry: 'LANGUAGE', inline: true)]
    protected array $language = [];

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('CATALOG_ID')]
    protected string $id;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('CATALOG_VERSION')]
    protected string $version;

    #[Serializer\Expose]
    #[Serializer\Type(DateTime::class)]
    #[Serializer\SerializedName('DATETIME')]
    protected ?DateTime $dateTime = null;
}
