<?php

namespace Utils\Rector\Tests\Rector\NodeInterfaceConstructorCallToNodeBuilderFromArrayRector\Fixture;

$catalog = new \Naugrim\BMEcat\Nodes\NewCatalog();

?>
-----
<?php

namespace Utils\Rector\Tests\Rector\NodeInterfaceConstructorCallToNodeBuilderFromArrayRector\Fixture;

$catalog = \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], \Naugrim\BMEcat\Nodes\NewCatalog::class);

?>
