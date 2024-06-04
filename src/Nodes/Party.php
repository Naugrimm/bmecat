<?php

namespace Naugrim\BMEcat\Nodes;

use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Nodes\Contracts\NodeInterface;

/**
 * @implements NodeInterface<self>
 * @method self setId(string $id)
 * @method string getId()
 * @method self setRole(array $role)
 * @method string[] getRole()
 * @method self setAddress(\Naugrim\BMEcat\Nodes\Address[]|array $address)
 * @method \Naugrim\BMEcat\Nodes\Address[]|array getAddress()
 * @method self setMimes(\Naugrim\BMEcat\Nodes\Mime|array $mimes)
 * @method Naugrim\BMEcat\Nodes\Mime[] getMimes()
 */
class Party implements NodeInterface
{
    use \Naugrim\BMEcat\Nodes\Concerns\HasSerializableAttributes;
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('PARTY_ID')]
    protected string $id;

    /**
     * @var string[]
     */
    #[Serializer\Expose]
    #[Serializer\Type('array<string>')]
    #[Serializer\XmlList(entry: 'PARTY_ROLE', inline: true)]
    protected array $role = [];

    /**
     * @var Address[]
     */
    #[Serializer\Expose]
    #[Serializer\Type('array<' . Address::class . '>')]
    #[Serializer\XmlList(entry: 'ADDRESS', inline: true)]
    protected array $address = [];

    /**
     * @var Mime[]
     */
    #[Serializer\Expose]
    #[Serializer\SerializedName('MIME_INFO')]
    #[Serializer\Type('array<Naugrim\BMEcat\Nodes\Mime>')]
    #[Serializer\XmlList(entry: 'MIME')]
    protected array $mimes = [];

    public function addMime(Mime $mime): self
    {
        $this->mimes[] = $mime;
        return $this;
    }
}
