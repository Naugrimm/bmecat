<?php


namespace Naugrim\BMEcat\Nodes;

use JMS\Serializer\Annotation as Serializer;


#[Serializer\XmlRoot('BMECAT')]
#[Serializer\ExclusionPolicy('all')]
class Document implements Contracts\NodeInterface
{
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\XmlAttribute]
    protected string $version = '2005.1';

    #[Serializer\Expose]
    #[Serializer\SerializedName('xmlns')]
    #[Serializer\XmlAttribute]
    protected $namespace = 'http://www.bmecat.org/bmecat/2005.1';

    /**
     *
     * @var Header
     */
    #[Serializer\Expose]
    #[Serializer\Type(Header::class)]
    #[Serializer\SerializedName('HEADER')]
    protected Header $header;

    /**
     *
     * @var NewCatalog
     */
    #[Serializer\Expose]
    #[Serializer\Type(NewCatalog::class)]
    #[Serializer\SerializedName('T_NEW_CATALOG')]
    protected NewCatalog $catalog;

    /**
     *
     * @param string $version
     * @return Document
     */
    public function setVersion(string $version) : Document
    {
        $this->version = $version;
        return $this;
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
    public function getHeader(): Header
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
    public function getNewCatalog(): NewCatalog
    {
        return $this->catalog;
    }
}
