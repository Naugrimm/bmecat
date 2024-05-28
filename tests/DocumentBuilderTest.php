<?php


namespace Naugrim\BMEcat\Tests;

use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializerInterface;
use Naugrim\BMEcat\Builder\NodeBuilder;
use PHPUnit\Framework\TestCase;
use Naugrim\BMEcat\DocumentBuilder;
use Naugrim\BMEcat\Exception\MissingDocumentException;
use Naugrim\BMEcat\Nodes\Document;


class DocumentBuilderTest extends TestCase
{
    /**
     * @var SerializerInterface
     */
    private Serializer $serializer;

    protected function setUp() : void
    {
        $this->serializer = SerializerBuilder::create()->build();
    }

    public function testCanBeInstantiated(): void
    {
        $builder = new DocumentBuilder($this->serializer);
        $this->assertInstanceOf(DocumentBuilder::class, $builder);
    }

    public function testSetsUpDefaultDependencies(): void
    {
        $builder = new DocumentBuilder();
        $this->assertInstanceOf(Serializer::class, $builder->getSerializer());
    }

    /**
     *
     * @test
     */
    public function Instantiate_Via_Static_Method(): void
    {
        $builder = DocumentBuilder::create($this->serializer);
        $this->assertInstanceOf(Serializer::class, $builder->getSerializer());
    }

    /**
     *
     * @test
     */
    public function To_String_Returns_Default_Document_Without_Null_Values(): void
    {
        $builder = new DocumentBuilder;
        $document = NodeBuilder::fromArray([], new Document());
        $builder->setDocument($document);

        $expected = file_get_contents(__DIR__ . '/Fixtures/empty_document_without_null_values.xml');
        $this->assertEquals($expected, $builder->toString());
    }

    /**
     *
     * @test
     */
    public function To_String_Throws_Exception(): void
    {
        $this->expectException(MissingDocumentException::class);
        $builder = new DocumentBuilder;
        $builder->toString();
    }

    public function testFromStringWorksCorrectly(): void
    {
        $builder = new DocumentBuilder();
        $doc = $builder->fromString(file_get_contents(__DIR__ . '/Fixtures/2005.1/minimal_valid_document.xml'));

        $this->assertInstanceOf(Document::class, $doc);
    }
}
