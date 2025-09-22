<?php

namespace Naugrim\BMEcat\Tests\Node;

use JMS\Serializer\SerializationContext;
use JMS\Serializer\Serializer;
use Naugrim\BMEcat\DocumentBuilder;
use Naugrim\BMEcat\Nodes\Catalog;
use Naugrim\BMEcat\Nodes\DateTime;
use PHPUnit\Framework\TestCase;

class CatalogNodeTest extends TestCase
{
    private Serializer $serializer;

    #[\Override]
    protected function setUp(): void
    {
        $this->serializer = new DocumentBuilder()
            ->getSerializer();
    }

    public function testSetGetId(): void
    {
        $node = \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Catalog::class);
        $value = sha1(uniqid(microtime(false), true));
        $node->setId($value);
        $this->assertEquals($value, $node->getId());
    }

    public function testSetGetVersion(): void
    {
        $node = \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Catalog::class);
        $value = sha1(uniqid(microtime(false), true));
        $node->setVersion($value);
        $this->assertEquals($value, $node->getVersion());
    }

    public function testSetGetLanguage(): void
    {
        $node = \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Catalog::class);
        $value = [
            [
                'value' => $langValue = sha1(uniqid(microtime(false), true)),
            ],
        ];

        $node->setLanguage($value);
        $lang = $node->getLanguage();
        $this->assertCount(1, $lang);
        \Webmozart\Assert\Assert::notEmpty($lang, 'Language array should not be empty');
        \Webmozart\Assert\Assert::isInstanceOf(
            $lang[0],
            \Naugrim\BMEcat\Nodes\Language::class,
            'First language must be an instance of Language'
        );
        $this->assertEquals($langValue, $lang[0]->getValue());
    }

    public function testSetGetDateTime(): void
    {
        $node = \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Catalog::class);
        $dateTime = \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], DateTime::class);

        $this->assertNull($node->getDateTime());
        $node->setDateTime($dateTime);
        $this->assertEquals($dateTime, $node->getDateTime());
    }

    public function testSerializeWithoutNullValues(): void
    {
        $node = \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Catalog::class);
        $context = SerializationContext::create()->setSerializeNull(false);

        $expected = file_get_contents(__DIR__ . '/../Fixtures/empty_catalog_without_null_values.xml');
        $actual = $this->serializer->serialize($node, 'xml', $context);

        $this->assertEquals($expected, $actual);

        $doc = $this->serializer->deserialize($actual, Catalog::class, 'xml');
        $this->assertInstanceOf(Catalog::class, $doc);
    }
}
