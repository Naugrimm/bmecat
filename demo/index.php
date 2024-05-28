<?php

use Doctrine\Common\Annotations\AnnotationRegistry;
use JMS\Serializer\Expression\ExpressionEvaluator;
use JMS\Serializer\SerializerBuilder;
use Naugrim\BMEcat\Builder\NodeBuilder;
use Naugrim\BMEcat\DocumentBuilder;
use Naugrim\BMEcat\Exception\SchemaValidationException;
use Naugrim\BMEcat\Nodes\Document;
use Naugrim\BMEcat\SchemaValidator;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;

require __DIR__.'/../vendor/autoload.php';

$builder = new DocumentBuilder();

$document = NodeBuilder::fromArray([
    'header' => [
        'catalog' => [
            'language' => 'deu',
            'id' => 'MY_CATALOG',
            'version' => '00.01',
            'dateTime' => [
                'dateTime' => new DateTimeImmutable()
            ]
        ],
        'supplierIdRef' => [
            'type' => 'supplier_specific',
            'value' => 'org.org.naugrim',
        ],
        'parties' => [
            [
                'id' => 'org.org.naugrim'
            ]
        ]
    ],
    'newCatalog' => [
        'products' => [
            [
                'id' => [
                    'type' => 'supplier_specific',
                    'value' => 'Product-Number-1'
                ],
                'details' => [
                    'descriptionShort' => 'A short Description for Product-Number-1',
                ],
                'orderDetails' => [
                    'orderUnit' => 'C62',
                    'contentUnit' => 'C62',
                ],
                'priceDetails' => [
                    [
                        'prices' => [
                            [
                                'type' => 'net_list',
                                'price' => 123.45,
                                'priceFactor' => 0.8,
                            ]
                        ]
                    ]
                ]
            ],
            [
                'id' => [
                    'type' => 'supplier_specific',
                    'value' => 'Product-Number-2'
                ],
                'details' => [
                    'descriptionShort' => 'A short Description for Product-Number-2',
                ],
                'orderDetails' => [
                    'orderUnit' => 'C62',
                    'contentUnit' => 'C62',
                ],
                'priceDetails' => [
                    [
                        'prices' => [
                            [
                                'type' => 'net_list',
                                'price' => 1000,
                            ]
                        ]
                    ]
                ],
            ]
        ]
    ]
], new Document());

$builder->setDocument($document);

$xml = $builder->toString();

try {
    SchemaValidator::isValid($xml, '2005.1');
} catch (SchemaValidationException $exception) {
    echo $exception->__toString();
    die();
}


echo $xml;
