<?php


namespace Naugrim\BMEcat\Tests\Node;

use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerInterface;
use Naugrim\BMEcat\DocumentBuilder;
use Naugrim\BMEcat\Nodes\SupplierIdRef;
use PHPUnit\Framework\TestCase;


class SupplierNodeTest extends TestCase
{
    /**
     * @var SerializerInterface
     */
    private Serializer $serializer;

    protected function setUp() : void
    {
        $this->serializer = (new DocumentBuilder())->getSerializer();
    }

    /**
     *
     * @test
     */
    public function Set_Get_Value(): void
    {
        $node = new SupplierIdRef();
        $value = sha1(uniqid(microtime(false), true));

        $this->assertEquals('', $node->getValue());
        $node->setValue($value);
        $this->assertEquals($value, $node->getValue());
    }
}
