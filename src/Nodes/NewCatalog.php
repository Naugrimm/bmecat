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
    #[Serializer\XmlList(entry: 'PRODUCT', inline: true)]
    protected array $products = [];

    /**
     * @param Product[]|array<string, mixed>[] $products
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
        $this->products[] = $product;
        return $this;
    }

    /**
     * @return Product[]
     */
    public function getProducts(): array
    {
        return $this->products;
    }
}
