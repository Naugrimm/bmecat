<?php


namespace Naugrim\BMEcat\Nodes;

use /** @noinspection PhpUnusedAliasInspection */
    JMS\Serializer\Annotation as Serializer;

/**
 *
 * @Serializer\XmlRoot("BMECAT")
 * @Serializer\ExclusionPolicy("all")
 */
class Document implements Contracts\NodeInterface
{
    /**
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\XmlAttribute
     */
    protected $version = '2005.1';

    /**
     * @Serializer\Expose
     * @Serializer\SerializedName("xmlns")
     * @Serializer\XmlAttribute
     */
    protected $namespace = 'http://www.bmecat.org/bmecat/2005.1';

    /**
     * @Serializer\Expose
     * @Serializer\Type("Naugrim\BMEcat\Nodes\Header")
     * @Serializer\SerializedName("HEADER")
     *
     * @var Header
     */
    protected $header;

    /**
     * @Serializer\Expose
     * @Serializer\Type("Naugrim\BMEcat\Nodes\NewCatalog")
     * @Serializer\SerializedName("T_NEW_CATALOG")
     *
     * @var NewCatalog
     */
    protected $catalog;

    /**
     *
     * @param string $version
     * @return Document
     */
    public function setVersion($version) : Document
    {
        $this->version = $version;
        return $this;
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
     * @param Header $header
     * @return Document
     */
    public function setHeader(Header $header) : Document
    {
        $this->header = $header;
        return $this;
    }

    /**
     *
     * @return Header
     */
    public function getHeader()
    {
        return $this->header;
    }

    /**
     * @param NewCatalog $catalog
     * @return Document
     */
    public function setNewCatalog(NewCatalog $catalog) : Document
    {
        $this->catalog = $catalog;
        return $this;
    }

    /**
     * @return NewCatalog
     */
    public function getNewCatalog()
    {
        return $this->catalog;
    }
}
