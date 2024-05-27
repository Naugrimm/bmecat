<?php


namespace Naugrim\BMEcat\Tests\Node;

use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerBuilder;
use Naugrim\BMEcat\DocumentBuilder;
use PHPUnit\Framework\TestCase;
use Naugrim\BMEcat\Nodes\Document;
use Naugrim\BMEcat\Nodes\Header;
use Naugrim\BMEcat\Nodes\NewCatalog;


class DocumentNodeTest extends TestCase
{
    /**
     * @var \JMS\Serializer\SerializerInterface
     */
    private $serializer;

    public function setUp() : void
    {
        $this->serializer = (new DocumentBuilder())->getSerializer();
    }

    /**
     *
     * @test
     */
    public function Set_Get_Version()
    {
        $document = new Document();

        $this->assertEquals('2005.1', $document->getVersion());
        $document->setVersion('1.9');
        $this->assertEquals('1.9', $document->getVersion());
    }

    /**
     *
     * @test
     */
    public function Set_Get_New_Catalog()
    {
        $document = new Document();
        $catalog = new NewCatalog();

        $this->assertNull($document->getNewCatalog());
        $document->setNewCatalog($catalog);
        $this->assertSame($catalog, $document->getNewCatalog());
    }

    /**
     *
     * @test
     */
    public function Set_Get_New_Header()
    {
        $document = new Document();
        $header = new Header();

        $this->assertNull($document->getHeader());
        $document->setHeader($header);
        $this->assertSame($header, $document->getHeader());
    }

    /**
     *
     * @test
     */
    public function Serialize_With_Null_Values()
    {
        $node = new Document();
        $context = SerializationContext::create()->setSerializeNull(true);

        $expected = file_get_contents(__DIR__ . '/../Fixtures/empty_document_nochildren_with_null_values.xml');
        $actual = $this->serializer->serialize($node, 'xml', $context);

        $this->assertEquals($expected, $actual);

        $doc = $this->serializer->deserialize($actual, Document::class, 'xml');
        $this->assertInstanceOf(Document::class, $doc);
    }

    /**
     *
     * @test
     */
    public function Serialize_Without_Null_Values()
    {
        $node = new Document();
        $context = SerializationContext::create()->setSerializeNull(false);

        $expected = file_get_contents(__DIR__ . '/../Fixtures/empty_document_nochildren_without_null_values.xml');
        $actual = $this->serializer->serialize($node, 'xml', $context);

        $this->assertEquals($expected, $actual);
        $doc = $this->serializer->deserialize($actual, Document::class, 'xml');
        $this->assertInstanceOf(Document::class, $doc);
    }
}
