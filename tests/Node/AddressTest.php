<?php

namespace Naugrim\BMEcat\Tests\Node;

use Naugrim\BMEcat\Builder\NodeBuilder;
use Naugrim\BMEcat\DocumentBuilder;
use Naugrim\BMEcat\Exception\InvalidSetterException;
use Naugrim\BMEcat\Exception\UnknownKeyException;
use Naugrim\BMEcat\Nodes\Document;
use Naugrim\BMEcat\Nodes\NewCatalog;
use Naugrim\BMEcat\SchemaValidator;
use PHPUnit\Framework\TestCase;

class AddressTest extends TestCase
{
    /**
     * @param array<string, mixed> $data
     * @throws InvalidSetterException
     * @throws UnknownKeyException
     */
    private function getDemoDocument(array $data): Document
    {
        $docData = [
            'header' => [
                'generatorInfo' => 'DocumentTest Document',
                'catalog' => [
                    'language' => 'eng',
                    'id' => 'MY_CATALOG',
                    'version' => '0.99',
                    'datetime' => [
                        'date' => '1979-01-01',
                        'time' => '10:59:54',
                        'timezone' => '-01:00',
                    ],
                ],
                'supplierIdRef' => [
                    'value' => 'BMECAT_TEST',
                ],
            ],
        ];

        $data = array_merge_recursive($docData, $data);

        $document = NodeBuilder::fromArray($data, \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Document::class));

        $catalog = \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], NewCatalog::class);
        $document->setNewCatalog($catalog);

        return $document;
    }

    public function testWithCompleteAddress(): void
    {
        $addressData = [
            'name' => 'name',
            'name2' => 'name2',
            'name3' => 'name3',
            'department' => 'department',
            'street' => 'street',
            'zip' => 'zip',
            'boxno' => 'boxno',
            'zipbox' => 'zipbox',
            'city' => 'city',
            'state' => 'state',
            'country' => 'country',
            'countryCoded' => 'DE',
            'vatId' => 'vatId',
            'phone' => [
                'type' => 'mobile',
                'value' => 'phone',
            ],
            'fax' => [
                'type' => 'office',
                'value' => 'fax',
            ],
            'email' => 'email',
            'publicKey' => [
                'type' => 'my-0.0.1',
                'value' => 'publicKey',
            ],
            'url' => 'url',
            'addressRemarks' => 'addressRemarks',
        ];

        $data = [
            'header' => [
                'parties' => [
                    [
                        'id' => 'party-id',
                        'address' => $addressData,
                    ],
                ],
            ],
        ];

        $document = $this->getDemoDocument($data);
        $this->assertInstanceOf(Document::class, $document);

        $builder = new DocumentBuilder();
        $builder->setDocument($document);

        $xml = $builder->toString();
        $this->assertEquals(file_get_contents(__DIR__ . '/../Fixtures/address_with_all_properties.xml'), $xml);

        $this->assertTrue(SchemaValidator::isValid($xml));

        $doc = $builder->fromString($xml);
        $this->assertInstanceOf(Document::class, $doc);
    }
}
