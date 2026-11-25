<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

/**
 * The messages of the templates, in English and in French: see translations/.
 */
return App::config([
    'translation' => [
        'default_path' => '%kernel.project_dir%/translations',
        'fallbacks' => ['en'],
    ],
]);
