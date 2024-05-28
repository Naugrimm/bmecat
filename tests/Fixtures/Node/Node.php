<?php

namespace Naugrim\BMEcat\Tests\Fixtures\Node;

use Naugrim\BMEcat\Nodes\Contracts\NodeInterface;

/**
 * @implements NodeInterface<self>
 */
class Node implements NodeInterface
{
    public string $someString;

    /**
     * @var string[]
     */
    public array $someArray;

    public Node $anotherNode;

    public float $someFloat;

    public function setNoArguments(): static
    {
        return $this;
    }

    public function setNoTypeHint($something): static //@phpstan-ignore missingType.parameter
    {
        return $this;
    }

    public function setScalarTypeHint(string $someString): static
    {
        $this->someString = $someString;
        return $this;
    }

    public function setMatchingTypeHintFloat(float $someFloat): static
    {
        $this->someFloat = $someFloat;
        return $this;
    }

    /**
     * @param string[] $someArray
     */
    public function setMatchingTypeHintArray(array $someArray): static
    {
        $this->someArray = $someArray;
        return $this;
    }

    public function setMatchingTypeHintNode(self $anotherNode): static
    {
        $this->anotherNode = $anotherNode;
        return $this;
    }
}
