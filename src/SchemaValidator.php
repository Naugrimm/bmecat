<?php

namespace Naugrim\BMEcat;

use DOMDocument;
use Naugrim\BMEcat\Exception\SchemaValidationException;
use Naugrim\BMEcat\Exception\UnsupportedVersionException;

class SchemaValidator
{
    /**
     * @var array<string, string|array<string, string>>
     */
    protected static array $SCHEMA_MAP = [
        '1.2' => [
            'new_catalog' => __DIR__ . '/Assets/bmecat_new_catalog_1_2.xsd',
            'update_products' => __DIR__ . '/Assets/bmecat_update_products_1_2.xsd',
            'update_prices' => __DIR__ . '/Assets/bmecat_update_prices_1_2.xsd',
        ],
        '2005.1' => __DIR__ . '/Assets/bmecat_2005_1.xsd',
        '2005.2' => __DIR__ . '/Assets/bmecat_2005_2.xsd',
    ];

    /**
     * Validates the given XML-string against the BMEcat XSD-files.
     *
     * @throws SchemaValidationException
     * @throws UnsupportedVersionException
     */
    public static function isValid(string $xml, string $version = '2005.1', ?string $type = null): bool
    {
        libxml_use_internal_errors(true);

        $xmlValidate = new DOMDocument();
        $xmlValidate->loadXML($xml);

        $schemaFile = self::getSchemaForVersion($version, $type);
        $validated = $xmlValidate->schemaValidate($schemaFile);
        if (! $validated) {
            throw SchemaValidationException::withErrors($xml, $schemaFile, libxml_get_errors());
        }

        libxml_use_internal_errors(false);
        libxml_clear_errors();
        return $validated;
    }

    /**
     * @throws UnsupportedVersionException
     */
    protected static function getSchemaForVersion(string $version, ?string $type = null): string
    {
        $schema = self::$SCHEMA_MAP[$version] ?? null;

        if (is_array($schema)) {
            $schema = $schema[$type] ?? null;
        }

        if ($schema !== null) {
            return $schema;
        }

        throw new UnsupportedVersionException('Please provide an XSD schema for this version/type.');
    }
}
