<?php

namespace Naugrim\BMEcat\Tests\Node;

use JMS\Serializer\SerializationContext;
use JMS\Serializer\Serializer;
use Naugrim\BMEcat\DocumentBuilder;
use Naugrim\BMEcat\Nodes\Catalog;
use Naugrim\BMEcat\Nodes\Header;
use Naugrim\BMEcat\Nodes\SupplierIdRef;
use PHPUnit\Framework\TestCase;

class HeaderNodeTest extends TestCase
{
    private Serializer $serializer;

    protected function setUp(): void
    {
        $this->serializer = (new DocumentBuilder())->getSerializer();
    }

    public function testSetGetGeneratorInfo(): void
    {
        $node = \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Header::class);
        $value = sha1(uniqid(microtime(false), true));

        $this->assertNull($node->getGeneratorInfo());
        $node->setGeneratorInfo($value);
        $this->assertEquals($value, $node->getGeneratorInfo());
    }

    public function testSetGetSupplier(): void
    {
        $header = \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Header::class);
        $supplier = \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], SupplierIdRef::class);

        $this->assertNull($header->getSupplierIdRef());
        $header->setSupplierIdRef($supplier);
        $this->assertEquals($supplier, $header->getSupplierIdRef());
    }

    public function testSetGetCatalog(): void
    {
        $header = \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Header::class);
        $catalog = \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Catalog::class);

        $header->setCatalog($catalog);
        $this->assertEquals($catalog, $header->getCatalog());
    }

    public function testSerializeWithoutNullValues(): void
    {
        $node = \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Header::class);
        $context = SerializationContext::create()->setSerializeNull(false);

        $expected = file_get_contents(__DIR__ . '/../Fixtures/empty_header_without_null_values.xml');
        $actual = $this->serializer->serialize($node, 'xml', $context);

        $this->assertEquals($expected, $actual);
        $doc = $this->serializer->deserialize($actual, Header::class, 'xml');
        $this->assertInstanceOf(Header::class, $doc);
    }
}
