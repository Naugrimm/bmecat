<?php


namespace Naugrim\BMEcat\Tests\Node;

use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerBuilder;
use Naugrim\BMEcat\DocumentBuilder;
use PHPUnit\Framework\TestCase;
use Naugrim\BMEcat\Nodes\Mime;

class MimeNodeTest extends TestCase
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
    public function Set_Get_Type(): void
    {
        $node = new Mime();
        $value = sha1(uniqid(microtime(false), true));

        $this->assertNull($node->getType());
        $node->setType($value);
        $this->assertEquals($value, $node->getType());
    }

    /**
     * @test
     */
    public function Set_Get_Source(): void
    {
        $node = new Mime();
        $value = sha1(uniqid(microtime(false), true));

        $this->assertNull($node->getSource());
        $node->setSource($value);
        $this->assertEquals($value, $node->getSource());
    }

    /**
     * @test
     */
    public function Set_Get_Purpose(): void
    {
        $node = new Mime();
        $value = sha1(uniqid(microtime(false), true));

        $this->assertNull($node->getPurpose());
        $node->setPurpose($value);
        $this->assertEquals($value, $node->getPurpose());
    }

    /**
     *
     * @test
     */
    public function Serialize_With_Null_Values(): void
    {
        $node = new Mime();
        $context = SerializationContext::create()->setSerializeNull(true);

        $expected = file_get_contents(__DIR__ . '/../Fixtures/empty_mime_info_with_null_values.xml');
        $actual = $this->serializer->serialize($node, 'xml', $context);

        $this->assertEquals($expected, $actual);

        $doc = $this->serializer->deserialize($actual, Mime::class, 'xml');
        $this->assertInstanceOf(Mime::class, $doc);
    }

    /**
     *
     * @test
     */
    public function Serialize_Without_Null_Values(): void
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
