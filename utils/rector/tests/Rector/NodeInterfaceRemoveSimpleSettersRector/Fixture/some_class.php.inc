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

    public function setHolder(string $holder): self
    {
        $this->holder = $holder;
        return $this;
    }

    public function setComplex(string $complex): self
    {
        $this->complex = strtoupper($complex);
        return $this;
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

    public function setComplex(string $complex): self
    {
        $this->complex = strtoupper($complex);
        return $this;
    }
}

?>
