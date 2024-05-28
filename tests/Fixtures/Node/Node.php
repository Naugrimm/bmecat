<?php

namespace Naugrim\BMEcat\Tests\Fixtures\Node;

use Naugrim\BMEcat\Nodes\Contracts\NodeInterface;

class Node implements NodeInterface
{
    public $someString;

    public $someArray;

    public $anotherNode;

    public $someFloat;

    public function setNoArguments(): static
    {
        return $this;
    }

    public function setNoTypeHint($something): static
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

    public function setMatchingTypeHintArray(array $someArray): static
    {
        $this->someArray = $someArray;
        return $this;
    }

    public function setMatchingTypeHintNode(Node $anotherNode): static
    {
        $this->anotherNode = $anotherNode;
        return $this;
    }
}
