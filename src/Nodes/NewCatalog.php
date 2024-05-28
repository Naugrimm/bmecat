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
    /**
     * @var Product[]
     */
    #[Serializer\Expose]
    #[Serializer\Type('array<Naugrim\BMEcat\Nodes\Product>')]
    #[Serializer\XmlList(inline: true, entry: 'PRODUCT')]
    protected ?array $products = [];

    /**
     * @param Product[]|mixed[] $products
     * @throws InvalidSetterException
     * @throws UnknownKeyException
     */
    public function setProducts(array $products): self
    {
        $this->products = [];

        foreach ($products as $product) {
            if (is_array($product)) {
                $product = NodeBuilder::fromArray($product, new Product());
            }

            Assert::isInstanceOf($product, Product::class);

            $this->addProduct($product);
        }

        return $this;
    }

    public function addProduct(Product $product): self
    {
        if ($this->products === null) {
            $this->products = [];
        }

        $this->products[] = $product;
        return $this;
    }

    #[Serializer\PreSerialize]
    #[Serializer\PostSerialize]
    public function nullProducts(): void
    {
        if ($this->products === []) {
            $this->products = null;
        }
    }

    /**
     * @return Product[]
     */
    public function getProducts(): array
    {
        if ($this->products === null) {
            return [];
        }

        return $this->products;
    }
}
