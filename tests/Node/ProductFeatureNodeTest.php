<?php


namespace Naugrim\BMEcat\Tests\Node;

use JMS\Serializer\SerializationContext;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerInterface;
use Naugrim\BMEcat\DocumentBuilder;
use Naugrim\BMEcat\Nodes\Product\Feature;
use PHPUnit\Framework\TestCase;


class ProductFeatureNodeTest extends TestCase
{
    /**
     * @var SerializerInterface
     */
    private Serializer $serializer;

    protected function setUp() : void
    {
        $this->serializer = (new DocumentBuilder())->getSerializer();
    }

    /**
     *
     * @test
     */
    public function Set_Get_Name(): void
    {
        $node = new Feature();
        $value = sha1(uniqid(microtime(false), true));

        $this->assertNull($node->getName());
        $node->setName($value);
        $this->assertEquals($value, $node->getName());
    }

    /**
     *
     * @test
     */
    public function Set_Get_Value(): void
    {
        $node = new Feature();
        $value = sha1(uniqid(microtime(false), true));

        $this->assertNull($node->getValue());
        $node->setValue($value);
        $this->assertEquals($value, $node->getValue());
    }

    /**
     *
     * @test
     */
    public function Serialize_With_Null_Values(): void
    {
        $node = new Feature();
        $context = SerializationContext::create()->setSerializeNull(true);

        $expected = file_get_contents(__DIR__ . '/../Fixtures/empty_product_feature_with_null_values.xml');
        $actual = $this->serializer->serialize($node, 'xml', $context);

        $this->assertEquals($expected, $actual);
    }

    /**
     *
     * @test
     */
    public function Serialize_Without_Null_Values(): void
    {
        $node = new Feature();
        $node->setName('test');

        $context = SerializationContext::create()->setSerializeNull(false);

        $expected = file_get_contents(__DIR__ . '/../Fixtures/empty_product_feature_without_null_values.xml');
        $actual = $this->serializer->serialize($node, 'xml', $context);

        $this->assertEquals($expected, $actual);

        $doc = $this->serializer->deserialize($actual, Feature::class, 'xml');
        $this->assertInstanceOf(Feature::class, $doc);
    }
}
