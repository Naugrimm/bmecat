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

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return PublicKey[]
     */
    public function getPublicKeys(): array
    {
        return $this->publicKeys;
    }

    /**
     * @param PublicKey[]|array{type: string, value: string}[] $publicKeys
     * @throws InvalidSetterException
     * @throws UnknownKeyException
     */
    public function setPublicKeys(array $publicKeys): self
    {
        $this->publicKeys = [];
        foreach ($publicKeys as $publicKey) {
            if (! $publicKey instanceof PublicKey) {
                $publicKey = NodeBuilder::fromArray($publicKey, \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], PublicKey::class));
            }

            $this->addPublicKey($publicKey);
        }

        return $this;
    }

    public function addPublicKey(PublicKey $publicKey): self
    {
        $this->publicKeys[] = $publicKey;
        return $this;
    }
}
