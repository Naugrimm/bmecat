<?php


namespace Naugrim\BMEcat;

use JMS\Serializer\Expression\ExpressionEvaluator;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializationContext;
use Naugrim\BMEcat\Nodes\Contracts\NodeInterface;
use Naugrim\BMEcat\Nodes\Document;
use Naugrim\BMEcat\Exception\MissingDocumentException;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;

final class DocumentBuilder
{

    protected readonly Serializer $serializer;

    protected readonly SerializationContext $context;

    /**
     * @var NodeInterface<Document>
     */
    protected NodeInterface $document;

    public function __construct(?Serializer $serializer = null, ?SerializationContext $context = null)
    {
        if (!$serializer instanceof Serializer) {
            $serializer = SerializerBuilder::create()
                ->setExpressionEvaluator(new ExpressionEvaluator($this->getExpressionLanguage()))
                ->build();
        }

        if (!$context instanceof SerializationContext) {
            $context = SerializationContext::create();
        }

        $this->context    = $context;
        $this->serializer = $serializer;
    }

    /**
     * @return ExpressionLanguage
     */
    private function getExpressionLanguage() : ExpressionLanguage
    {
        $expressionLanguage = new ExpressionLanguage();
        $expressionLanguage->register('empty', static fn(mixed $str): mixed => $str, static function (mixed $arguments, mixed $str): bool {
            return empty($str); //@phpstan-ignore empty.notAllowed
        });

        $expressionLanguage->register('methodResultIsset', static fn(mixed $object, string $method) => $method, static function (mixed $arguments, mixed $object, string $method): bool {
            if (! is_object($object) || ! method_exists($object, $method)) {
                return false;
            }
            $result = $object->$method(); // @phpstan-ignore method.dynamicName
            if ($result === null) {
                return false;
            }

            if (is_scalar($result)) {
                return true;
            }

            if (is_countable($result) && count($result) > 0) {
                return true;
            }

            return false;
        });

        return $expressionLanguage;
    }

    public static function create(?Serializer $serializer = null): self
    {
        return new self($serializer);
    }

    public function getSerializer(): Serializer
    {
        return $this->serializer;
    }

    public function getContext(): SerializationContext
    {
        return $this->context;
    }

    /**
     * @param NodeInterface<Document> $document
     * @return DocumentBuilder
     */
    public function setDocument(NodeInterface $document): self
    {
        $this->document = $document;
        return $this;
    }

    /**
     *
     * @return ?NodeInterface<Document>
     */
    public function getDocument() : ?NodeInterface
    {
        return $this->document ?? null;
    }

    /**
     *
     * @throws MissingDocumentException
     * @return string
     */
    public function toString(): string
    {
        if (!($document = $this->getDocument()) instanceof NodeInterface) {
            throw new MissingDocumentException('Please call ::setDocument() first.');
        }

        return $this->serializer->serialize($document, 'xml', $this->context);
    }

    public function fromString(string $xml) : Document {
        return $this->serializer->deserialize($xml, Document::class, 'xml');
    }
}
