<?php

namespace Naugrim\BMEcat\Tests\Node;

use JMS\Serializer\SerializationContext;
use JMS\Serializer\Serializer;
use Naugrim\BMEcat\DocumentBuilder;
use Naugrim\BMEcat\Nodes\SpecialTreatmentClass;
use PHPUnit\Framework\TestCase;

class SpecialTreatmentClassNodeTest extends TestCase
{
    private Serializer $serializer;

    protected function setUp(): void
    {
        $this->serializer = (new DocumentBuilder())->getSerializer();
    }

    public function testSerializeWithNullValues(): void
    {
        $node = new SpecialTreatmentClass();
        $context = SerializationContext::create()->setSerializeNull(true);

        $expected = file_get_contents(__DIR__ . '/../Fixtures/empty_special_treatment_class_with_null_values.xml');
        $actual = $this->serializer->serialize($node, 'xml', $context);

        $this->assertEquals($expected, $actual);

        $doc = $this->serializer->deserialize($actual, SpecialTreatmentClass::class, 'xml');
        $this->assertInstanceOf(SpecialTreatmentClass::class, $doc);
    }

    public function testSerializeWithoutNullValues(): void
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
