<?php


namespace Naugrim\BMEcat\Nodes;

use JMS\Serializer\Annotation as Serializer;

/**
 *
 * @Serializer\XmlRoot("CATALOG")
 */
class Catalog implements Contracts\NodeInterface
{
    /**
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("LANGUAGE")
     *
     * @var string
     */
    protected $language;

    /**
      * @Serializer\Expose
      * @Serializer\Type("string")
      * @Serializer\SerializedName("CATALOG_ID")
      *
      * @var string
      */
    protected $id;

    /**
      * @Serializer\Expose
      * @Serializer\Type("string")
      * @Serializer\SerializedName("CATALOG_VERSION")
      *
      * @var string
      */
    protected $version;

    /**
     * @Serializer\Expose
     * @Serializer\Type("Naugrim\BMEcat\Nodes\DateTime")
     * @Serializer\SerializedName("DATETIME")
     *
     * @var DateTime
     */
    protected $dateTime;

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
    public function getId()
    {
        return $this->id;
    }

    /**
     *
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     *
     * @return string
     */
    public function getVersion()
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

    /**
     *
     * @return DateTime
     */
    public function getDateTime()
    {
        return $this->dateTime;
    }
}
