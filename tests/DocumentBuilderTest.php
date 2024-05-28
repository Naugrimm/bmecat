<?php

namespace Naugrim\BMEcat\Tests;

use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use Naugrim\BMEcat\Builder\NodeBuilder;
use Naugrim\BMEcat\DocumentBuilder;
use Naugrim\BMEcat\Exception\MissingDocumentException;
use Naugrim\BMEcat\Nodes\Document;
use PHPUnit\Framework\TestCase;

class DocumentBuilderTest extends TestCase
{
    private Serializer $serializer;

    protected function setUp(): void
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

    public function testInstantiateViaStaticMethod(): void
    {
        $builder = DocumentBuilder::create($this->serializer);
        $this->assertInstanceOf(Serializer::class, $builder->getSerializer());
    }

    public function testToStringReturnsDefaultDocumentWithoutNullValues(): void
    {
        $builder = new DocumentBuilder();
        $document = NodeBuilder::fromArray([], new Document());
        $builder->setDocument($document);

        $expected = file_get_contents(__DIR__ . '/Fixtures/empty_document_without_null_values.xml');
        $this->assertEquals($expected, $builder->toString());
    }

    public function testToStringThrowsException(): void
    {
        $this->expectException(MissingDocumentException::class);
        $builder = new DocumentBuilder();
        $builder->toString();
    }

    public function testFromStringWorksCorrectly(): void
    {
        $builder = new DocumentBuilder();
        $doc = $builder->fromString(
            (string) file_get_contents(__DIR__ . '/Fixtures/2005.1/minimal_valid_document.xml')
        );

        $this->assertInstanceOf(Document::class, $doc);
    }
}
