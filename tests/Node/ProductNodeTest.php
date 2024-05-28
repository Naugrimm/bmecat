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
        $node = new Product();
        $value = sha1(uniqid(microtime(false), true));

        $this->assertNull($node->getId());
        $supplierPid = new SupplierPid();
        $supplierPid->setValue($value);

        $node = new Product();
        $node->setId($supplierPid);
        $this->assertEquals($value, $node->getId()?->getValue());
    }

    public function testSetGetDetails(): void
    {
        $node = new Product();
        $details = new Details();

        $node->setDetails($details);
        $this->assertEquals($details, $node->getDetails());
    }

    public function testAddGetFeatures(): void
    {
        $features = [new Features(), new Features(), new Features()];

        $node = new Product();
        $this->assertEmpty($node->getFeatures());

        foreach ($features as $featureBlock) {
            $node->addFeatures($featureBlock);
        }

        $this->assertSame($features, $node->getFeatures());
    }

    public function testAddGetPrices(): void
    {
        $priceDetails = [
            (new PriceDetails())->addPrice(new Price()),
            (new PriceDetails())->addPrice(new Price()),
            (new PriceDetails())->addPrice(new Price()),
        ];

        $node = new Product();
        $this->assertEmpty($node->getPriceDetails());

        foreach ($priceDetails as $priceDetail) {
            $node->addPriceDetail($priceDetail);
        }

        $this->assertSame($priceDetails, $node->getPriceDetails());
    }

    public function testAddGetProductOrderDetails(): void
    {
        $node = new Product();
        $value = new OrderDetails();

        $node->setOrderDetails($value);
        $this->assertSame($value, $node->getOrderDetails());
    }

    public function testAddGetMimeInfo(): void
    {
        $mimes = [new Mime(), new Mime(), new Mime()];

        $node = new Product();
        $this->assertEmpty($node->getMimes());

        foreach ($mimes as $mime) {
            $node->addMime($mime);
        }

        $this->assertSame($mimes, $node->getMimes());
    }

    public function testSerializeWithoutNullValues(): void
    {
        $node = new Product();
        $context = SerializationContext::create()->setSerializeNull(false);

        $expected = file_get_contents(__DIR__ . '/../Fixtures/empty_product_without_null_values.xml');
        $actual = $this->serializer->serialize($node, 'xml', $context);

        $this->assertEquals($expected, $actual);

        $doc = $this->serializer->deserialize($actual, Product::class, 'xml');
        $this->assertInstanceOf(Product::class, $doc);
    }
}
