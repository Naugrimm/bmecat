<?php

namespace Naugrim\BMEcat\Tests\Node;

use Naugrim\BMEcat\Builder\NodeBuilder;
use Naugrim\BMEcat\Exception\InvalidSetterException;
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

    public function testInvalidSetterNoArguments(): void
    {
        $this->expectException(InvalidSetterException::class);
        NodeBuilder::fromArray([
            'noArguments' => [],
        ], \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Node::class));
    }

    public function testInvalidSetterNoTypeHint(): void
    {
        $this->expectException(InvalidSetterException::class);
        NodeBuilder::fromArray([
            'noTypeHint' => [],
        ], \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Node::class));
    }

    public function testInvalidSetterScalarTypeHint(): void
    {
        $this->expectException(TypeError::class);
        NodeBuilder::fromArray([
            'scalarTypeHint' => [],
        ], \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Node::class));
    }

    public function testSetterMatchingTypeHintFloat(): void
    {
        $float = 1.23456;
        $node = NodeBuilder::fromArray([
            'matchingTypeHintFloat' => $float,
        ], \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Node::class));
        $this->assertEquals($float, $node->someFloat);
    }

    public function testSetterMatchingTypeHintArray(): void
    {
        $array = [];
        $node = NodeBuilder::fromArray([
            'matchingTypeHintArray' => $array,
        ], \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Node::class));
        $this->assertSame($array, $node->someArray);
    }

    public function testSetterMatchingTypeHintNode(): void
    {
        $anotherNode = \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Node::class);
        $node = NodeBuilder::fromArray([
            'matchingTypeHintNode' => $anotherNode,
        ], \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Node::class));
        $this->assertSame($anotherNode, $node->anotherNode);
    }

    public function testRecursiveFromArrayWithArrays(): void
    {
        $array = [
            'test' => '123',
        ];

        $node = NodeBuilder::fromArray([
            'matchingTypeHintNode' => [
                'matchingTypeHintArray' => $array,
            ],
        ], \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Node::class));

        $this->assertInstanceOf(Node::class, $node);
        $this->assertInstanceOf(Node::class, $node->anotherNode);
        $this->assertSame($array, $node->anotherNode->someArray);
    }
}
