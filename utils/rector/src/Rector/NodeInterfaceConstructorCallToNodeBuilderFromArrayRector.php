<?php

declare(strict_types=1);

namespace Utils\Rector\Rector;

use Naugrim\BMEcat\Builder\NodeBuilder;
use Naugrim\BMEcat\Nodes\Contracts\NodeInterface;
use PhpParser\Node;
use PhpParser\Node\Expr\New_;
use Rector\Rector\AbstractRector;
use ReflectionClass;
use ReflectionException;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * @see \Utils\Rector\Tests\Rector\NodeInterfaceConstructorCallToNodeBuilderFromArrayRector\NodeInterfaceConstructorCallToNodeBuilderFromArrayRectorTest
 */
final class NodeInterfaceConstructorCallToNodeBuilderFromArrayRector extends AbstractRector
{
    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition('// @todo fill the description', [
            new CodeSample(
                <<<'CODE_SAMPLE'
$catalog = new \Naugrim\BMEcat\Nodes\NewCatalog();
CODE_SAMPLE
                ,
                <<<'CODE_SAMPLE'
$catalog = \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], \Naugrim\BMEcat\Nodes\NewCatalog::class);
CODE_SAMPLE
            ),
        ]);
    }

    /**
     * @return array<class-string<Node>>
     */
    public function getNodeTypes(): array
    {
        return [New_::class];
    }

    /**
     * @param New_ $node
     * @throws ReflectionException
     */
    public function refactor(Node $node): ?Node
    {
        $className = $this->getName($node->class);

        if (! class_exists($className)) {
            return $node;
        }

        $reflectionClass = new ReflectionClass($className);
        if (! $reflectionClass->implementsInterface(NodeInterface::class)) {
            return $node;
        }

        $newNode = new Node\Expr\StaticCall(
            new Node\Name\FullyQualified(NodeBuilder::class),
            new Node\Identifier('fromArray'),
            [
                new Node\Arg(value: new Node\Expr\Array_(attributes: [
                    'kind' => Node\Expr\Array_::KIND_SHORT,
                ])),
                new Node\Arg(value: new Node\Expr\ClassConstFetch($node->class, 'class')),
            ]
        );

        return $newNode;
    }
}
