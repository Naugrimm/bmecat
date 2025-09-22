<?php

namespace Naugrim\BMEcat\Tests\Node;

use JMS\Serializer\SerializationContext;
use JMS\Serializer\Serializer;
use Naugrim\BMEcat\DocumentBuilder;
use Naugrim\BMEcat\Nodes\Product\Feature;
use PHPUnit\Framework\TestCase;

class ProductFeatureNodeTest extends TestCase
{
    private Serializer $serializer;

    #[\Override]
    protected function setUp(): void
    {
        $this->serializer = new DocumentBuilder()
            ->getSerializer();
    }

    public function testSetGetName(): void
    {
        $node = \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Feature::class);
        $value = sha1(uniqid(microtime(false), true));

        $node->setName($value);
        $this->assertEquals($value, $node->getName());
    }

    public function testSetGetValue(): void
    {
        $node = \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Feature::class);
        $value = [sha1(uniqid(microtime(false), true))];

        $node->setValue($value);
        $this->assertEquals($value, $node->getValue());
    }

    public function testSerializeWithoutNullValues(): void
    {
        $node = \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Feature::class);
        $node->setName('test');
        $node->setValue(['test']);

        $context = SerializationContext::create()->setSerializeNull(false);

        $expected = file_get_contents(__DIR__ . '/../Fixtures/empty_product_feature_without_null_values.xml');
        $actual = $this->serializer->serialize($node, 'xml', $context);

        $this->assertEquals($expected, $actual);

        $doc = $this->serializer->deserialize($actual, Feature::class, 'xml');
        $this->assertInstanceOf(Feature::class, $doc);
    }
}
