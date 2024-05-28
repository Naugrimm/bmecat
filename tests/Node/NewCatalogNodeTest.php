<?php


namespace Naugrim\BMEcat\Tests\Node;

use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerBuilder;
use Naugrim\BMEcat\DocumentBuilder;
use PHPUnit\Framework\TestCase;
use Naugrim\BMEcat\Nodes\NewCatalog;
use Naugrim\BMEcat\Nodes\Product;


class NewCatalogNodeTest extends TestCase
{
    /**
     * @var \JMS\Serializer\SerializerInterface
     */
    private $serializer;

    protected function setUp() : void
    {
        $this->serializer = (new DocumentBuilder())->getSerializer();
    }

    /**
     *
     * @test
     */
    public function Add_Get_Product_Node(): void
    {
        $products = [
            new Product(),
            new Product(),
            new Product(),
        ];

        $node = new NewCatalog();
        $this->assertEmpty($node->getProducts());
        $node->nullProducts();
        $this->assertEquals([], $node->getProducts());

        foreach ($products as $product) {
            $node->addProduct($product);
        }

        $this->assertSame($products, $node->getProducts());
    }

    /**
     *
     * @test
     */
    public function Serialize_With_Null_Values(): void
    {
        $node = new NewCatalog();
        $context = SerializationContext::create()->setSerializeNull(true);

        $expected = file_get_contents(__DIR__ . '/../Fixtures/empty_new_catalog_with_null_values.xml');
        $actual = $this->serializer->serialize($node, 'xml', $context);

        $this->assertEquals($expected, $actual);
    }

    /**
     *
     * @test
     */
    public function Serialize_Without_Null_Values(): void
    {
        $node = new NewCatalog();
        $context = SerializationContext::create()->setSerializeNull(false);

        $expected = file_get_contents(__DIR__ . '/../Fixtures/empty_new_catalog_without_null_values.xml');
        $actual = $this->serializer->serialize($node, 'xml', $context);

        $this->assertEquals($expected, $actual);

        $doc = $this->serializer->deserialize($actual, NewCatalog::class, 'xml');
        $this->assertInstanceOf(NewCatalog::class, $doc);
    }
}
