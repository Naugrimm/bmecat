<?php

namespace Naugrim\BMEcat\Tests;

use Naugrim\BMEcat\Exception\SchemaValidationException;
use Naugrim\BMEcat\Exception\UnsupportedVersionException;
use Naugrim\BMEcat\SchemaValidator;
use PHPUnit\Framework\TestCase;

class SchemaValidatorTest extends TestCase
{
    protected string $minimalValidDocument;

    protected string $minimalValidDocument20052;

    #[\Override]
    protected function setUp(): void
    {
        parent::setUp();

        $this->minimalValidDocument = (string) file_get_contents(
            __DIR__ . '/Fixtures/2005.1/minimal_valid_document.xml'
        );

        $this->minimalValidDocument20052 = (string) file_get_contents(
            __DIR__ . '/Fixtures/2005.2/minimal_valid_document.xml'
        );
    }

    public function testInvalidVersion(): void
    {
        $this->expectException(UnsupportedVersionException::class);
        SchemaValidator::isValid('<xml/>', 'invalid');
    }

    public function testInvalidType(): void
    {
        $this->expectException(UnsupportedVersionException::class);
        SchemaValidator::isValid('<xml/>', '1.2', 'invalid');
    }

    public function testInvalidXml20051(): void
    {
        $this->expectException(SchemaValidationException::class);
        SchemaValidator::isValid('<xml/>', '2005.1');
    }

    public function testInvalidXml20052(): void
    {
        $this->expectException(SchemaValidationException::class);
        SchemaValidator::isValid('<xml/>', '2005.2');
    }

    public function testVersionThatHasNoType20051(): void
    {
        $this->assertTrue(SchemaValidator::isValid($this->minimalValidDocument, '2005.1', 'invalid'));
    }

    public function testVersionThatHasNoType20052(): void
    {
        $this->assertTrue(SchemaValidator::isValid($this->minimalValidDocument20052, '2005.2', 'invalid'));
    }
}
