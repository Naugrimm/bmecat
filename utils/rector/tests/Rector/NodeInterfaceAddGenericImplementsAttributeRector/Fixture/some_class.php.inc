<?php

namespace Utils\Rector\Tests\Rector\NodeInterfaceAddHasSerializableAttributesTraitRector\Fixture;

class Node implements \Naugrim\BMEcat\Nodes\Contracts\NodeInterface
{
}

?>
-----
<?php

namespace Utils\Rector\Tests\Rector\NodeInterfaceAddHasSerializableAttributesTraitRector\Fixture;

/**
 * @implements \Naugrim\BMEcat\Nodes\Contracts\NodeInterface<Node>
 */
class Node implements \Naugrim\BMEcat\Nodes\Contracts\NodeInterface
{
}

?>
