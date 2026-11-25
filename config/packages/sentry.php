<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

/**
 * The errors of the production environment, sent to Sentry when SENTRY_DSN is set; with an empty DSN nothing is sent.
 *
 * @see https://docs.sentry.io/platforms/php/guides/symfony/
 */
return App::config([
    'when@prod' => [
        'sentry' => [
            'dsn' => '%env(SENTRY_DSN)%',
            'options' => [
                // The request headers, the cookies, the IP address and the authenticated user stay out of the events:
                // see https://docs.sentry.io/platforms/php/data-management/data-collected/ before turning it on.
                // 'send_default_pii' => true,
                'ignore_exceptions' => [
                    'Symfony\Component\ErrorHandler\Error\FatalError',
                    'Symfony\Component\Debug\Exception\FatalErrorException',
                ],
            ],
        ],
    ],
]);
