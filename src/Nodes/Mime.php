<?php

namespace Naugrim\BMEcat\Nodes;

use JMS\Serializer\Annotation as Serializer;

/**
 *
 * @Serializer\XmlRoot("MIME")
 */
class Mime implements Contracts\NodeInterface
{
    /**
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("MIME_TYPE")
     *
     * @var string
     */
    protected $type;

    /**
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("MIME_SOURCE")
     *
     * @var string
     */
    protected $source;

    /**
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("MIME_DESCR")
     *
     * @var string
     */
    protected $description;

    /**
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("MIME_ALT")
     *
     * @var string
     */
    protected $alt;

    /**
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("MIME_PURPOSE")
     * @Serializer\XmlElement(cdata=false)
     *
     * @var string
     */
    protected $purpose;


    /**
     *
     * @Serializer\Expose
     * @Serializer\Type("int")
     * @Serializer\SerializedName("MIME_ORDER")
     * @Serializer\XmlElement(cdata=false)
     *
     * @var int
     */
    protected $order;
    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return Mime
     */
    public function setType($type) : Mime
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @param string $source
     * @return Mime
     */
    public function setSource($source) : Mime
    {
        $this->source = $source;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Mime
     */
    public function setDescription($description) : Mime
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getAlt()
    {
        return $this->alt;
    }

    /**
     * @param string $alt
     * @return Mime
     */
    public function setAlt($alt) : Mime
    {
        $this->alt = $alt;
        return $this;
    }

    /**
     * @return string
     */
    public function getPurpose()
    {
        return $this->purpose;
    }

    /**
     * @param string $purpose
     * @return Mime
     */
    public function setPurpose($purpose) : Mime
    {
        $this->purpose = $purpose;
        return $this;
    }
}
