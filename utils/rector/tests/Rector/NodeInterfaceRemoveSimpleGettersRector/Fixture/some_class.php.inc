<?php

namespace Utils\Rector\Tests\Rector\NodeInterfaceRemoveSimpleGettersRector\Fixture;

use JMS\Serializer\Annotation\Type;
use Naugrim\BMEcat\Nodes\Concerns\HasSerializableAttributes;
use Naugrim\BMEcat\Nodes\Contracts\NodeInterface;

class Account implements NodeInterface
{
    use HasSerializableAttributes;

    #[Type('string')]
    protected $holder;

    #[Type('string')]
    protected $complex;

    public function getHolder(): string
    {
        return $this->holder;
    }

    public function getComplex(): string
    {
        return strtoupper($this->complex);
    }
}

?>
-----
<?php

namespace Utils\Rector\Tests\Rector\NodeInterfaceRemoveSimpleGettersRector\Fixture;

use JMS\Serializer\Annotation\Type;
use Naugrim\BMEcat\Nodes\Concerns\HasSerializableAttributes;
use Naugrim\BMEcat\Nodes\Contracts\NodeInterface;

class Account implements NodeInterface
{
    use HasSerializableAttributes;

    #[Type('string')]
    protected $holder;

    #[Type('string')]
    protected $complex;

    public function getComplex(): string
    {
        return strtoupper($this->complex);
    }
}

?>
