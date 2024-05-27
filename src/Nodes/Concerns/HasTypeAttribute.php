<?php

namespace Naugrim\BMEcat\Nodes\Concerns;

use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Nodes\Contracts\NodeInterface;

trait HasTypeAttribute
{
    /**
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("type")
     * @Serializer\XmlAttribute
     *
     * @var string
     */
    protected $type;

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return \Naugrim\BMEcat\Nodes\Contracts\NodeInterface
     */
    public function setType(string $type): NodeInterface
    {
        $this->type = $type;
        /** @var \Naugrim\BMEcat\Nodes\Contracts\NodeInterface $this */
        return $this;
    }
}
