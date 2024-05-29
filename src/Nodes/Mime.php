<?php

namespace Naugrim\BMEcat\Nodes;

use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Nodes\Contracts\NodeInterface;

/**
 * @implements NodeInterface<self>
 */
#[Serializer\XmlRoot('MIME')]
class Mime implements Contracts\NodeInterface
{
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('MIME_TYPE')]
    protected string $type;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('MIME_SOURCE')]
    protected string $source;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('MIME_DESCR')]
    protected string $description;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('MIME_ALT')]
    protected string $alt;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('MIME_PURPOSE')]
    #[Serializer\XmlElement(cdata: false)]
    protected string $purpose;

    #[Serializer\Expose]
    #[Serializer\Type('int')]
    #[Serializer\SerializedName('MIME_ORDER')]
    #[Serializer\XmlElement(cdata: false)]
    protected int $order;

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    public function getSource(): string
    {
        return $this->source;
    }

    public function setSource(string $source): self
    {
        $this->source = $source;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getAlt(): string
    {
        return $this->alt;
    }

    public function setAlt(string $alt): self
    {
        $this->alt = $alt;
        return $this;
    }

    public function getPurpose(): string
    {
        return $this->purpose;
    }

    public function setPurpose(string $purpose): self
    {
        $this->purpose = $purpose;
        return $this;
    }
}
