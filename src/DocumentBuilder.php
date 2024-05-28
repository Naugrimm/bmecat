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

class DocumentBuilder
{
    
    protected ?\JMS\Serializer\Serializer $serializer;

    /**
     *
     * @var SerializationContext
     */
    protected $context;

    /**
     *
     * @var Document
     */
    protected $document;

    /**
     *
     * @param Serializer $serializer
     * @param SerializationContext $context
     */
    public function __construct(Serializer $serializer = null, $context = null)
    {
        if (!$serializer instanceof \JMS\Serializer\Serializer) {
            $serializer = SerializerBuilder::create()
                ->setExpressionEvaluator(new ExpressionEvaluator($this->getExpressionLanguage()))
                ->build();
        }

        if ($context === null) {
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
        $expressionLanguage->register('empty', static fn($str) => $str, static fn($arguments, $str): bool => empty($str));

        $expressionLanguage->register('methodResultIsset', static fn($object, $method) => $method, static fn($arguments, $object, $method): bool => is_object($object) && method_exists($object, $method) && $object->$method() !== null);

        return $expressionLanguage;
    }

    /**
     *
     * @param Serializer $serializer
     * @return DocumentBuilder
     */
    public static function create(Serializer $serializer = null): self
    {
        return new self($serializer);
    }

    /**
     *
     * @return Serializer
     */
    public function getSerializer(): ?\JMS\Serializer\Serializer
    {
        return $this->serializer;
    }

    /**
     *
     * @return SerializationContext
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * @param NodeInterface $document
     * @return DocumentBuilder
     */
    public function setDocument(NodeInterface $document): static
    {
        $this->document = $document;
        return $this;
    }

    /**
     *
     * @return Document
     */
    public function getDocument()
    {
        return $this->document;
    }

    /**
     *
     * @throws MissingDocumentException
     * @return string
     */
    public function toString(): string
    {
        if (($document = $this->getDocument()) === null) {
            throw new MissingDocumentException('Please call ::setDocument() first.');
        }

        return $this->serializer->serialize($document, 'xml', $this->context);
    }

    public function fromString(string $xml) : Document {
        return $this->serializer->deserialize($xml, Document::class, 'xml');
    }
}
