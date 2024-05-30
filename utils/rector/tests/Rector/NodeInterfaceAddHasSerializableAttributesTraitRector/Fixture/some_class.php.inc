<?php

namespace Utils\Rector\Tests\Rector\NodeInterfaceAddHasSerializableAttributesTraitRector\Fixture;

class Node implements \Naugrim\BMEcat\Nodes\Contracts\NodeInterface
{
}

?>
-----
<?php

namespace Utils\Rector\Tests\Rector\NodeInterfaceAddHasSerializableAttributesTraitRector\Fixture;

class Node implements \Naugrim\BMEcat\Nodes\Contracts\NodeInterface
{
    use \Naugrim\BMEcat\Nodes\Concerns\HasSerializableAttributes;
}

?>
