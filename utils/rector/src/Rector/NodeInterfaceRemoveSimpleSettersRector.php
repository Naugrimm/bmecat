<?php

declare(strict_types=1);

namespace Utils\Rector\Rector;

use JMS\Serializer\Annotation\Type;
use Naugrim\BMEcat\Nodes\Concerns\HasSerializableAttributes;
use Naugrim\BMEcat\Nodes\Contracts\NodeInterface;
use PhpParser\Node;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\TraitUse;
use PHPStan\Type\ThisType;
use Rector\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * @see \Utils\Rector\Tests\Rector\NodeInterfaceRemoveSimpleSettersRector\NodeInterfaceRemoveSimpleGettersRectorTest
 */
final class NodeInterfaceRemoveSimpleSettersRector extends AbstractRector
{
    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition(
            'remove simple setters for serializable properties when the HasSerializableAttributes trait is used',
            [
            new CodeSample(
                <<<'CODE_SAMPLE'
class Account implements NodeInterface
{
    use HasSerializableAttributes;
    
    #[Serializer\Type('string')]
    protected $holder;
    
    public function setHolder(string $holder): self
    {
        $this->holder = $holder;
        return $this;
    }
}
CODE_SAMPLE
                ,
                <<<'CODE_SAMPLE'
class Account implements NodeInterface
{
    use HasSerializableAttributes;
    
    #[Serializer\Type('string')]
    protected $holder;
}
CODE_SAMPLE
            ),

        ]);
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
     */
    public function refactor(Node $node): ?Node
    {
        if (! in_array(NodeInterface::class, $node->implements)) {
            return null;
        }

        $usesTrait = count(
            array_filter(
                $node->getTraitUses(),
                fn (TraitUse $traitUse) => $traitUse->traits[0]->toString() === HasSerializableAttributes::class
            )
        ) === 1;

        if (! $usesTrait) {
            return $node;
        }

        foreach ($node->getProperties() as $property) {
            if ($this->isSerializableAttribute($property)) {
                $setterName = 'set' . ucfirst($this->getName($property));
                $setterMethod = $node->getMethod($setterName);
                if ($setterMethod === null) {
                    continue;
                }

                /**
                 * when there are less or more than 2 statements, this cannot be a simple setter
                 */
                if (count($setterMethod->stmts) !== 2) {
                    continue;
                }

                $stmt = $setterMethod->stmts[0];

                /**
                 * the first statement must be a simple variable assignment.
                 */
                if (! $stmt instanceof Node\Stmt\Expression || ! $stmt->expr instanceof Node\Expr\Assign || ! $stmt->expr->expr instanceof Node\Expr\Variable) {
                    continue;
                }


                $stmt = $setterMethod->stmts[1];

                /**
                 * when the second statement is not a return statement, we need to keep the method
                 */
                if (! $stmt instanceof Node\Stmt\Return_) {
                    continue;
                }

                /**
                 * the setter does not return the node itself, we need to keep the method
                 */
                if (! $stmt->expr instanceof Node\Expr\Variable || $stmt->expr->name !== 'this') {
                    continue;
                }

                $setterMethodKey = array_search($setterMethod, $node->stmts, true);
                if ($setterMethodKey !== false) {
                    unset($node->stmts[$setterMethodKey]);
                }
            }
        }

        return $node;
    }

    private function isSerializableAttribute(Node\Stmt\Property $property): bool
    {
        foreach ($property->attrGroups as $attrGroup) {
            foreach ($attrGroup->attrs as $attr) {
                if ($attr->name->toCodeString() === '\\' . Type::class) {
                    return true;
                }
            }
        }

        return false;
    }
}
