<?php

namespace Naugrim\BMEcat\Tests\Node;

use JMS\Serializer\SerializationContext;
use JMS\Serializer\Serializer;
use Naugrim\BMEcat\DocumentBuilder;
use Naugrim\BMEcat\Nodes\Mime;
use Naugrim\BMEcat\Nodes\Product;
use Naugrim\BMEcat\Nodes\Product\Details;
use Naugrim\BMEcat\Nodes\Product\Features;
use Naugrim\BMEcat\Nodes\Product\OrderDetails;
use Naugrim\BMEcat\Nodes\Product\Price;
use Naugrim\BMEcat\Nodes\Product\PriceDetails;
use Naugrim\BMEcat\Nodes\SupplierPid;
use PHPUnit\Framework\TestCase;

class ProductNodeTest extends TestCase
{
    private Serializer $serializer;

    protected function setUp(): void
    {
        $this->serializer = (new DocumentBuilder())->getSerializer();
    }

    public function testSetGetId(): void
    {
        $node = \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Product::class);
        $value = sha1(uniqid(microtime(false), true));

        $this->assertNull($node->getId());
        $supplierPid = \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], SupplierPid::class);
        $supplierPid->setValue($value);

        $node = \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Product::class);
        $node->setId($supplierPid);
        $this->assertEquals($value, $node->getId()?->getValue());
    }

    public function testSetGetDetails(): void
    {
        $node = \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Product::class);
        $details = \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Details::class);

        $node->setDetails($details);
        $this->assertEquals($details, $node->getDetails());
    }

    public function testAddGetFeatures(): void
    {
        $features = [\Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Features::class), \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Features::class), \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Features::class)];

        $node = \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Product::class);
        $this->assertEmpty($node->getFeatures());

        foreach ($features as $featureBlock) {
            $node->addFeatures($featureBlock);
        }

        $this->assertSame($features, $node->getFeatures());
    }

    public function testAddGetPrices(): void
    {
        $priceDetails = [
            (\Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], PriceDetails::class))->addPrice(\Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Price::class)),
            (\Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], PriceDetails::class))->addPrice(\Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Price::class)),
            (\Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], PriceDetails::class))->addPrice(\Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Price::class)),
        ];

        $node = \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Product::class);
        $this->assertEmpty($node->getPriceDetails());

        foreach ($priceDetails as $priceDetail) {
            $node->addPriceDetail($priceDetail);
        }

        $this->assertSame($priceDetails, $node->getPriceDetails());
    }

    public function testAddGetProductOrderDetails(): void
    {
        $node = \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Product::class);
        $value = \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], OrderDetails::class);

        $node->setOrderDetails($value);
        $this->assertSame($value, $node->getOrderDetails());
    }

    public function testAddGetMimeInfo(): void
    {
        $mimes = [\Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Mime::class), \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Mime::class), \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Mime::class)];

        $node = \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Product::class);
        $this->assertEmpty($node->getMimes());

        foreach ($mimes as $mime) {
            $node->addMime($mime);
        }

        $this->assertSame($mimes, $node->getMimes());
    }

    public function testSerializeWithoutNullValues(): void
    {
        $node = \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Product::class);
        $context = SerializationContext::create()->setSerializeNull(false);

        $expected = file_get_contents(__DIR__ . '/../Fixtures/empty_product_without_null_values.xml');
        $actual = $this->serializer->serialize($node, 'xml', $context);

        $this->assertEquals($expected, $actual);

        $doc = $this->serializer->deserialize($actual, Product::class, 'xml');
        $this->assertInstanceOf(Product::class, $doc);
    }
}
