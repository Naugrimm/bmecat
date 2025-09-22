<?php

namespace Naugrim\BMEcat\Exception;

use Exception;
use LibXMLError;

class SchemaValidationException extends Exception
{
    protected int $context = 3;

    protected string $xml;

    protected string $schemaFile;

    /**
     * @var LibXMLError[]
     */
    protected array $errors;

    /**
     * @param LibXMLError[] $errors
     */
    public static function withErrors(string $xml, string $schemaFile, array $errors = []): self
    {
        $instance = new self('The xml could not be validated against the given schema.');
        $instance->xml = $xml;
        $instance->schemaFile = $schemaFile;
        $instance->errors = $errors;
        return $instance;
    }

    /**
     * @codeCoverageIgnore
     */
    #[\Override]
    public function __toString(): string
    {
        $msg = static::class . ': ' . $this->getMessage() . "\n";
        $msg .= $this->getTraceAsString() . "\n\n";

        $lines = explode("\n", $this->xml);

        $xmlErrors = [];

        /** @var LibXMLError $error */
        foreach ($this->errors as $idx => $error) {
            $context = array_slice(
                $lines,
                max(0, $error->line - $this->context),
                min(count($lines) - $error->line, 2 * $this->context)
            );

            $xmlErrors[] = implode(
                "\n",
                ['Error #' . ($idx + 1) . ': ' . $error->message, implode("\n", $context) . "\n"]
            );
        }

        return $msg . implode("\n", $xmlErrors);
    }
}
