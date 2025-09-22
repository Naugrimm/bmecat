<?php

namespace Naugrim\BMEcat\Tests\Node;

use JMS\Serializer\SerializationContext;
use JMS\Serializer\Serializer;
use Naugrim\BMEcat\DocumentBuilder;
use Naugrim\BMEcat\Nodes\NewCatalog;
use Naugrim\BMEcat\Nodes\Product;
use PHPUnit\Framework\TestCase;

class NewCatalogNodeTest extends TestCase
{
    private Serializer $serializer;

    #[\Override]
    protected function setUp(): void
    {
        $this->serializer = new DocumentBuilder()
            ->getSerializer();
    }

    public function testAddGetProductNode(): void
    {
        $products = [
            \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Product::class),
            \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Product::class),
            \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Product::class),
        ];

        $node = \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], NewCatalog::class);
        $this->assertEquals([], $node->getProducts());

        foreach ($products as $product) {
            $node->addProduct($product);
        }

        $this->assertSame($products, $node->getProducts());
    }

    public function testSerializeWithoutNullValues(): void
    {
        $node = \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], NewCatalog::class);
        $context = SerializationContext::create()->setSerializeNull(false);

        $expected = file_get_contents(__DIR__ . '/../Fixtures/empty_new_catalog_without_null_values.xml');
        $actual = $this->serializer->serialize($node, 'xml', $context);

        $this->assertEquals($expected, $actual);

        $doc = $this->serializer->deserialize($actual, NewCatalog::class, 'xml');
        $this->assertInstanceOf(NewCatalog::class, $doc);
    }
}
