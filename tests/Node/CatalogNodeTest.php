<?php

namespace Naugrim\BMEcat\Tests\Node;

use JMS\Serializer\SerializationContext;
use JMS\Serializer\Serializer;
use Naugrim\BMEcat\DocumentBuilder;
use Naugrim\BMEcat\Nodes\Catalog;
use Naugrim\BMEcat\Nodes\DateTime;
use PHPUnit\Framework\TestCase;

class CatalogNodeTest extends TestCase
{
    private Serializer $serializer;

    protected function setUp(): void
    {
        $this->serializer = (new DocumentBuilder())->getSerializer();
    }

    public function testSetGetId(): void
    {
        $node = new Catalog();
        $value = sha1(uniqid(microtime(false), true));
        $node->setId($value);
        $this->assertEquals($value, $node->getId());
    }

    public function testSetGetVersion(): void
    {
        $node = new Catalog();
        $value = sha1(uniqid(microtime(false), true));
        $node->setVersion($value);
        $this->assertEquals($value, $node->getVersion());
    }

    public function testSetGetLanguage(): void
    {
        $node = new Catalog();
        $value = sha1(uniqid(microtime(false), true));

        $node->setLanguage($value);
        $this->assertEquals($value, $node->getLanguage());
    }

    public function testSetGetDateTime(): void
    {
        $node = new Catalog();
        $dateTime = new DateTime();

        $this->assertNull($node->getDateTime());
        $node->setDateTime($dateTime);
        $this->assertEquals($dateTime, $node->getDateTime());
    }

    public function testSerializeWithoutNullValues(): void
    {
        $node = new Catalog();
        $context = SerializationContext::create()->setSerializeNull(false);

        $expected = file_get_contents(__DIR__ . '/../Fixtures/empty_catalog_without_null_values.xml');
        $actual = $this->serializer->serialize($node, 'xml', $context);

        $this->assertEquals($expected, $actual);

        $doc = $this->serializer->deserialize($actual, Catalog::class, 'xml');
        $this->assertInstanceOf(Catalog::class, $doc);
    }
}
