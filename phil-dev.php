<?php

declare(strict_types=1);

/*
 * What phil/dev-tools reads of this application: its paths and its exceptions to the shared configurations.
 * See vendor/phil/dev-tools/doc/configuration.md for every section.
 */
return [
    'paths' => ['src', 'tests', 'bin', 'public', 'importmap.php'],
    // Besides the Symfony components, the classes of src/ may use these libraries and bundles, and no other: a new one
    // is added here on purpose, after it is required by composer.json.
    'deptrac' => ['allow' => [
        '^Symfony\\\\Bundle\\\\FrameworkBundle\\\\.*',
        '^Twig\\\\.*',
    ]],
    // The Stimulus controllers and the scripts of the application; assets/vendor holds the packages of the importmap.
    'js' => ['paths' => ['assets/controllers', 'assets/app.js', 'assets/bootstrap.js']],
    // Used through the configuration, the templates, the front controller or the console, never by a class of src/.
    'unused' => ['ignore' => [
        'ext-ctype', 'ext-iconv', 'ext-simplexml', 'league/commonmark', 'sentry/sentry-symfony', 'symfony/asset',
        'symfony/asset-mapper', 'symfony/console', 'symfony/dotenv', 'symfony/flex', 'symfony/intl',
        'symfony/monolog-bundle', 'symfony/runtime', 'symfony/security-csrf', 'symfony/stimulus-bundle',
        'symfony/translation', 'symfony/twig-bundle', 'symfony/ux-turbo', 'symfony/web-link', 'symfony/yaml',
        'twig/extra-bundle', 'twig/markdown-extra',
    ]],
];
