<?php


namespace Naugrim\BMEcat\Tests\Node;

use JMS\Serializer\SerializationContext;
use Naugrim\BMEcat\DocumentBuilder;
use Naugrim\BMEcat\Nodes\SupplierIdRef;
use PHPUnit\Framework\TestCase;
use Naugrim\BMEcat\Nodes\Catalog;
use Naugrim\BMEcat\Nodes\Header;


class HeaderNodeTest extends TestCase
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
    public function Set_Get_Generator_Info(): void
    {
        $node = new Header();
        $value = sha1(uniqid(microtime(false), true));

        $this->assertNull($node->getGeneratorInfo());
        $node->setGeneratorInfo($value);
        $this->assertEquals($value, $node->getGeneratorInfo());
    }

    /**
     *
     * @test
     */
    public function Set_Get_Supplier(): void
    {
        $header = new Header();
        $supplier = new SupplierIdRef();

        $this->assertNull($header->getSupplierIdRef());
        $header->setSupplierIdRef($supplier);
        $this->assertEquals($supplier, $header->getSupplierIdRef());
    }

    /**
     *
     * @test
     */
    public function Set_Get_Catalog(): void
    {
        $header = new Header();
        $catalog = new Catalog();

        $header->setCatalog($catalog);
        $this->assertEquals($catalog, $header->getCatalog());
    }

    /**
     *
     * @test
     */
    public function Serialize_With_Null_Values(): void
    {
        $node = new Header();
        $context = SerializationContext::create()->setSerializeNull(true);

        $expected = file_get_contents(__DIR__ . '/../Fixtures/empty_header_with_null_values.xml');
        $actual = $this->serializer->serialize($node, 'xml', $context);

        $this->assertEquals($expected, $actual);

        $doc = $this->serializer->deserialize($actual, Header::class, 'xml');
        $this->assertInstanceOf(Header::class, $doc);
    }

    /**
     *
     * @test
     */
    public function Serialize_Without_Null_Values(): void
    {
        $node = new Header();
        $context = SerializationContext::create()->setSerializeNull(false);

        $expected = file_get_contents(__DIR__ . '/../Fixtures/empty_header_without_null_values.xml');
        $actual = $this->serializer->serialize($node, 'xml', $context);

        $this->assertEquals($expected, $actual);
        $doc = $this->serializer->deserialize($actual, Header::class, 'xml');
        $this->assertInstanceOf(Header::class, $doc);
    }
}
