<?php


namespace Naugrim\BMEcat\Tests\Node;

use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerBuilder;
use Naugrim\BMEcat\DocumentBuilder;
use PHPUnit\Framework\TestCase;
use Naugrim\BMEcat\Nodes\DateTime;


class DateTimeNodeTest extends TestCase
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
     *
     * @test
     */
    public function Set_Get_Date(): void
    {
        $node = new DateTime();
        $value = '1979-01-10';

        $this->assertNull($node->getDate());
        $node->setDate($value);
        $this->assertEquals($value, $node->getDate());
    }

    /**
     *
     * @test
     */
    public function Set_Get_Time(): void
    {
        $node = new DateTime();
        $value = '10:59:54';

        $this->assertNull($node->getTime());
        $node->setTime($value);
        $this->assertEquals($value, $node->getTime());
    }

    /**
     *
     * @test
     */
    public function Set_Get_TimeZone(): void
    {
        $node = new DateTime();
        $value = '-01:00';

        $this->assertNull($node->getTimeZone());
        $node->setTimeZone($value);
        $this->assertEquals($value, $node->getTimeZone());
    }

    /**
     *
     * @test
     */
    public function Serialize_With_Null_Values(): void
    {
        $node = new DateTime();
        $context = SerializationContext::create()->setSerializeNull(true);

        $expected = file_get_contents(__DIR__ . '/../Fixtures/empty_datetime_with_null_values.xml');
        $actual = $this->serializer->serialize($node, 'xml', $context);

        $this->assertEquals($expected, $actual);

        $doc = $this->serializer->deserialize($actual, DateTime::class, 'xml');
        $this->assertInstanceOf(DateTime::class, $doc);
    }

    /**
     *
     * @test
     */
    public function Serialize_Without_Null_Values(): void
    {
        $node = new DateTime();
        $context = SerializationContext::create()->setSerializeNull(false);

        $expected = file_get_contents(__DIR__ . '/../Fixtures/empty_datetime_without_null_values.xml');
        $actual = $this->serializer->serialize($node, 'xml', $context);

        $this->assertEquals($expected, $actual);

        $doc = $this->serializer->deserialize($actual, DateTime::class, 'xml');
        $this->assertInstanceOf(DateTime::class, $doc);
    }
}
