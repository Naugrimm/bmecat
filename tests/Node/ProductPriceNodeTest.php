<?php

namespace Naugrim\BMEcat\Tests\Node;

use JMS\Serializer\SerializationContext;
use JMS\Serializer\Serializer;
use Naugrim\BMEcat\DocumentBuilder;
use Naugrim\BMEcat\Nodes\Product\Price;
use PHPUnit\Framework\TestCase;

class ProductPriceNodeTest extends TestCase
{
    private Serializer $serializer;

    protected function setUp(): void
    {
        $this->serializer = (new DocumentBuilder())->getSerializer();
    }

    public function testSetGetPrice(): void
    {
        $node = \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Price::class);
        $value = random_int(10, 1000);

        $node->setPrice($value);
        $this->assertEquals($value, $node->getPrice());
    }

    public function testSetGetCurrency(): void
    {
        $node = \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Price::class);
        $value = substr(sha1(uniqid(microtime(false), true)), 0, 3);

        $this->assertEquals('EUR', $node->getCurrency());
        $node->setCurrency($value);
        $this->assertEquals($value, $node->getCurrency());
    }

    public function testSerializeWithoutNullValues(): void
    {
        $node = \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Price::class);
        $context = SerializationContext::create()->setSerializeNull(false);

        $expected = file_get_contents(__DIR__ . '/../Fixtures/empty_product_price_without_null_values.xml');
        $actual = $this->serializer->serialize($node, 'xml', $context);

        $this->assertEquals($expected, $actual);

        $doc = $this->serializer->deserialize($actual, Price::class, 'xml');
        $this->assertInstanceOf(Price::class, $doc);
    }
}
