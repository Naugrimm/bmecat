<?php

namespace Naugrim\BMEcat\Nodes;

use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Builder\NodeBuilder;
use Naugrim\BMEcat\Exception\InvalidSetterException;
use Naugrim\BMEcat\Exception\UnknownKeyException;
use Naugrim\BMEcat\Nodes\Contracts\NodeInterface;
use Naugrim\BMEcat\Nodes\Crypto\PublicKey;

/**
 * @implements NodeInterface<self>
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
