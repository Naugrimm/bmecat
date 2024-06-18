<?php

declare(strict_types=1);

namespace Utils\Rector\Rector;

use Exception;
use Naugrim\BMEcat\Nodes\Concerns\HasSerializableAttributes;
use Naugrim\BMEcat\Nodes\Contact\Details;
use Naugrim\BMEcat\Nodes\Contracts\NodeInterface;
use Naugrim\BMEcat\Nodes\Crypto\PublicKey;
use PhpParser\Comment\Doc;
use PhpParser\Node;
use PhpParser\Node\Stmt\Class_;
use Rector\PhpParser\AstResolver;
use Rector\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * @see \Utils\Rector\Tests\Rector\AddDocBlockWithMethodHintsToNodeInterfaceClassesRector\AddDocBlockWithMethodHintsToNodeInterfaceClassesRectorTest
 */
final class AddDocBlockWithMethodHintsToNodeInterfaceClassesRector extends AbstractRector
{
    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition('// @todo fill the description', [
            new CodeSample(
                <<<'CODE_SAMPLE'
class Address implements NodeInterface
{
    use HasSerializableAttributes;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('NAME')]
    protected ?string $name = null;

    /**
     * @var Details[]
     */
    #[Serializer\Expose]
    #[Serializer\Type('array<' . Details::class . '>')]
    #[Serializer\XmlList(entry: 'CONTACT_DETAILS', inline: true)]
    protected array $contactDetails;

    #[Serializer\Expose]
    #[Serializer\Type(PublicKey::class)]
    #[Serializer\SerializedName('PUBLIC_KEY')]
    protected ?PublicKey $publicKey = null;
}
CODE_SAMPLE
                ,
                <<<'CODE_SAMPLE'
/**
 * @method self setName(string|null $name)
 * @method string|null getName()
 * @method self setContactDetails(\Naugrim\BMEcat\Nodes\Contact\Details[]|array $contactDetails)
 * @method \Naugrim\BMEcat\Nodes\Contact\Details[]|array getContactDetails()
 * @method self setPublicKey(null|array|\Naugrim\BMEcat\Nodes\Crypto\PublicKey $publicKey)
 * @method \Naugrim\BMEcat\Nodes\Crypto\PublicKey|null getPublicKey()
 */
class Address implements NodeInterface
{
    use HasSerializableAttributes;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('NAME')]
    protected ?string $name = null;

    /**
     * @var Details[]
     */
    #[Serializer\Expose]
    #[Serializer\Type('array<' . Details::class . '>')]
    #[Serializer\XmlList(entry: 'CONTACT_DETAILS', inline: true)]
    protected array $contactDetails;

    #[Serializer\Expose]
    #[Serializer\Type(PublicKey::class)]
    #[Serializer\SerializedName('PUBLIC_KEY')]
    protected ?PublicKey $publicKey = null;
}
CODE_SAMPLE
            ),
        ]);
    }

    public function __construct(private AstResolver $astResolver)
    {
    }

    /**
     * @return array<class-string<Node>>
     */
    public function getNodeTypes(): array
    {
        return [Class_::class];
    }

    /**
     * @param Class_ $node
     * @throws Exception
     */
    public function refactor(Node $node): ?Node
    {
        if (!in_array(NodeInterface::class, $node->implements)) {
            return $node;
        }

        $existingLines = $this->getDocCommentLinesWithoutHeaderAndTrailer($node);


        foreach ($node->getTraitUses() as $traitUse) {
            if ($traitUse->traits[0]->toString() === HasSerializableAttributes::class) {
                continue;
            }

            $trait = $this->astResolver->resolveClassFromName($traitUse->traits[0]->toString());

            foreach ($trait->getProperties() as $property) {
                $this->handleProperty($node, $property, $existingLines);
            }
        }

        foreach ($node->getProperties() as $property) {
            $this->handleProperty($node, $property, $existingLines);
        }

        $newDocComment = $this->createDocCommentFromExistingLines($existingLines);
        $node->setDocComment($newDocComment);

        return $node;
    }

    /**
     * @param Class_ $node
     * @return string[]
     */
    private function getDocCommentLinesWithoutHeaderAndTrailer(Class_ $node) : array
    {
        $docComment = $node->getDocComment();
        if ($docComment === null) {
            return [];
        }

        $docCommentLines = explode("\n", $docComment->getText());
        unset($docCommentLines[0]);
        array_pop($docCommentLines);

        $docCommentLines = array_map(function (string $line) {
            return ltrim($line, ' *');
        }, $docCommentLines);

        $docCommentLines = array_filter($docCommentLines, function (string $line) {
            return !(str_starts_with($line, '@method') || str_starts_with($line, '@method'));
        });

        return array_values($docCommentLines);
    }

    private function createDocCommentFromExistingLines(array $existingLines) : Doc
    {

        $array_length = count($existingLines);

        if ($array_length === 0) {
            return new Doc('/** */');
        }

        $docCommentLines = [];

        foreach ($existingLines as $line_number => $docLine) {
            $prefix = $line_number === 0 ? "/**\n * " : ' * ';
            $suffix = $line_number === $array_length - 1 ? "\n */" : '';
            $docCommentLines[] = $prefix . $docLine . $suffix;
        }

        return new Doc(implode(PHP_EOL, $docCommentLines));
    }

    private function handleProperty(Node $node, Node\Stmt\Property $property, array &$existingLines)
    {
        if ($property->type === null) {
            return;
        }

        if ($property->isPublic()) {
            return;
        }

        $propertyName = $property->props[0]->name->toString();
        $propertyType = null;
        $getterReturnType = null;

        if ($property->type instanceof Node\Identifier) {
            $propertyType = $getterReturnType = $this->getName($property->type);
            if ($propertyType === 'array') {
                foreach ($property->attrGroups as $attrGroup) {
                    foreach ($attrGroup->attrs as $attr) {
                        if ($attr->name->toCodeString() === "\\".\JMS\Serializer\Annotation\Type::class) {
                            $value = $attr->args[0]->value;
                            if ($value instanceof Node\Scalar\String_) {
                                if (preg_match('/^array<(?<inner>.*)>/', $value->value, $match) === 1) {
                                    if (str_contains($match['inner'], "\\")) {
                                        $propertyType = "\\".$match['inner']."|array";
                                    }
                                    $getterReturnType = $match['inner']."[]";
                                    break 2;
                                }
                            } elseif ($value instanceof Node\Expr\BinaryOp\Concat && $value->left->left->value === 'array<' && $value->left->right instanceof  Node\Expr\ClassConstFetch) {
                                $propertyType = "\\".$this->getName($value->left->right->class)."[]|array";
                                $getterReturnType = $propertyType;
                                break 2;
                            }
                        }
                    }
                }
            }
        } elseif ($property->type instanceof Node\NullableType) {
            $innerType = $property->type->type;
            if ($innerType instanceof Node\Name\FullyQualified) {
                $propertyType = "null|array|\\".$this->getName($innerType);
                $getterReturnType = "\\".$this->getName($innerType)."|null";
            } else {
                $propertyType = $getterReturnType = $this->getName($property->type->type)."|null";
            }
        } elseif ($property->type instanceof Node\Name\FullyQualified) {
            $propertyType = "array|\\" . $this->getName($property->type);
            $getterReturnType = "\\" . $this->getName($property->type);
        }

        if ($propertyType === null) {
            throw new \Exception("No propertyType for ".$propertyName." in class ".$this->getName($node));
        }

        $setterLine = sprintf('@method self set%s(%s $%s)', ucfirst($propertyName), $propertyType, $propertyName);
        $getterLine = sprintf('@method %s get%s()', $getterReturnType, ucfirst($propertyName));

        $existingLines[] = $setterLine;
        $existingLines[] = $getterLine;
    }
}
