<?php

declare(strict_types=1);

use PHP_CodeSniffer\Standards\Generic\Sniffs\CodeAnalysis\AssignmentInConditionSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\Formatting\SpaceAfterNotSniff;
use PhpCsFixer\Fixer\ClassNotation\ClassAttributesSeparationFixer;
use PhpCsFixer\Fixer\ClassNotation\OrderedClassElementsFixer;
use PhpCsFixer\Fixer\Operator\NewWithBracesFixer;
use PhpCsFixer\Fixer\Phpdoc\GeneralPhpdocAnnotationRemoveFixer;
use Symplify\EasyCodingStandard\Config\ECSConfig;
use Symplify\EasyCodingStandard\ValueObject\Set\SetList;

return static function (ECSConfig $ecsConfig): void {
    $ecsConfig->parallel(120, 10);
    $ecsConfig->sets([SetList::PSR_12, SetList::CLEAN_CODE, SetList::COMMON, SetList::SYMPLIFY]);

    $ecsConfig->paths([__DIR__ . '/src', __DIR__ . '/tests']);

    $ecsConfig->rule(SpaceAfterNotSniff::class);
    $ecsConfig->ruleWithConfiguration(NewWithBracesFixer::class, [
        'anonymous_class' => false,
    ]);

    $ecsConfig->skip([
        AssignmentInConditionSniff::class,
        ClassAttributesSeparationFixer::class,
        OrderedClassElementsFixer::class,
        GeneralPhpdocAnnotationRemoveFixer::class,
    ]);
};
