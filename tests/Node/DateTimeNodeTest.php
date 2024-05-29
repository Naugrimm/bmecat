<?php

namespace Naugrim\BMEcat\Tests\Node;

use JMS\Serializer\SerializationContext;
use JMS\Serializer\Serializer;
use Naugrim\BMEcat\DocumentBuilder;
use Naugrim\BMEcat\Nodes\DateTime;
use PHPUnit\Framework\TestCase;

class DateTimeNodeTest extends TestCase
{
    private Serializer $serializer;

    protected function setUp(): void
    {
        $this->serializer = (new DocumentBuilder())->getSerializer();
    }

    public function testSetGetDate(): void
    {
        $node = \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], DateTime::class);
        $value = '1979-01-10';

        $node->setDate($value);
        $this->assertEquals($value, $node->getDate());
    }

    public function testSetGetTime(): void
    {
        $node = \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], DateTime::class);
        $value = '10:59:54';

        $node->setTime($value);
        $this->assertEquals($value, $node->getTime());
    }

    public function testSetGetTimeZone(): void
    {
        $node = \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], DateTime::class);
        $value = '-01:00';

        $node->setTimezone($value);
        $this->assertEquals($value, $node->getTimezone());
    }

    public function testSerializeWithoutNullValues(): void
    {
        $node = \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], DateTime::class);
        $context = SerializationContext::create()->setSerializeNull(false);

        $expected = file_get_contents(__DIR__ . '/../Fixtures/empty_datetime_without_null_values.xml');
        $actual = $this->serializer->serialize($node, 'xml', $context);

        $this->assertEquals($expected, $actual);

        $doc = $this->serializer->deserialize($actual, DateTime::class, 'xml');
        $this->assertInstanceOf(DateTime::class, $doc);
    }
}
