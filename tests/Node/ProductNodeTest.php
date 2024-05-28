<?php


namespace Naugrim\BMEcat\Tests\Node;

use JMS\Serializer\SerializationContext;
use Naugrim\BMEcat\DocumentBuilder;
use Naugrim\BMEcat\Nodes\Mime;
use Naugrim\BMEcat\Nodes\Product;
use Naugrim\BMEcat\Nodes\Product\Details;
use Naugrim\BMEcat\Nodes\Product\Features;
use Naugrim\BMEcat\Nodes\Product\OrderDetails;
use Naugrim\BMEcat\Nodes\Product\Price;
use Naugrim\BMEcat\Nodes\Product\PriceDetails;
use Naugrim\BMEcat\Nodes\SupplierPid;
use PHPUnit\Framework\TestCase;


class ProductNodeTest extends TestCase
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
    public function Set_Get_Id(): void
    {
        $node = new Product();
        $value = sha1(uniqid(microtime(false), true));

        $this->assertNull($node->getId());
        $supplierPid = new SupplierPid();
        $supplierPid->setValue($value);

        $node->setId($supplierPid);

        $this->assertEquals($value, $node->getId()->getValue());
    }

    /**
     *
     * @test
     */
    public function Set_Get_Details(): void
    {
        $node = new Product();
        $details = new Details();

        $this->assertNull($node->getDetails());
        $node->setDetails($details);
        $this->assertEquals($details, $node->getDetails());
    }

    /**
     *
     * @test
     */
    public function Add_Get_Features(): void
    {
        $features = [
            new Features(),
            new Features(),
            new Features(),
        ];

        $node = new Product();
        $this->assertEmpty($node->getFeatures());
        $node->nullFeatures();
        $this->assertEquals([], $node->getFeatures());

        foreach ($features as $featureBlock) {
            $node->addFeatures($featureBlock);
        }

        $this->assertSame($features, $node->getFeatures());
    }

    /**
     *
     * @test
     */
    public function Add_Get_Prices(): void
    {
        $priceDetails = [
            (new PriceDetails)->addPrice(new Price()),
            (new PriceDetails)->addPrice(new Price()),
            (new PriceDetails)->addPrice(new Price()),
        ];

        $node = new Product();
        $this->assertEmpty($node->getPriceDetails());
        $node->nullPriceDetails();
        $this->assertEquals([], $node->getPriceDetails());

        foreach ($priceDetails as $priceDetail) {
            $node->addPriceDetail($priceDetail);
        }

        $this->assertSame($priceDetails, $node->getPriceDetails());
    }

    /**
     *
     * @test
     */
    public function Add_Get_Product_Order_Details(): void
    {
        $node = new Product();
        $value = new OrderDetails();

        $this->assertEmpty($node->getOrderDetails());
        $node->setOrderDetails($value);
        $this->assertSame($value, $node->getOrderDetails());
    }

    /**
     *
     * @test
     */
    public function Add_Get_Mime_Info(): void
    {
        $mimes = [
            new Mime(),
            new Mime(),
            new Mime(),
        ];

        $node = new Product();
        $this->assertEmpty($node->getMimes());
        $node->nullMime();
        $this->assertEquals(null, $node->getMimes());

        foreach ($mimes as $mime) {
            $node->addMime($mime);
        }

        $this->assertSame($mimes, $node->getMimes());
    }

    /**
     *
     * @test
     */
    public function Serialize_With_Null_Values(): void
    {
        $node = new Product();
        $context = SerializationContext::create()->setSerializeNull(true);

        $expected = file_get_contents(__DIR__ . '/../Fixtures/empty_product_with_null_values.xml');
        $actual = $this->serializer->serialize($node, 'xml', $context);
        $this->assertEquals($expected, $actual);
    }

    /**
     *
     * @test
     */
    public function Serialize_Without_Null_Values(): void
    {
        $node = new Product();
        $context = SerializationContext::create()->setSerializeNull(false);

        $expected = file_get_contents(__DIR__ . '/../Fixtures/empty_product_without_null_values.xml');
        $actual = $this->serializer->serialize($node, 'xml', $context);

        $this->assertEquals($expected, $actual);

        $doc = $this->serializer->deserialize($actual, Product::class, 'xml');
        $this->assertInstanceOf(Product::class, $doc);
    }
}
