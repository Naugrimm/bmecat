<?php

declare(strict_types=1);

namespace Utils\Rector\Rector;

use Naugrim\BMEcat\Nodes\Concerns\HasSerializableAttributes;
use Naugrim\BMEcat\Nodes\Contracts\NodeInterface;
use PhpParser\Comment\Doc;
use PhpParser\Node;
use PhpParser\Node\Stmt\Class_;
use Rector\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * @see \Utils\Rector\Tests\Rector\NodeInterfaceAddHasSerializableAttributesTraitRector\NodeInterfaceAddHasSerializableAttributesTraitRectorTest
 */
final class NodeInterfaceAddGenericImplementsAttributeRector extends AbstractRector
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

/**
 * @implements NodeInterface<Node>
 */
class Node implements NodeInterface
{
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
            return $node;
        }

        $docComment = $node->getDocComment();
        if ($docComment === null) {
            $implements = "@implements \\".NodeInterface::class.'<'.$node->name.'>';
            $docComment = new Doc(<<<EOF
/**
 * $implements
 */
EOF
);
        }
        $node->setDocComment($docComment);

        return $node;
    }
}
