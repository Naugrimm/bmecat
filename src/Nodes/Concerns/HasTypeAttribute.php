<?php

namespace Naugrim\BMEcat\Nodes\Concerns;

use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Nodes\Contracts\NodeInterface;

trait HasTypeAttribute
{
    /**
     *
     * @var string
     */
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('type')]
    #[Serializer\XmlAttribute]
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
     * @return NodeInterface
     */
    public function setType(string $type): NodeInterface
    {
        $this->type = $type;
        /** @var NodeInterface $this */
        return $this;
    }
}
