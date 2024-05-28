<?php


namespace Naugrim\BMEcat\Nodes;

use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Nodes\Contracts\NodeInterface;

/**
 * @implements NodeInterface<self>
 * @deprecated
 */
#[Serializer\XmlRoot('SUPPLIER')]
class Supplier implements Contracts\NodeInterface
{
    /**
     *
     * @var string
     */
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('SUPPLIER_ID')]
    protected string $id;

    /**
     *
     * @var string
     */
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('SUPPLIER_NAME')]
    protected string $name;

    /**
     *
     * @param string $id
     * @return Supplier
     */
    public function setId(string $id) : Supplier
    {
        $this->id = $id;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $name
     * @return Supplier
     */
    public function setName(string $name) : Supplier
    {
        $this->name = $name;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}
