<?php


namespace Naugrim\BMEcat\Tests\Node;

use JMS\Serializer\SerializationContext;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializerInterface;
use Naugrim\BMEcat\DocumentBuilder;
use PHPUnit\Framework\TestCase;
use Naugrim\BMEcat\Nodes\Catalog;
use Naugrim\BMEcat\Nodes\DateTime;


class CatalogNodeTest extends TestCase
{
    private Serializer $serializer;

    protected function setUp() : void
    {
        $this->serializer = (new DocumentBuilder())->getSerializer();
    }

    /**
     *
     * @test
     */
    public function Set_Get_Id(): void
    {
        $node = new Catalog();
        $value = sha1(uniqid(microtime(false), true));
        $node->setId($value);
        $this->assertEquals($value, $node->getId());
    }

    /**
     *
     * @test
     */
    public function Set_Get_Version(): void
    {
        $node = new Catalog();
        $value = sha1(uniqid(microtime(false), true));
        $node->setVersion($value);
        $this->assertEquals($value, $node->getVersion());
    }

    /**
     *
     * @test
     */
    public function Set_Get_Language(): void
    {
        $node = new Catalog();
        $value = sha1(uniqid(microtime(false), true));

        $node->setLanguage($value);
        $this->assertEquals($value, $node->getLanguage());
    }

    /**
     *
     * @test
     */
    public function Set_Get_Date_Time(): void
    {
        $node = new Catalog();
        $dateTime = new DateTime();

        $this->assertNull($node->getDateTime());
        $node->setDateTime($dateTime);
        $this->assertEquals($dateTime, $node->getDateTime());
    }

    /**
     *
     * @test
     */
    public function Serialize_Without_Null_Values(): void
    {
        $node = new Catalog();
        $context = SerializationContext::create()->setSerializeNull(false);

        $expected = file_get_contents(__DIR__ . '/../Fixtures/empty_catalog_without_null_values.xml');
        $actual = $this->serializer->serialize($node, 'xml', $context);

        $this->assertEquals($expected, $actual);

        $doc = $this->serializer->deserialize($actual, Catalog::class, 'xml');
        $this->assertInstanceOf(Catalog::class, $doc);
    }
}
