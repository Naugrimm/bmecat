<?php

namespace Naugrim\BMEcat\Tests\Node;

use JMS\Serializer\SerializationContext;
use Naugrim\BMEcat\DocumentBuilder;
use Naugrim\BMEcat\Nodes\Document;
use PHPUnit\Framework\TestCase;
use Naugrim\BMEcat\Nodes\BuyerPid;

class BuyerAidNodeTest extends TestCase
{

    /**
     * @var \JMS\Serializer\SerializerInterface
     */
    private $serializer;

    protected function setUp() : void
    {
        $this->serializer = (new DocumentBuilder())->getSerializer();
    }

    /**
     * @test
     */
    public function Serialize_With_Null_Values(): void
    {
        $node = new BuyerPid();
        $node->setType('');
        $node->setValue('');

        $context = SerializationContext::create()->setSerializeNull(true);

        $expected = file_get_contents(__DIR__ . '/../Fixtures/empty_buyer_pid_with_null_values.xml');
        $actual = $this->serializer->serialize($node, 'xml', $context);

        $this->assertEquals($expected, $actual);

        $doc = $this->serializer->deserialize($actual, BuyerPid::class, 'xml');
        $this->assertInstanceOf(BuyerPid::class, $doc);
    }

    /**
     * @test
     */
    public function Serialize_Without_Null_Values(): void
    {
        $node = new BuyerPid();
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
