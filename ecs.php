<?php

declare(strict_types=1);

use PhpCsFixer\Fixer\Import\GlobalNamespaceImportFixer;
use PhpCsFixer\Fixer\Operator\ConcatSpaceFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocToCommentFixer;
use PhpCsFixer\Fixer\Strict\DeclareStrictTypesFixer;
use PhpCsFixer\Fixer\Strict\StrictComparisonFixer;
use PhpCsFixer\Fixer\Strict\StrictParamFixer;
use Symplify\EasyCodingStandard\Config\ECSConfig;

return ECSConfig::configure()
    ->withPaths([
        __DIR__.'/config',
        __DIR__.'/public',
        __DIR__.'/src',
        __DIR__.'/tests',
        __DIR__.'/tools',
    ])
    ->withRootFiles()
    ->withPhpCsFixerSets(symfony: true, symfonyRisky: true)
    ->withPreparedSets(
        arrays: true,
        comments: true,
        docblocks: true,
        namespaces: true,
        spaces: true,
        controlStructures: true,
        casing: true,
    )
    ->withRules([
        // `declare(strict_types=1)` partout. Sans lui, une chaîne « 12abc » passe pour un `int` à une
        // frontière d'objet valeur, ce qui est exactement l'endroit où la validation devait mordre.
        DeclareStrictTypesFixer::class,

        // ECS n'a pas d'ensemble préparé « strict » ; ces deux règles sont ce qu'il aurait contenu, et
        // elles comptent ici pour la même raison que `strict_types` : `0 == 'abc'` et `in_array($id, $ids)`
        // sans le troisième argument sont deux façons dont une comparaison laxiste répond « oui » à une
        // question d'identité.
        StrictComparisonFixer::class,
        StrictParamFixer::class,
    ])
    ->withConfiguredRule(ConcatSpaceFixer::class, [
        'spacing' => 'none',
    ])
    ->withConfiguredRule(GlobalNamespaceImportFixer::class, [
        'import_classes' => true,
        'import_constants' => false,
        'import_functions' => false,
    ])
    ->withSkip([
        // Un bloc de documentation qui explique *pourquoi* n'est pas un commentaire à rétrograder.
        PhpdocToCommentFixer::class,

        // Régénéré à chaque réchauffement du cache : le corriger, c'est corriger la même chose demain.
        __DIR__.'/config/reference.php',
    ])
    ->withParallel();
