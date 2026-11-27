<?php

// The tasks of the application: run `castor` to list them. Tested with Castor 1.9.
// https://castor.jolicode.com
//
// The tests, the coverage, the lints, the static analysis, the fixers, the local continuous integration and the git
// hooks are the common tasks of phil/dev-tools, imported below (see vendor/phil/dev-tools/doc/castor.md). This file
// keeps the tasks of this application only: its servers, its environments and the Symfony requirements.

declare(strict_types=1);

// Every task runs from the directory of the project, whichever directory castor is called from.
defined('CASTOR_USE_CHDIR') || define('CASTOR_USE_CHDIR', true);

use Castor\Attribute\AsTask;

use function Castor\exit_code;
use function Castor\import;
use function Castor\io;
use function Phil\DevTools\Castor\aborted;
use function Phil\DevTools\Castor\aggregate;
use function Phil\DevTools\Castor\success;
use function Phil\DevTools\Castor\title;

// The settings of the common tasks: four of the five suites of phpunit.dist.xml, every line covered.
const PHIL_CASTOR = [
    // E2E is left out: it needs Chrome and chromedriver, and `castor test:e2e` runs it alone, outside `castor test`,
    // `castor coverage`, `castor ci` and the continuous integration.
    'suites' => ['Unit', 'Integration', 'Api', 'Functional'],
    'coverage_threshold' => 100,
];

import(__DIR__.'/vendor/phil/dev-tools/resources/castor/tasks.php');

// Servers ————————————————————————————————————————————————————————————————————

#[AsTask(namespace: 'symfony', description: 'Serve the application with the Symfony binary', aliases: ['start'])]
function start(): int
{
    title('symfony:start');

    return exit_code('symfony serve --daemon');
}

#[AsTask(namespace: 'symfony', description: 'Stop the web server of the Symfony binary', aliases: ['stop'])]
function stop(): int
{
    title('symfony:stop');

    return exit_code('symfony server:stop');
}

#[AsTask(namespace: 'docker', description: 'Start FrankenPHP in worker mode with Docker Compose', aliases: ['up'])]
function up(): int
{
    title('docker:up');

    return success(exit_code('docker compose up --detach --wait --build'));
}

#[AsTask(namespace: 'docker', description: 'Stop the Docker Compose services', aliases: ['down'])]
function down(): int
{
    title('docker:down');

    return success(exit_code('docker compose down --remove-orphans'));
}

// Environments ———————————————————————————————————————————————————————————————

#[AsTask(namespace: 'symfony', description: 'Switch to the production environment', aliases: ['go-prod'])]
function go_prod(): int
{
    title('symfony:go_prod');
    if (io()->confirm('Are you sure you want to switch to the production environment? This will overwrite your .env.local file.', false)) {
        return success(aggregate(exit_code('cp .env.local.dist .env.local'), exit_code('bin/console asset-map:compile')));
    }

    aborted();

    return 0;
}

#[AsTask(namespace: 'symfony', description: 'Switch to the development environment', aliases: ['go-dev'])]
function go_dev(): int
{
    title('symfony:go_dev');
    if (io()->confirm('Are you sure you want to switch to the development environment? This will delete your .env.local file.', false)) {
        return success(aggregate(exit_code('rm -f .env.local'), exit_code('rm -rf ./public/assets/*')));
    }

    aborted();

    return 0;
}

#[AsTask(namespace: 'symfony', description: 'Purge all Symfony cache and logs', aliases: ['purge'])]
function purge(): int
{
    title('symfony:purge');

    return success(exit_code('rm -rf ./var/cache/* ./var/log/* ./var/coverage/*'));
}

// Helpers ————————————————————————————————————————————————————————————————————

#[AsTask(name: 'check-requirements', namespace: 'helpers', description: 'Check the requirements of Symfony', aliases: ['check-requirements'])]
function check_requirements(): int
{
    title('helpers:check-requirements');

    return success(exit_code('vendor/bin/requirements-checker'));
}
