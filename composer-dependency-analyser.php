<?php

declare(strict_types=1);

use ShipMonk\ComposerDependencyAnalyser\Config\Configuration;
use ShipMonk\ComposerDependencyAnalyser\Config\ErrorType;

/**
 * The declared dependencies, checked against the code that uses them.
 */
return new Configuration()
    ->addPathToScan(__DIR__.'/src', isDev: false)
    ->addPathToScan(__DIR__.'/tests', isDev: true)
    // Used through the configuration, the templates, the front controller or the console, never by a class of src/.
    ->ignoreErrorsOnPackages([
        'league/commonmark',
        'sentry/sentry-symfony',
        'symfony/asset',
        'symfony/asset-mapper',
        'symfony/console',
        'symfony/flex',
        'symfony/intl',
        'symfony/monolog-bundle',
        'symfony/runtime',
        'symfony/security-csrf',
        'symfony/stimulus-bundle',
        'symfony/translation',
        'symfony/twig-bundle',
        'symfony/ux-turbo',
        'symfony/web-link',
        'symfony/yaml',
        'twig/extra-bundle',
        'twig/markdown-extra',
    ], [ErrorType::UNUSED_DEPENDENCY])
    // The .env files are read by the front controller and the console through the runtime, the tests read them directly.
    ->ignoreErrorsOnPackage('symfony/dotenv', [ErrorType::PROD_DEPENDENCY_ONLY_IN_DEV])
    // Required by Symfony and its components, which the analysis does not follow.
    ->ignoreErrorsOnExtensions(['ext-ctype', 'ext-iconv', 'ext-xml'], [ErrorType::UNUSED_DEPENDENCY])
    // Required by Symfony and its components; besides, the container test reads the dumped container with it.
    ->ignoreErrorsOnExtension('ext-simplexml', [ErrorType::PROD_DEPENDENCY_ONLY_IN_DEV]);
