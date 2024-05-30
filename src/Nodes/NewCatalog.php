<?php

namespace Naugrim\BMEcat\Nodes;

use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Builder\NodeBuilder;
use Naugrim\BMEcat\Exception\InvalidSetterException;
use Naugrim\BMEcat\Exception\UnknownKeyException;
use Naugrim\BMEcat\Nodes\Contracts\NodeInterface;
use Webmozart\Assert\Assert;

/**
 * @implements NodeInterface<self>
 */
#[Serializer\XmlRoot('T_NEW_CATALOG')]
class NewCatalog implements Contracts\NodeInterface
{
    use \Naugrim\BMEcat\Nodes\Concerns\HasSerializableAttributes;
    /**
     * @var Product[]
     */
    #[Serializer\Expose]
    #[Serializer\Type('array<Naugrim\BMEcat\Nodes\Product>')]
    #[Serializer\XmlList(entry: 'PRODUCT', inline: true)]
    protected array $products = [];

    public function addProduct(Product $product): self
    {
        $this->products[] = $product;
        return $this;
    }
}
