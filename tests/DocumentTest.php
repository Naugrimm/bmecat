<?php

namespace Naugrim\BMEcat\Tests;

use Naugrim\BMEcat\Builder\NodeBuilder;
use Naugrim\BMEcat\DocumentBuilder;
use Naugrim\BMEcat\Nodes\Document;
use Naugrim\BMEcat\Nodes\Mime;
use Naugrim\BMEcat\Nodes\NewCatalog;
use Naugrim\BMEcat\Nodes\Product;
use Naugrim\BMEcat\Nodes\Product\Details;
use Naugrim\BMEcat\Nodes\Product\Features;
use Naugrim\BMEcat\Nodes\Product\OrderDetails;
use Naugrim\BMEcat\Nodes\Product\Price;
use Naugrim\BMEcat\Nodes\Product\PriceDetails;
use Naugrim\BMEcat\Nodes\SupplierPid;
use Naugrim\BMEcat\SchemaValidator;
use PHPUnit\Framework\TestCase;

class DocumentTest extends TestCase
{
    private DocumentBuilder $builder;

    protected function setUp(): void
    {
        $document = NodeBuilder::fromArray([
            'header' => [
                'generatorInfo' => 'DocumentTest Document',
                'catalog' => [
                    'language' => [
                        ['value' => 'eng',]
                    ],
                    'id' => 'MY_CATALOG',
                    'version' => '0.99',
                    'dateTime' => [
                        'date' => '1979-01-01',
                        'time' => '10:59:54',
                        'timezone' => '-01:00',
                    ],
                ],
                'supplierIdRef' => [
                    'value' => 'BMECAT_TEST',
                ],
            ],
        ], \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Document::class));

        $builder = new DocumentBuilder();
        $builder->setDocument($document);

        $catalog = \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], NewCatalog::class);
        $document->setNewCatalog($catalog);

        foreach (['1', '2', '3'] as $index) {
            $product = \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Product::class);
            $supplierPid = \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], SupplierPid::class);
            $supplierPid->setValue($index);
            $product->setId($supplierPid);
            $productDetails = \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Details::class);
            $productDetails->setDescriptionShort('description');
            $product->setDetails($productDetails);

            foreach ([['EUR', 10.50], ['GBP', 7.30]] as $value) {
                [$currency, $amount] = $value;

                $price = \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Price::class);

                $price->setPrice($amount);
                $price->setCurrency($currency);

                $priceDetail = \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], PriceDetails::class);
                $priceDetail->addPrice($price);

                $product->addPriceDetail($priceDetail);
            }

            foreach ([['A', 'B', 'C', 1, 2, 'D', 'E'], ['F', 'G', 'H', 3, 4, 'I', 'J']] as $value) {
                [$systemName, $groupName, $groupId, $serialNumber, $tarifNumber, $countryOfOrigin, $tariftext] = $value;

                $features = \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Features::class);

                $features->setReferenceFeatureSystemName($systemName);
                $features->setReferenceFeatureGroupName([$groupName]);
                $product->addFeatures($features);
            }

            foreach ([
                ['image/jpeg', 'http://a.b/c/d.jpg', 'normal'],
                ['image/gif', 'http://w.x/y/z.bmp', 'thumbnail'],
            ] as $value) {
                [$type, $source, $purpose] = $value;

                $mime = \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Mime::class);

                $mime->setType($type);
                $mime->setSource($source);
                $mime->setPurpose($purpose);

                $product->addMime($mime);
            }

            $orderDetails = \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], OrderDetails::class);
            $orderDetails->setOrderUnit('C62');
            $orderDetails->setContentUnit('C62');
            $orderDetails->setNoCuPerOu(1);
            $orderDetails->setPriceQuantity(1);
            $orderDetails->setQuantityMin(1);
            $orderDetails->setQuantityInterval(1);

            $product->setOrderDetails($orderDetails);

            $catalog->addProduct($product);
        }

        $this->builder = $builder;
    }

    public function testCompareDocumentWithoutNullValues(): void
    {
        $expected = file_get_contents(__DIR__ . '/Fixtures/document_without_null_values.xml');
        $actual = $this->builder->toString();

        $this->assertEquals($expected, $actual);

        $this->assertTrue(SchemaValidator::isValid($actual, '2005.1'));
    }
}
