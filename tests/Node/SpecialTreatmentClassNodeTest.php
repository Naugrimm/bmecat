<?php

namespace Naugrim\BMEcat\Tests\Node;

use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerBuilder;
use Naugrim\BMEcat\DocumentBuilder;
use PHPUnit\Framework\TestCase;
use Naugrim\BMEcat\Nodes\SpecialTreatmentClass;

class SpecialTreatmentClassNodeTest extends TestCase
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
        $node = new SpecialTreatmentClass();
        $context = SerializationContext::create()->setSerializeNull(true);

        $expected = file_get_contents(__DIR__ . '/../Fixtures/empty_special_treatment_class_with_null_values.xml');
        $actual = $this->serializer->serialize($node, 'xml', $context);

        $this->assertEquals($expected, $actual);

        $doc = $this->serializer->deserialize($actual, SpecialTreatmentClass::class, 'xml');
        $this->assertInstanceOf(SpecialTreatmentClass::class, $doc);
    }

    /**
     * @test
     */
    public function Serialize_Without_Null_Values(): void
    {
        $node = new SpecialTreatmentClass();
        $context = SerializationContext::create()->setSerializeNull(false);

        $expected = file_get_contents(__DIR__ . '/../Fixtures/empty_special_treatment_class_without_null_values.xml');
        $actual = $this->serializer->serialize($node, 'xml', $context);

        $this->assertEquals($expected, $actual);

        $doc = $this->serializer->deserialize($actual, SpecialTreatmentClass::class, 'xml');
        $this->assertInstanceOf(SpecialTreatmentClass::class, $doc);
    }
}
