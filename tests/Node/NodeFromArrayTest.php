<?php

namespace Naugrim\BMEcat\Tests\Node;

use DateTime;
use DateTimeInterface;
use Naugrim\BMEcat\Builder\NodeBuilder;
use Naugrim\BMEcat\Exception\UnknownKeyException;
use Naugrim\BMEcat\Nodes\Document;
use Naugrim\BMEcat\Nodes\NewCatalog;
use Naugrim\BMEcat\Tests\Fixtures\Node\Node;
use PHPUnit\Framework\TestCase;
use TypeError;

class NodeFromArrayTest extends TestCase
{
    protected string $minimalValidDocument;

    protected function setUp(): void
    {
        parent::setUp();

        $this->minimalValidDocument = (string) file_get_contents(
            __DIR__ . '/../Fixtures/2005.1/minimal_valid_document.xml'
        );
    }

    public function testEmptyArray(): void
    {
        $document = NodeBuilder::fromArray([], \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Document::class));
        $this->assertInstanceOf(Document::class, $document);
    }

    public function testInvalidSetter(): void
    {
        $this->expectException(UnknownKeyException::class);
        NodeBuilder::fromArray([
            'thereisnosetterforthis' => 1,
        ], \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Document::class));
    }

    public function testScalarValue(): void
    {
        $document = NodeBuilder::fromArray([
            'version' => '1234567',
        ], \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Document::class));
        $this->assertEquals('1234567', $document->getVersion());
    }

    public function testObjectValue(): void
    {
        $catalog = \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], NewCatalog::class);
        $document = NodeBuilder::fromArray([
            'newCatalog' => $catalog,
        ], \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Document::class));
        $this->assertSame($catalog, $document->getNewCatalog());
    }

    public function testRecursiveFromArrayWithArrays(): void
    {
        $array = [
            'someArray' => ['123'],
        ];

        $node = NodeBuilder::fromArray([
            'anotherNode' => [
                'anotherNode' => $array,
            ],
        ], Node::class);

        $this->assertInstanceOf(Node::class, $node);
        $this->assertInstanceOf(Node::class, $node->anotherNode);
        $this->assertSame($array['someArray'], $node->anotherNode->anotherNode->someArray);
    }

    public function testSetDateTimeInterfaceFromStringWithoutFormat(): void
    {
        $node = NodeBuilder::fromArray([
            'dateTimeInterfaceWithoutFormat' => '2024-05-30 12:02:00',
        ], Node::class);
        $this->assertInstanceOf(DateTimeInterface::class, $node->dateTimeInterfaceWithoutFormat);
    }

    public function testSetDateTimeInterfaceFromObjectWithoutFormat(): void
    {
        $node = NodeBuilder::fromArray([
            'dateTimeInterfaceWithoutFormat' => new DateTime(),
        ], Node::class);
        $this->assertInstanceOf(DateTimeInterface::class, $node->dateTimeInterfaceWithoutFormat);
    }

    public function testSetDateTimeInterfaceFromStringWithInvalidFormat(): void
    {
        $this->expectException(TypeError::class);
        NodeBuilder::fromArray([
            'dateTimeInterfaceWithFormat' => '2024-05-30 12:02:00',
        ], Node::class);
    }

    public function testSetDateTimeInterfaceFromObjectWithInvalidFormat(): void
    {
        $node = NodeBuilder::fromArray([
            'dateTimeInterfaceWithFormat' => new DateTime(),
        ], Node::class);
        $this->assertInstanceOf(DateTimeInterface::class, $node->dateTimeInterfaceWithFormat);
    }

    public function testSetDateTimeInterfaceFromStringWithFormat(): void
    {
        $node = NodeBuilder::fromArray([
            'dateTimeInterfaceWithFormat' => '2024-05',
        ], Node::class);
        $this->assertInstanceOf(DateTimeInterface::class, $node->dateTimeInterfaceWithFormat);
    }

    public function testSetDateTimeInterfaceFromObjectWithFormat(): void
    {
        $node = NodeBuilder::fromArray([
            'dateTimeInterfaceWithFormat' => new DateTime(),
        ], Node::class);
        $this->assertInstanceOf(DateTimeInterface::class, $node->dateTimeInterfaceWithFormat);
    }
}
