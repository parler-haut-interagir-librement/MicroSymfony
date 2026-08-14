<?php

declare(strict_types=1);

use ShipMonk\ComposerDependencyAnalyser\Config\Configuration;
use ShipMonk\ComposerDependencyAnalyser\Config\ErrorType;

/**
 * Ce que cet outil attrape, et ce que la Phase 0 lui demande de taire.
 *
 * Trois de ses six vérifications valent dès aujourd'hui :
 *
 * - `shadow-dependency` — une classe importée d'un paquet que `composer.json` n'exige pas. C'est la
 *   défaillance qui casse à l'installation chez quelqu'un d'autre, et jamais chez celui qui l'a écrite.
 * - `dev-dependency-in-prod` — du code de production qui importe un paquet de `require-dev`. Le déploiement
 *   installe avec `--no-dev` : ce cas-là est une panne en production, pas un avertissement.
 * - `prod-dependency-only-in-dev` — l'inverse, qui gonfle l'image sans raison.
 *
 * `unused-dependency` est taire délibérément, et c'est la seule concession. Le jeu de paquets du §7 est
 * choisi pour le service entier, pas pour la Phase 0 : `league/oauth2-server` n'a pas d'usager avant la
 * Phase 1b, `commerceguys/addressing` n'a pas d'adresse à valider avant la Phase 1a. Les déclarer maintenant
 * est ce qui a permis de vérifier qu'ils résolvent tous contre Symfony 8.1 **avant** que quoi que ce soit
 * soit bâti dessus — c'est-à-dire la vérification sur laquelle l'installation était barrée. Les retirer pour
 * faire taire l'outil reviendrait à jeter cette vérification.
 *
 * **La ligne se retire à la fin de la Phase 1b**, quand chaque paquet a un appelant. Si elle est encore là
 * après, c'est qu'un paquet du §7 n'a jamais servi et devrait sortir de `composer.json`.
 */
return new Configuration()
    ->addPathToScan(__DIR__.'/src', isDev: false)
    ->addPathToScan(__DIR__.'/config', isDev: false)
    ->addPathToScan(__DIR__.'/public', isDev: false)
    ->addPathToScan(__DIR__.'/tests', isDev: true)
    ->addPathToScan(__DIR__.'/tools', isDev: true)
    ->ignoreErrors([ErrorType::UNUSED_DEPENDENCY])

    // `config/bundles.php` déclare chaque bundle avec les environnements où il est actif. Les trois bundles
    // Zenstruck y portent `['test' => true]` et ne sont jamais instanciés en production ; l'outil lit le
    // fichier sans lire la carte d'environnements, et conclut que du code de production les importe.
    ->ignoreErrorsOnPath(__DIR__.'/config/bundles.php', [ErrorType::DEV_DEPENDENCY_IN_PROD])

    // `symfony/dotenv` n'apparaît que dans les amorces de test et d'outillage, mais c'est bien une
    // dépendance de production : `symfony/runtime` s'en sert pour charger `.env` au démarrage, sans qu'un
    // seul `use` apparaisse dans notre code. Le déplacer vers `require-dev`, ce que l'outil suggère, casse
    // le démarrage en production.
    ->ignoreErrorsOnPackage('symfony/dotenv', [ErrorType::PROD_DEPENDENCY_ONLY_IN_DEV])

    // Les trois suivants n'apparaissent aujourd'hui que dans les tests, et restent quand même en `require` :
    //
    // - `psr/clock` est câblé dans `config/services.yaml` comme alias de `@clock` pour tout l'applicatif.
    //   L'outil lit du PHP, pas du YAML, donc il ne voit pas le seul endroit qui compte.
    // - `ext-mbstring` est *remplacé* plus bas dans `composer.json` : on affirme que l'extension réelle est
    //   présente, donc son polyfill n'a pas à être installé. Déplacer l'extension vers `require-dev`, ce que
    //   l'outil suggère, ferait tenir cette affirmation sur rien en production.
    // - `ext-filter` est la même affirmation pour `filter_var`, que Symfony appelle sans le déclarer.
    ->ignoreErrorsOnPackage('psr/clock', [ErrorType::PROD_DEPENDENCY_ONLY_IN_DEV])
    ->ignoreErrorsOnExtensions(
        ['ext-mbstring', 'ext-filter'],
        [ErrorType::PROD_DEPENDENCY_ONLY_IN_DEV],
    );
