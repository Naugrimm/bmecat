<?php

namespace Naugrim\BMEcat\Tests\Node;

use JMS\Serializer\SerializationContext;
use JMS\Serializer\Serializer;
use Naugrim\BMEcat\DocumentBuilder;
use Naugrim\BMEcat\Nodes\Product\Keyword;
use PHPUnit\Framework\TestCase;

class ProductKeywordNodeTest extends TestCase
{
    private Serializer $serializer;

    protected function setUp(): void
    {
        $this->serializer = (new DocumentBuilder())->getSerializer();
    }

    public function testSetGetDescriptionValue(): void
    {
        $node = new Keyword();
        $value = '';

        $this->assertEquals('', $node->getValue());
        $node->setValue($value);
        $this->assertEquals($value, $node->getValue());
    }

    public function testSerializeWithNullValues(): void
    {
        $node = new Keyword();
        $context = SerializationContext::create()->setSerializeNull(true);

        $expected = file_get_contents(__DIR__ . '/../Fixtures/empty_product_keyword_with_null_values.xml');
        $actual = $this->serializer->serialize($node, 'xml', $context);

        $this->assertEquals($expected, $actual);

        $doc = $this->serializer->deserialize($actual, Keyword::class, 'xml');
        $this->assertInstanceOf(Keyword::class, $doc);
    }

    public function testSerializeWithoutNullValues(): void
    {
        $node = new Keyword();
        $context = SerializationContext::create()->setSerializeNull(false);

        $expected = file_get_contents(__DIR__ . '/../Fixtures/empty_product_keyword_without_null_values.xml');
        $actual = $this->serializer->serialize($node, 'xml', $context);

        $this->assertEquals($expected, $actual);

        $doc = $this->serializer->deserialize($actual, Keyword::class, 'xml');
        $this->assertInstanceOf(Keyword::class, $doc);
    }
}
