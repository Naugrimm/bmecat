<?php

namespace Naugrim\BMEcat\Nodes;

use JMS\Serializer\Annotation as Serializer;


#[Serializer\XmlRoot('MIME')]
class Mime implements Contracts\NodeInterface
{
    /**
     *
     * @var string
     */
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('MIME_TYPE')]
    protected string $type;

    /**
     *
     * @var string
     */
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('MIME_SOURCE')]
    protected string $source;

    /**
     *
     * @var string
     */
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('MIME_DESCR')]
    protected string $description;

    /**
     *
     * @var string
     */
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('MIME_ALT')]
    protected string $alt;

    /**
     *
     * @var string
     */
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('MIME_PURPOSE')]
    #[Serializer\XmlElement(cdata: false)]
    protected string $purpose;


    /**
     *
     *
     * @var int
     */
    #[Serializer\Expose]
    #[Serializer\Type('int')]
    #[Serializer\SerializedName('MIME_ORDER')]
    #[Serializer\XmlElement(cdata: false)]
    protected int $order;

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return Mime
     */
    public function setType(string $type) : Mime
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getSource(): string
    {
        return $this->source;
    }

    /**
     * @param string $source
     * @return Mime
     */
    public function setSource(string $source) : Mime
    {
        $this->source = $source;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Mime
     */
    public function setDescription(string $description) : Mime
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getAlt(): string
    {
        return $this->alt;
    }

    /**
     * @param string $alt
     * @return Mime
     */
    public function setAlt(string $alt) : Mime
    {
        $this->alt = $alt;
        return $this;
    }

    /**
     * @return string
     */
    public function getPurpose(): string
    {
        return $this->purpose;
    }

    /**
     * @param string $purpose
     * @return Mime
     */
    public function setPurpose(string $purpose) : Mime
    {
        $this->purpose = $purpose;
        return $this;
    }
}
