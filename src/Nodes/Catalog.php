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
    /**
     *
     * @var string
     */
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('LANGUAGE')]
    protected string $language;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('CATALOG_ID')]
    protected string $id;

    /**
     *
     * @var string
     */
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('CATALOG_VERSION')]
    protected string $version;

    #[Serializer\Expose]
    #[Serializer\Type(DateTime::class)]
    #[Serializer\SerializedName('DATETIME')]
    protected ?DateTime $dateTime = null;

    /**
     * @param string $language
     * @return Catalog
     */
    public function setLanguage(string $language) : Catalog
    {
        $this->language = $language;
        return $this;
    }

    /**
     * @param string $id
     * @return Catalog
     */
    public function setId(string $id) : Catalog
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param string $version
     * @return Catalog
     */
    public function setVersion(string $version) : Catalog
    {
        $this->version = $version;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     *
     * @return string
     */
    public function getLanguage(): string
    {
        return $this->language;
    }

    /**
     *
     * @return string
     */
    public function getVersion(): string
    {
        return $this->version;
    }

    /**
     *
     * @param DateTime $dateTime
     * @return Catalog
     */
    public function setDateTime(DateTime $dateTime) : Catalog
    {
        $this->dateTime = $dateTime;
        return $this;
    }

    public function getDateTime(): ?DateTime
    {
        return $this->dateTime;
    }
}
