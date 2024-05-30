<?php

declare(strict_types=1);

namespace Utils\Rector\Rector;

use JMS\Serializer\Annotation\Type;
use Naugrim\BMEcat\Nodes\Concerns\HasSerializableAttributes;
use Naugrim\BMEcat\Nodes\Contracts\NodeInterface;
use PhpParser\Node;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\TraitUse;
use Rector\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * @see \Utils\Rector\Tests\Rector\NodeInterfaceRemoveSimpleGettersRector\NodeInterfaceRemoveSimpleGettersRectorTest
 */
final class NodeInterfaceRemoveSimpleGettersRector extends AbstractRector
{
    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition(
            'remove simple getters for serializable properties when the HasSerializableAttributes trait is used',
            [
            new CodeSample(
                <<<'CODE_SAMPLE'
class Account implements NodeInterface
{
    use HasSerializableAttributes;
    
    #[Serializer\Type('string')]
    protected $holder;
    
    public function getHolder(): string
    {
        return $this->holder;
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
                $getterName = 'get' . ucfirst($this->getName($property));
                $getterMethod = $node->getMethod($getterName);
                if ($getterMethod === null) {
                    continue;
                }

                /**
                 * when there is more than 1 statement, this cannot be a simple getter
                 */
                if (count($getterMethod->stmts) > 1) {
                    continue;
                }
                $stmt = $getterMethod->stmts[0];

                /**
                 * when the one statement is not a return statement, we need to keep the method
                 */
                if (! $stmt instanceof Node\Stmt\Return_) {
                    continue;
                }

                /**
                 * the getter does not return a simple property, we need to keep the method
                 */
                if (! $stmt->expr instanceof Node\Expr\PropertyFetch) {
                    continue;
                }

                $getterMethodKey = array_search($getterMethod, $node->stmts, true);
                if ($getterMethodKey !== false) {
                    unset($node->stmts[$getterMethodKey]);
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
