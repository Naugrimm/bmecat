<?php

namespace Naugrim\BMEcat\Tests\Node;

use JMS\Serializer\SerializationContext;
use JMS\Serializer\Serializer;
use Naugrim\BMEcat\DocumentBuilder;
use Naugrim\BMEcat\Nodes\BuyerPid;
use PHPUnit\Framework\TestCase;

class BuyerAidNodeTest extends TestCase
{
    private Serializer $serializer;

    #[\Override]
    protected function setUp(): void
    {
        $this->serializer = (new DocumentBuilder())->getSerializer();
    }

    public function testSerializeWithNullValues(): void
    {
        $node = \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], BuyerPid::class);
        $node->setType('');
        $node->setValue('');

        $context = SerializationContext::create()->setSerializeNull(true);

        $expected = file_get_contents(__DIR__ . '/../Fixtures/empty_buyer_pid_with_null_values.xml');
        $actual = $this->serializer->serialize($node, 'xml', $context);

        $this->assertEquals($expected, $actual);

        $doc = $this->serializer->deserialize($actual, BuyerPid::class, 'xml');
        $this->assertInstanceOf(BuyerPid::class, $doc);
    }

    public function testSerializeWithoutNullValues(): void
    {
        $node = \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], BuyerPid::class);
        $node->setType('');
        $node->setValue('');

        $context = SerializationContext::create()->setSerializeNull(false);

        $expected = file_get_contents(__DIR__ . '/../Fixtures/empty_buyer_pid_without_null_values.xml');
        $actual = $this->serializer->serialize($node, 'xml', $context);

        $this->assertEquals($expected, $actual);

        $doc = $this->serializer->deserialize($actual, BuyerPid::class, 'xml');
        $this->assertInstanceOf(BuyerPid::class, $doc);
    }
}
