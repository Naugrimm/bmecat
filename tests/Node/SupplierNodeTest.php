<?php

namespace Naugrim\BMEcat\Tests\Node;

use Naugrim\BMEcat\Nodes\SupplierIdRef;
use PHPUnit\Framework\TestCase;

class SupplierNodeTest extends TestCase
{
    public function testSetGetValue(): void
    {
        $node = \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], SupplierIdRef::class);
        $value = sha1(uniqid(microtime(false), true));

        $this->assertEquals('', $node->getValue());
        $node->setValue($value);
        $this->assertEquals($value, $node->getValue());
    }
}
