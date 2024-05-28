<?php

namespace Naugrim\BMEcat\Nodes;

use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Nodes\Contracts\NodeInterface;

/**
 * @implements NodeInterface<self>
 */
#[Serializer\XmlRoot('CATALOG')]
class Catalog implements Contracts\NodeInterface
{
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('LANGUAGE')]
    protected string $language;

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

    public function setLanguage(string $language): self
    {
        $this->language = $language;
        return $this;
    }

    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function setVersion(string $version): self
    {
        $this->version = $version;
        return $this;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getLanguage(): string
    {
        return $this->language;
    }

    public function getVersion(): string
    {
        return $this->version;
    }

    public function setDateTime(DateTime $dateTime): self
    {
        $this->dateTime = $dateTime;
        return $this;
    }

    public function getDateTime(): ?DateTime
    {
        return $this->dateTime;
    }
}
