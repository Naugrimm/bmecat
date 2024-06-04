<?php

namespace Naugrim\BMEcat\Nodes;

use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Nodes\Contracts\NodeInterface;
use Naugrim\BMEcat\Nodes\Crypto\PublicKey;

/**
 * @implements NodeInterface<self>
 * @method self setEmail(string $email)
 * @method string getEmail()
 * @method self setPublicKeys(\Naugrim\BMEcat\Nodes\Crypto\PublicKey[]|array $publicKeys)
 * @method \Naugrim\BMEcat\Nodes\Crypto\PublicKey[]|array getPublicKeys()
 */
class Emails implements NodeInterface
{
    use \Naugrim\BMEcat\Nodes\Concerns\HasSerializableAttributes;
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('EMAIL')]
    protected string $email;

    /**
     * @var PublicKey[]
     */
    #[Serializer\Expose]
    #[Serializer\SerializedName('PUBLIC_KEY')]
    #[Serializer\Type('array<Naugrim\BMEcat\Nodes\Crypto\PublicKey>')]
    #[Serializer\XmlList(inline: true)]
    protected array $publicKeys = [];

    public function addPublicKey(PublicKey $publicKey): self
    {
        $this->publicKeys[] = $publicKey;
        return $this;
    }
}
