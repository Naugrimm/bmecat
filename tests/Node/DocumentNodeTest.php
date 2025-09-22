<?php

namespace Naugrim\BMEcat\Tests\Node;

use JMS\Serializer\SerializationContext;
use JMS\Serializer\Serializer;
use Naugrim\BMEcat\DocumentBuilder;
use Naugrim\BMEcat\Nodes\Document;
use Naugrim\BMEcat\Nodes\Header;
use Naugrim\BMEcat\Nodes\NewCatalog;
use PHPUnit\Framework\TestCase;

class DocumentNodeTest extends TestCase
{
    private Serializer $serializer;

    #[\Override]
    protected function setUp(): void
    {
        $this->serializer = (new DocumentBuilder())->getSerializer();
    }

    public function testSetGetVersion(): void
    {
        $document = \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Document::class);

        $this->assertEquals('2005.1', $document->getVersion());
        $document->setVersion('1.9');
        $this->assertEquals('1.9', $document->getVersion());
    }

    public function testSetGetNewCatalog(): void
    {
        $document = \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Document::class);
        $catalog = \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], NewCatalog::class);

        $document->setNewCatalog($catalog);
        $this->assertSame($catalog, $document->getNewCatalog());
    }

    public function testSetGetNewHeader(): void
    {
        $document = \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Document::class);
        $header = \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Header::class);

        $document->setHeader($header);
        $this->assertSame($header, $document->getHeader());
    }

    public function testSerializeWithoutNullValues(): void
    {
        $node = \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Document::class);
        $context = SerializationContext::create()->setSerializeNull(false);

        $expected = file_get_contents(__DIR__ . '/../Fixtures/empty_document_nochildren_without_null_values.xml');
        $actual = $this->serializer->serialize($node, 'xml', $context);

        $this->assertEquals($expected, $actual);
        $doc = $this->serializer->deserialize($actual, Document::class, 'xml');
        $this->assertInstanceOf(Document::class, $doc);
    }
}
