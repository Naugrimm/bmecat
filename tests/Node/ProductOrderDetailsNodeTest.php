<?php

namespace Naugrim\BMEcat\Tests\Node;

use JMS\Serializer\SerializationContext;
use JMS\Serializer\Serializer;
use Naugrim\BMEcat\DocumentBuilder;
use Naugrim\BMEcat\Nodes\Product\OrderDetails;
use PHPUnit\Framework\TestCase;

class ProductOrderDetailsNodeTest extends TestCase
{
    private Serializer $serializer;

    protected function setUp(): void
    {
        $this->serializer = (new DocumentBuilder())->getSerializer();
    }

    public function testSetGetOrderUnit(): void
    {
        $node = new OrderDetails();
        $value = 'C62';

        $node->setOrderUnit($value);
        $node->setContentUnit($value);
        $this->assertEquals($value, $node->getOrderUnit());
        $this->assertEquals($value, $node->getContentUnit());
    }

    public function testSetGetNoCuPerOu(): void
    {
        $node = new OrderDetails();
        $value = random_int(10, 1000);

        $node->setNoCuPerOu($value);
        $this->assertEquals($value, $node->getNoCuPerOu());
    }

    public function testSetGetPriceQuantity(): void
    {
        $node = new OrderDetails();
        $value = random_int(10, 1000);

        $node->setPriceQuantity($value);
        $this->assertEquals($value, $node->getPriceQuantity());
    }

    public function testSetGetQuantityMin(): void
    {
        $node = new OrderDetails();
        $value = random_int(10, 1000);

        $node->setQuantityMin($value);
        $this->assertEquals($value, $node->getQuantityMin());
    }

    public function testSetGetQuantityInterval(): void
    {
        $node = new OrderDetails();
        $value = random_int(10, 1000);

        $node->setQuantityInterval($value);
        $this->assertEquals($value, $node->getQuantityInterval());
    }

    public function testSerializeWithoutNullValues(): void
    {
        $node = new OrderDetails();
        $node->setOrderUnit('C62');
        $node->setContentUnit('C62');

        $context = SerializationContext::create()->setSerializeNull(false);

        $expected = file_get_contents(__DIR__ . '/../Fixtures/empty_product_order_details_without_null_values.xml');
        $actual = $this->serializer->serialize($node, 'xml', $context);

        $this->assertEquals($expected, $actual);

        $doc = $this->serializer->deserialize($actual, OrderDetails::class, 'xml');
        $this->assertInstanceOf(OrderDetails::class, $doc);
    }
}
