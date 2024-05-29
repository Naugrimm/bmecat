<?php

namespace Naugrim\BMEcat\Nodes;

use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Nodes\Contracts\NodeInterface;

/**
 * @implements NodeInterface<self>
 */
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
    protected string $namespace = 'http://www.bmecat.org/bmecat/2005.1';

    #[Serializer\Expose]
    #[Serializer\Type(Header::class)]
    #[Serializer\SerializedName('HEADER')]
    protected Header $header;

    #[Serializer\Expose]
    #[Serializer\Type(NewCatalog::class)]
    #[Serializer\SerializedName('T_NEW_CATALOG')]
    protected NewCatalog $catalog;

    public function setVersion(string $version): self
    {
        $this->version = $version;
        return $this;
    }

    public function getVersion(): string
    {
        return $this->version;
    }

    public function setHeader(Header $header): self
    {
        $this->header = $header;
        return $this;
    }

    public function getHeader(): Header
    {
        return $this->header;
    }

    public function setNewCatalog(NewCatalog $catalog): self
    {
        $this->catalog = $catalog;
        return $this;
    }

    public function getNewCatalog(): NewCatalog
    {
        return $this->catalog;
    }
}
