<?php


namespace Naugrim\BMEcat\Tests\Node;

use JMS\Serializer\SerializationContext;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerInterface;
use Naugrim\BMEcat\DocumentBuilder;
use Naugrim\BMEcat\Nodes\Product\Feature;
use Naugrim\BMEcat\Nodes\Product\Features;
use PHPUnit\Framework\TestCase;


class ProductFeaturesNodeTest extends TestCase
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
    public function Add_Get_Feature(): void
    {
        $features = [
            new Feature(),
            new Feature(),
            new Feature(),
        ];

        $node = new Features();
        $this->assertEmpty($node->getFeatures());
        $node->nullFeatures();
        $this->assertEquals([], $node->getFeatures());

        foreach ($features as $feature) {
            $node->addFeature($feature);
        }

        $this->assertSame($features, $node->getFeatures());
    }

    /**
     *
     * @test
     */
    public function Set_Get_Reference_Feature_System_Name(): void
    {
        $node = new Features();
        $value = sha1(uniqid(microtime(false), true));

        $this->assertNull($node->getReferenceFeatureSystemName());
        $node->setReferenceFeatureSystemName($value);
        $this->assertEquals($value, $node->getReferenceFeatureSystemName());
    }

    /**
     *
     * @test
     */
    public function Set_Get_Reference_Feature_Group_Name(): void
    {
        $node = new Features();
        $value = sha1(uniqid(microtime(false), true));

        $this->assertNull($node->getReferenceFeatureGroupName());
        $node->setReferenceFeatureGroupName($value);
        $this->assertEquals($value, $node->getReferenceFeatureGroupName());
    }

    /**
     *
     * @test
     */
    public function Set_Get_Reference_Feature_Group_Id(): void
    {
        $node = new Features();
        $value = sha1(uniqid(microtime(false), true));

        $this->assertNull($node->getReferenceFeatureGroupId());
        $node->setReferenceFeatureGroupId($value);
        $this->assertEquals($value, $node->getReferenceFeatureGroupId());
    }

    /**
     *
     * @test
     */
    public function Serialize_With_Null_Values(): void
    {
        $node = new Features();
        $context = SerializationContext::create()->setSerializeNull(true);

        $expected = file_get_contents(__DIR__ . '/../Fixtures/empty_product_features_with_null_values.xml');
        $actual = $this->serializer->serialize($node, 'xml', $context);

        $this->assertEquals($expected, $actual);
    }

    /**
     *
     * @test
     */
    public function Serialize_Without_Null_Values(): void
    {
        $node = new Features();
        $context = SerializationContext::create()->setSerializeNull(false);

        $expected = file_get_contents(__DIR__ . '/../Fixtures/empty_product_features_without_null_values.xml');
        $actual = $this->serializer->serialize($node, 'xml', $context);

        $this->assertEquals($expected, $actual);

        $doc = $this->serializer->deserialize($actual, Features::class, 'xml');
        $this->assertInstanceOf(Features::class, $doc);
    }

    public function testFeaturesAreInlinedCorrectly(): void
    {
        $context = SerializationContext::create()->setSerializeNull(false);

        $node = new Features();
        $productFeature = new Feature();
        $productFeature->setName('Feature name');
        $productFeature->setValue('Feature value');

        $node->addFeature($productFeature);

        $expected = file_get_contents(__DIR__ . '/../Fixtures/product_features.xml');
        $actual = $this->serializer->serialize($node, 'xml', $context);

        $this->assertEquals($expected, $actual);

        $doc = $this->serializer->deserialize($actual, Features::class, 'xml');
        $this->assertInstanceOf(Features::class, $doc);
    }
}
