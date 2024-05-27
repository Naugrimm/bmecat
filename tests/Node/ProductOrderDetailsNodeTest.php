<?php

namespace Naugrim\BMEcat\Tests\Node;

use JMS\Serializer\SerializationContext;
use Naugrim\BMEcat\DocumentBuilder;
use Naugrim\BMEcat\Nodes\Product\OrderDetails;
use PHPUnit\Framework\TestCase;

class ProductOrderDetailsNodeTest extends TestCase
{
    /**
     * @var \JMS\Serializer\SerializerInterface
     */
    private $serializer;

    public function setUp() : void
    {
        $this->serializer = (new DocumentBuilder())->getSerializer();
    }

    /**
     * @test
     */
    public function Set_Get_Order_Unit()
    {
        $node = new OrderDetails();
        $value = 'C62';

        $this->assertNull($node->getOrderUnit());
        $node->setOrderUnit($value);
        $node->setContentUnit($value);
        $this->assertEquals($value, $node->getOrderUnit());
        $this->assertEquals($value, $node->getContentUnit());
    }
    /**
     * @test
     */
    public function Set_Get_No_Cu_Per_Ou()
    {
        $node = new OrderDetails();
        $value = rand(10, 1000);

        $this->assertEquals(1, $node->getNoCuPerOu());
        $node->setNoCuPerOu($value);
        $this->assertEquals($value, $node->getNoCuPerOu());
    }

    /**
     * @test
     */
    public function Set_Get_Price_Quantity()
    {
        $node = new OrderDetails();
        $value = rand(10, 1000);

        $this->assertEquals(1, $node->getPriceQuantity());
        $node->setPriceQuantity($value);
        $this->assertEquals($value, $node->getPriceQuantity());
    }

    /**
     * @test
     */
    public function Set_Get_Quantity_Min()
    {
        $node = new OrderDetails();
        $value = rand(10, 1000);

        $this->assertEquals(1, $node->getQuantityMin());
        $node->setQuantityMin($value);
        $this->assertEquals($value, $node->getQuantityMin());
    }

    /**
     * @test
     */
    public function Set_Get_Quantity_Interval()
    {
        $node = new OrderDetails();
        $value = rand(10, 1000);

        $this->assertEquals(1, $node->getQuantityInterval());
        $node->setQuantityInterval($value);
        $this->assertEquals($value, $node->getQuantityInterval());
    }

    /**
     * @test
     */
    public function Serialize_With_Null_Values()
    {
        $node = new OrderDetails();
        $context = SerializationContext::create()->setSerializeNull(true);

        $expected = file_get_contents(__DIR__ . '/../Fixtures/empty_product_order_details_with_null_values.xml');
        $actual = $this->serializer->serialize($node, 'xml', $context);

        $this->assertEquals($expected, $actual);

        $doc = $this->serializer->deserialize($actual, OrderDetails::class, 'xml');
        $this->assertInstanceOf(OrderDetails::class, $doc);
    }

    /**
     * @test
     */
    public function Serialize_Without_Null_Values()
    {
        $node = new OrderDetails();
        $context = SerializationContext::create()->setSerializeNull(false);

        $expected = file_get_contents(__DIR__ . '/../Fixtures/empty_product_order_details_without_null_values.xml');
        $actual = $this->serializer->serialize($node, 'xml', $context);

        $this->assertEquals($expected, $actual);

        $doc = $this->serializer->deserialize($actual, OrderDetails::class, 'xml');
        $this->assertInstanceOf(OrderDetails::class, $doc);
    }
}
