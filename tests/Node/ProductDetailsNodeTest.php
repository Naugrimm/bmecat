<?php

namespace Naugrim\BMEcat\Tests\Node;

use JMS\Serializer\SerializationContext;
use JMS\Serializer\Serializer;
use Naugrim\BMEcat\DocumentBuilder;
use Naugrim\BMEcat\Nodes\BuyerPid;
use Naugrim\BMEcat\Nodes\Product\Details;
use Naugrim\BMEcat\Nodes\Product\Keyword;
use Naugrim\BMEcat\Nodes\Product\Status;
use Naugrim\BMEcat\Nodes\SpecialTreatmentClass;
use PHPUnit\Framework\TestCase;

class ProductDetailsNodeTest extends TestCase
{
    private Serializer $serializer;

    protected function setUp(): void
    {
        $this->serializer = (new DocumentBuilder())->getSerializer();
    }

    public function testAddGetBuyerPides(): void
    {
        $buyerPids = [
            \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], BuyerPid::class),
            \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], BuyerPid::class),
            \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], BuyerPid::class),
        ];

        $node = \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Details::class);
        $this->assertEmpty($node->getBuyerPids());
        $node->nullBuyerPids();
        $this->assertEquals([], $node->getBuyerPids());

        foreach ($buyerPids as $buyerPid) {
            $node->addBuyerPid($buyerPid);
        }

        $this->assertEquals($buyerPids, $node->getBuyerPids());
    }

    public function testAddGetSpecialTreatmentClasses(): void
    {
        $specialTreatmentClasses = [
            \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], SpecialTreatmentClass::class),
            \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], SpecialTreatmentClass::class),
            \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], SpecialTreatmentClass::class),
        ];

        $node = \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Details::class);
        $this->assertEmpty($node->getSpecialTreatmentClasses());
        $node->nullSpecialTreatmentClasses();
        $this->assertEquals([], $node->getSpecialTreatmentClasses());

        foreach ($specialTreatmentClasses as $specialTreatmentClass) {
            $node->addSpecialTreatmentClass($specialTreatmentClass);
        }

        $this->assertEquals($specialTreatmentClasses, $node->getSpecialTreatmentClasses());
    }

    public function testAddGetKeywords(): void
    {
        $keywords = [
            \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Keyword::class),
            \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Keyword::class),
            \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Keyword::class),
        ];

        $node = \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Details::class);
        $this->assertEmpty($node->getKeywords());
        $node->nullKeywords();
        $this->assertEquals([], $node->getKeywords());

        foreach ($keywords as $keyword) {
            $node->addKeyword($keyword);
        }

        $this->assertEquals($keywords, $node->getKeywords());
    }

    public function testAddGetProductStatus(): void
    {
        $productStatus = [
            \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Status::class),
            \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Status::class),
            \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Status::class),
        ];

        $node = \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Details::class);
        $this->assertEmpty($node->getProductStatus());
        $node->nullProductStatus();
        $this->assertEquals([], $node->getProductStatus());

        foreach ($productStatus as $singleProductStatus) {
            $node->addProductStatus($singleProductStatus);
        }

        $this->assertEquals($productStatus, $node->getProductStatus());
    }

    public function testSetGetDescriptionLong(): void
    {
        $node = \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Details::class);
        $value = sha1(uniqid(microtime(false), true));

        $this->assertNull($node->getDescriptionLong());
        $node->setDescriptionLong($value);
        $this->assertEquals($value, $node->getDescriptionLong());
    }

    public function testSetGetDescriptionShort(): void
    {
        $node = \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Details::class);
        $value = sha1(uniqid(microtime(false), true));

        $node->setDescriptionShort($value);
        $this->assertEquals($value, $node->getDescriptionShort());
    }

    public function testSetGetEan(): void
    {
        $node = \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Details::class);
        $value = sha1(uniqid(microtime(false), true));

        $this->assertNull($node->getEan());
        $node->setEan($value);
        $this->assertEquals($value, $node->getEan());
    }

    public function testSetGetSupplierAltPid(): void
    {
        $node = \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Details::class);
        $value = sha1(uniqid(microtime(false), true));

        $this->assertNull($node->getSupplierAltPid());
        $node->setSupplierAltPid($value);
        $this->assertEquals($value, $node->getSupplierAltPid());
    }

    public function testSetGetManufacturerName(): void
    {
        $node = \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Details::class);
        $value = sha1(uniqid(microtime(false), true));

        $this->assertNull($node->getManufacturerName());
        $node->setManufacturerName($value);
        $this->assertEquals($value, $node->getManufacturerName());
    }

    public function testSetGetManufacturerTypeDescription(): void
    {
        $node = \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Details::class);
        $value = sha1(uniqid(microtime(false), true));

        $this->assertNull($node->getManufacturerTypeDescription());
        $node->setManufacturerTypeDescription($value);
        $this->assertEquals($value, $node->getManufacturerTypeDescription());
    }

    public function testSetGetErpGroupBuyer(): void
    {
        $node = \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Details::class);
        $value = sha1(uniqid(microtime(false), true));

        $this->assertNull($node->getErpGroupBuyer());
        $node->setErpGroupBuyer($value);
        $this->assertEquals($value, $node->getErpGroupBuyer());
    }

    public function testSetGetErpGroupSupplier(): void
    {
        $node = \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Details::class);
        $value = sha1(uniqid(microtime(false), true));

        $this->assertNull($node->getErpGroupSupplier());
        $node->setErpGroupSupplier($value);
        $this->assertEquals($value, $node->getErpGroupSupplier());
    }

    public function testSetGetDeliveryTime(): void
    {
        $node = \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Details::class);
        $value = random_int(10, 1000);

        $this->assertNull($node->getDeliveryTime());
        $node->setDeliveryTime($value);
        $this->assertEquals($value, $node->getDeliveryTime());
    }

    public function testSetGetRemarks(): void
    {
        $node = \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Details::class);
        $value = sha1(uniqid(microtime(false), true));

        $this->assertNull($node->getRemarks());
        $node->setRemarks($value);
        $this->assertEquals($value, $node->getRemarks());
    }

    public function testSetGetProductOrder(): void
    {
        $node = \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Details::class);
        $value = random_int(10, 1000);

        $this->assertNull($node->getProductOrder());
        $node->setProductOrder($value);
        $this->assertEquals($value, $node->getProductOrder());
    }

    public function testSetGetDescriptionSegment(): void
    {
        $node = \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Details::class);
        $value = sha1(uniqid(microtime(false), true));

        $this->assertNull($node->getSegment());
        $node->setSegment($value);
        $this->assertEquals($value, $node->getSegment());
    }

    public function testSerializeWithoutNullValues(): void
    {
        $node = \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Details::class);
        $node->setDescriptionShort('test');

        $context = SerializationContext::create()->setSerializeNull(false);

        $expected = file_get_contents(__DIR__ . '/../Fixtures/empty_product_details_without_null_values.xml');
        $actual = $this->serializer->serialize($node, 'xml', $context);

        $this->assertEquals($expected, $actual);

        $doc = $this->serializer->deserialize($actual, Details::class, 'xml');
        $this->assertInstanceOf(Details::class, $doc);
    }
}
