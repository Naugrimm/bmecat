<?php

namespace Naugrim\BMEcat\Nodes;

use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Nodes\Contracts\NodeInterface;

/**
 * @implements NodeInterface<self>
 * @method self setVersion(string $version)
 * @method string getVersion()
 * @method self setNamespace(string $namespace)
 * @method string getNamespace()
 * @method self setHeader(array<string, mixed>|\Naugrim\BMEcat\Nodes\Header $header)
 * @method \Naugrim\BMEcat\Nodes\Header getHeader()
 * @method self setNewCatalog(array<string, mixed>|\Naugrim\BMEcat\Nodes\NewCatalog $newCatalog)
 * @method \Naugrim\BMEcat\Nodes\NewCatalog getNewCatalog()
 */
#[Serializer\XmlRoot('BMECAT')]
#[Serializer\ExclusionPolicy('all')]
class Document implements Contracts\NodeInterface
{
    use \Naugrim\BMEcat\Nodes\Concerns\HasSerializableAttributes;
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
    protected NewCatalog $newCatalog;
}
