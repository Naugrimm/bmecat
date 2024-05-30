<?php

declare(strict_types=1);

namespace Utils\Rector\Rector;

use Naugrim\BMEcat\Nodes\Concerns\HasSerializableAttributes;
use Naugrim\BMEcat\Nodes\Contracts\NodeInterface;
use PhpParser\Node;
use PhpParser\Node\Name;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\TraitUse;
use Rector\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * @see \Utils\Rector\Tests\Rector\NodeInterfaceAddHasSerializableAttributesTraitRector\NodeInterfaceAddHasSerializableAttributesTraitRectorTest
 */
final class NodeInterfaceAddHasSerializableAttributesTraitRector extends AbstractRector
{
    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition('adds the '.HasSerializableAttributes::class.' trait to all classes implementing '.NodeInterface::class, [
            new CodeSample(
                <<<'CODE_SAMPLE'
use Naugrim\BMEcat\Nodes\Contracts\NodeInterface;

class Node implements NodeInterface
{
}
CODE_SAMPLE
                ,
                <<<'CODE_SAMPLE'
use Naugrim\BMEcat\Nodes\Contracts\NodeInterface;

class Node implements NodeInterface
{
    use \Naugrim\BMEcat\Nodes\Concerns\HasSerializableAttributes;
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
        if (!in_array(NodeInterface::class, $node->implements)) {
            return null;
        }

        foreach ($node->getTraitUses() as $traitUse) {
            if ($traitUse->traits[0]->toString() === HasSerializableAttributes::class) {
                return $node;
            }
        }

        array_unshift($node->stmts, new TraitUse([new Name\FullyQualified(HasSerializableAttributes::class)]));

        return $node;
    }
}
