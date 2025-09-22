<?php

/** @noinspection DevelopmentDependenciesUsageInspection */

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Php81\Rector\FuncCall\NullToStrictStringFuncCallArgRector;
use Rector\Set\ValueObject\SetList;
use Utils\Rector\Rector\AddDocBlockWithMethodHintsToNodeInterfaceClassesRector;
use Utils\Rector\Rector\NodeInterfaceAddGenericImplementsAttributeRector;
use Utils\Rector\Rector\NodeInterfaceAddHasSerializableAttributesTraitRector;
use Utils\Rector\Rector\NodeInterfaceConstructorCallToNodeBuilderFromArrayRector;
use Utils\Rector\Rector\NodeInterfaceDocBlocKTypeHintsToTypedPropertyRector;
use Utils\Rector\Rector\NodeInterfaceRemoveSimpleGettersRector;
use Utils\Rector\Rector\NodeInterfaceRemoveSimpleSettersRector;

return RectorConfig::configure()
    ->withPaths([
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ])
    // uncomment to reach your current PHP version
    ->withSets([
        SetList::TYPE_DECLARATION,
        SetList::CODE_QUALITY,
        SetList::CODING_STYLE,
    ])
    ->withPhpSets()
    ->withRules([
        NodeInterfaceDocBlocKTypeHintsToTypedPropertyRector::class,
        NodeInterfaceConstructorCallToNodeBuilderFromArrayRector::class,
        NodeInterfaceAddHasSerializableAttributesTraitRector::class,
        NodeInterfaceRemoveSimpleGettersRector::class,
        NodeInterfaceRemoveSimpleSettersRector::class,
        NodeInterfaceAddGenericImplementsAttributeRector::class,
        AddDocBlockWithMethodHintsToNodeInterfaceClassesRector::class,
    ])
    ->withSkip([
        NullToStrictStringFuncCallArgRector::class,
    ])
    ;
