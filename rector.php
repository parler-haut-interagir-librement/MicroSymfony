<?php

/** @noinspection DevelopmentDependenciesUsageInspection */

declare(strict_types=1);

use Rector\CodeQuality\Rector\Class_\InlineConstructorDefaultToPropertyRector;
use Rector\CodingStyle\Rector\Encapsed\EncapsedStringsToSprintfRector;
use Rector\Config\RectorConfig;
use Rector\DeadCode\Rector\ClassConst\RemoveUnusedPrivateClassConstantRector;
use Rector\DeadCode\Rector\ClassMethod\RemoveUnusedPrivateMethodRector;
use Rector\DeadCode\Rector\ClassMethod\RemoveUnusedPromotedPropertyRector;
use Rector\EarlyReturn\Rector\If_\ChangeAndIfToEarlyReturnRector;
use Rector\Naming\Rector\Assign\RenameVariableToMatchMethodCallReturnTypeRector;
use Rector\Naming\Rector\ClassMethod\RenameParamToMatchTypeRector;
use Rector\Set\ValueObject\LevelSetList;
use Rector\Set\ValueObject\SetList;
use Rector\Symfony\Set\SymfonyLevelSetList;
use Rector\Symfony\Set\SymfonySetList;
use Rector\Transform\Rector\Attribute\AttributeKeyToClassConstFetchRector;
use Rector\Transform\Rector\MethodCall\ReplaceParentCallByPropertyCallRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->paths([
                             __DIR__.'/src',
                             __DIR__.'/tests',
                         ]);

    $rectorConfig->importNames();

    $rectorConfig->symfonyContainerXml(__DIR__.'/var/cache/dev/App_KernelDevDebugContainer.xml');
    // register a single rule
    $rectorConfig->rule(InlineConstructorDefaultToPropertyRector::class);

    // define sets of rules
    $rectorConfig->sets([
                            LevelSetList::UP_TO_PHP_82,
                            SetList::CODE_QUALITY,
                            SetList::CODING_STYLE,
                            SetList::DEAD_CODE,
                            SetList::EARLY_RETURN,
                            SetList::NAMING,
                            SetList::PRIVATIZATION,
                            SetList::TYPE_DECLARATION,
                            // Don't update to SymfonyLevelSetList::UP_TO_SYMFONY_63, There's an error in it
                            SymfonyLevelSetList::UP_TO_SYMFONY_62,
                            SymfonySetList::ANNOTATIONS_TO_ATTRIBUTES,
                            SymfonySetList::SYMFONY_63,
                            SymfonySetList::SYMFONY_CODE_QUALITY,
                            SymfonySetList::SYMFONY_CONSTRUCTOR_INJECTION,
                        ]);

    $rectorConfig->skip([
                            AttributeKeyToClassConstFetchRector::class,
                            ChangeAndIfToEarlyReturnRector::class => [
                                'src/Controller/AppController.php',
                            ],
                            EncapsedStringsToSprintfRector::class,
                            RemoveUnusedPrivateClassConstantRector::class,
                            RemoveUnusedPrivateMethodRector::class,
                            RemoveUnusedPromotedPropertyRector::class,
                            RenameParamToMatchTypeRector::class,
                            RenameVariableToMatchMethodCallReturnTypeRector::class,
                            ReplaceParentCallByPropertyCallRector::class,
                        ]);
};
