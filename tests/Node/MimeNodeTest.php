<?php

namespace Naugrim\BMEcat\Tests\Node;

use JMS\Serializer\SerializationContext;
use JMS\Serializer\Serializer;
use Naugrim\BMEcat\DocumentBuilder;
use Naugrim\BMEcat\Nodes\Mime;
use PHPUnit\Framework\TestCase;

class MimeNodeTest extends TestCase
{
    private Serializer $serializer;

    protected function setUp(): void
    {
        $this->serializer = (new DocumentBuilder())->getSerializer();
    }

    public function testSetGetType(): void
    {
        $node = new Mime();
        $value = sha1(uniqid(microtime(false), true));

        $node->setType($value);
        $this->assertEquals($value, $node->getType());
    }

    public function testSetGetSource(): void
    {
        $node = new Mime();
        $value = sha1(uniqid(microtime(false), true));

        $node->setSource($value);
        $this->assertEquals($value, $node->getSource());
    }

    public function testSetGetPurpose(): void
    {
        $node = new Mime();
        $value = sha1(uniqid(microtime(false), true));

        $node->setPurpose($value);
        $this->assertEquals($value, $node->getPurpose());
    }

    public function testSerializeWithoutNullValues(): void
    {
        $node = new Mime();
        $context = SerializationContext::create()->setSerializeNull(false);

        $expected = file_get_contents(__DIR__ . '/../Fixtures/empty_mime_info_without_null_values.xml');
        $actual = $this->serializer->serialize($node, 'xml', $context);

        $this->assertEquals($expected, $actual);

        $doc = $this->serializer->deserialize($actual, Mime::class, 'xml');
        $this->assertInstanceOf(Mime::class, $doc);
    }
}
