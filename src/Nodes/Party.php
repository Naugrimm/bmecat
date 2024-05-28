<?php

namespace Naugrim\BMEcat\Nodes;

use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Builder\NodeBuilder;
use Naugrim\BMEcat\Exception\InvalidSetterException;
use Naugrim\BMEcat\Exception\UnknownKeyException;
use Naugrim\BMEcat\Nodes\Contracts\NodeInterface;

class Party implements NodeInterface
{
    /**
     *
     * @var string
     */
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('PARTY_ID')]
    protected string $id;

    /**
     *
     * @var string
     */
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('PARTY_ROLE')]
    protected string $role;

    /**
     *
     * @var Address
     */
    #[Serializer\Expose]
    #[Serializer\Type(Address::class)]
    #[Serializer\SerializedName('ADDRESS')]
    protected Address $address;

    /**
     *
     *
     * @var Mime[]
     */
    #[Serializer\Expose]
    #[Serializer\SerializedName('MIME_INFO')]
    #[Serializer\Type('array<Naugrim\BMEcat\Nodes\Mime>')]
    #[Serializer\XmlList(entry: 'MIME')]
    protected array $mimes = [];

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return Party
     */
    public function setId(string $id): Party
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * @param string $role
     * @return Party
     */
    public function setRole(string $role): Party
    {
        $this->role = $role;
        return $this;
    }

    /**
     * @return Address
     */
    public function getAddress(): Address
    {
        return $this->address;
    }

    /**
     * @param Address $address
     * @return Party
     */
    public function setAddress(Address $address): Party
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return Mime[]
     */
    public function getMimes(): array
    {
        return $this->mimes;
    }

    /**
     * @param Mime[] $mimes
     * @return Party
     * @throws InvalidSetterException
     * @throws UnknownKeyException
     */
    public function setMimes(array $mimes): Party
    {
        $this->mimes = [];
        foreach ($mimes as $mime) {
            if (is_array($mime)) {
                $mime = NodeBuilder::fromArray($mime, new Mime());
            }

            $this->addMime($mime);
        }

        return $this;
    }

    /**
     * @param Mime $mime
     * @return Party
     */
    public function addMime(Mime $mime) : Party
    {
        if ($this->mimes === null) {
            $this->mimes = [];
        }

        $this->mimes[] = $mime;
        return $this;
    }
}
