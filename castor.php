<?php

// The tasks of the application: run `castor` to list them. Tested with Castor 1.9.
// https://castor.jolicode.com

declare(strict_types=1);

// Every task runs from the directory of the project, whichever directory castor is called from.
defined('CASTOR_USE_CHDIR') || define('CASTOR_USE_CHDIR', true);

use Castor\Attribute\AsOption;
use Castor\Attribute\AsTask;

use function Castor\context;
use function Castor\exit_code;
use function Castor\io;
use function Castor\run;
use function Castor\task;

// The code coverage threshold, in percent, that test:coverage enforces.
const COVERAGE_THRESHOLD = 100;
const COVERAGE_TEXT_REPORT = 'var/coverage/coverage-text.txt';

// The quality tools, each installed in its own vendor-bin/<tool>/ by bamarni/composer-bin-plugin.
const PHPUNIT = 'vendor/bin/phpunit';
const PHIL_DEV = 'vendor/bin/phil-dev';
const PHP_CS_FIXER = 'vendor-bin/php-cs-fixer/vendor/bin/php-cs-fixer';
const PHPSTAN = 'vendor-bin/phpstan/vendor/bin/phpstan';
const RECTOR = 'vendor-bin/rector/vendor/bin/rector';
const ARKITECT = 'vendor-bin/arkitect/vendor/bin/phparkitect';
const CAPTAINHOOK = 'vendor-bin/captainhook/vendor/bin/captainhook';

function title(string $name): void
{
    $task = task();
    if ($task !== null && $task->getName() === $name) {
        io()->title($task->getDescription());
    }
}

function success(int $exitCode): int
{
    if ($exitCode === 0) {
        io()->success('Done!');
    } else {
        io()->error(sprintf('Failure (exit code %d returned).', $exitCode));
    }

    return $exitCode;
}

function aborted(string $message = 'Aborted'): void
{
    io()->warning($message);
}

/**
 * Reduces several exit codes to one: 0 only when every step succeeded.
 *
 * Exit codes are never summed: a shell keeps them modulo 256, so 128 + 128 would read as a success.
 */
function aggregate(int ...$exitCodes): int
{
    return array_any($exitCodes, static fn (int $exitCode): bool => $exitCode !== 0) ? 1 : 0;
}

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

// Tests ——————————————————————————————————————————————————————————————————————

const PHPUNIT_SUITES = ['Unit', 'Integration', 'Api', 'Functional', 'E2E'];

function phpunit(string $suites, string $filter, string $options): int
{
    $command = sprintf('%s --testsuite=%s', PHPUNIT, $suites);
    if ($filter !== '') {
        $command .= sprintf(' --filter=%s', escapeshellarg($filter));
    }

    $exitCode = exit_code(trim($command.' '.$options));
    io()->newLine();

    return $exitCode;
}

#[AsTask(name: 'all', namespace: 'test', description: 'Run every test suite, eg: "castor test --filter=slug --options=--testdox"', aliases: ['test'])]
function test_all(
    #[AsOption(description: 'A PHPUnit filter')] string $filter = '',
    #[AsOption(description: 'More PHPUnit options')] string $options = '--stop-on-failure',
): int {
    title('test:all');

    return phpunit(implode(',', PHPUNIT_SUITES), $filter, $options);
}

#[AsTask(name: 'unit', namespace: 'test', description: 'Run the unit tests only', aliases: ['test-unit'])]
function test_unit(#[AsOption] string $filter = '', #[AsOption] string $options = ''): int
{
    title('test:unit');

    return phpunit('Unit', $filter, $options);
}

#[AsTask(name: 'integration', namespace: 'test', description: 'Run the integration tests only', aliases: ['test-integration'])]
function test_integration(#[AsOption] string $filter = '', #[AsOption] string $options = ''): int
{
    title('test:integration');

    return phpunit('Integration', $filter, $options);
}

#[AsTask(name: 'api', namespace: 'test', description: 'Run the API tests only', aliases: ['test-api'])]
function test_api(#[AsOption] string $filter = '', #[AsOption] string $options = ''): int
{
    title('test:api');

    return phpunit('Api', $filter, $options);
}

#[AsTask(name: 'functional', namespace: 'test', description: 'Run the functional tests only', aliases: ['test-functional'])]
function test_functional(#[AsOption] string $filter = '', #[AsOption] string $options = ''): int
{
    title('test:functional');

    return phpunit('Functional', $filter, $options);
}

#[AsTask(name: 'e2e', namespace: 'test', description: 'Run the end-to-end tests only', aliases: ['test-e2e'])]
function test_e2e(#[AsOption] string $filter = '', #[AsOption] string $options = ''): int
{
    title('test:e2e');

    return phpunit('E2E', $filter, $options);
}

#[AsTask(name: 'next', namespace: 'test', description: 'Run the tests on the next PHP version, in its Docker image')]
function test_next(): int
{
    title('test:next');

    return success(exit_code(sprintf('%s php next -- %s', PHIL_DEV, PHPUNIT)));
}

#[AsTask(namespace: 'test', description: 'Generate the HTML code coverage report (var/coverage) and check its threshold', aliases: ['coverage'])]
function coverage(): int
{
    title('test:coverage');
    exit_code('rm -rf ./var/coverage/*');
    $exitCode = exit_code(sprintf('php -d memory_limit=-1 %s --coverage-html=var/coverage --coverage-text=%s', PHPUNIT, COVERAGE_TEXT_REPORT),
        context: context()->withEnvironment(['XDEBUG_MODE' => 'coverage'])
    );
    if ($exitCode !== 0) {
        return $exitCode;
    }

    return success(exit_code(sprintf('php bin/coverage-checker.php %s %d', COVERAGE_TEXT_REPORT, COVERAGE_THRESHOLD)));
}

#[AsTask(namespace: 'test', description: 'Mutation testing with Infection', aliases: ['infection'])]
function infection(): int
{
    title('test:infection');

    return success(exit_code(sprintf('%s infection', PHIL_DEV)));
}

// Security ———————————————————————————————————————————————————————————————————

#[AsTask(name: 'taint', namespace: 'security', description: 'Follow the untrusted inputs to HTML, SQL, shells and files with the taint analysis of Psalm', aliases: ['taint'])]
function taint(): int
{
    title('security:taint');

    return success(exit_code(sprintf('%s taint', PHIL_DEV)));
}

// Lints and static analysis ——————————————————————————————————————————————————

#[AsTask(name: 'php', namespace: 'lint', description: 'Check the code style of the PHP files with PHP-CS-Fixer', aliases: ['lint-php'])]
function lint_php(): int
{
    title('lint:php');

    return success(exit_code(sprintf('%s check --diff', PHP_CS_FIXER)));
}

#[AsTask(name: 'twig', namespace: 'lint', description: 'Lint the Twig templates and check their code style', aliases: ['lint-twig'])]
function lint_twig(): int
{
    title('lint:twig');

    return success(aggregate(exit_code('bin/console lint:twig templates/'), exit_code(sprintf('%s twig', PHIL_DEV))));
}

#[AsTask(name: 'js', namespace: 'lint', description: 'Check the Stimulus controllers and the styles with Biome', aliases: ['lint-js'])]
function lint_js(): int
{
    title('lint:js');

    return success(exit_code(sprintf('%s js', PHIL_DEV)));
}

#[AsTask(name: 'container', namespace: 'lint', description: 'Lint the Symfony container', aliases: ['lint-container'])]
function lint_container(): int
{
    title('lint:container');

    return success(exit_code('bin/console lint:container'));
}

#[AsTask(name: 'yaml', namespace: 'lint', description: 'Lint the YAML files', aliases: ['lint-yaml'])]
function lint_yaml(): int
{
    title('lint:yaml');

    return success(exit_code('bin/console lint:yaml config .github compose.yaml translations --parse-tags'));
}

#[AsTask(name: 'composer', namespace: 'lint', description: 'Check the dependencies: analysis, advisories, unused packages, normalized composer.json', aliases: ['lint-composer'])]
function lint_composer(): int
{
    title('lint:composer');

    return success(aggregate(
        exit_code('vendor/bin/composer-dependency-analyser'),
        exit_code(sprintf('%s audit', PHIL_DEV)),
        exit_code(sprintf('%s unused', PHIL_DEV)),
        exit_code(sprintf('%s normalize', PHIL_DEV)),
    ));
}

#[AsTask(namespace: 'lint', description: 'Run PHPStan at the maximum level, then check its witnesses', aliases: ['analyse', 'stan'])]
function analyse(): int
{
    title('lint:analyse');

    if (!file_exists('var/cache/dev/App_KernelDevDebugContainer.xml')) {
        io()->note('PHPStan reads the container of the dev environment. Generating it...');
        run('bin/console cache:warmup', context: context()->withEnvironment(['APP_ENV' => 'dev', 'APP_DEBUG' => '1']));
    }

    return success(aggregate(
        exit_code(sprintf('%s analyse --no-progress --memory-limit=1G', PHPSTAN)),
        exit_code(sprintf('%s witnesses', PHIL_DEV)),
    ));
}

#[AsTask(name: 'rector', namespace: 'lint', description: 'Check that Rector has nothing left to change', aliases: ['lint-rector'])]
function lint_rector(): int
{
    title('lint:rector');

    return success(exit_code(sprintf('%s process --dry-run', RECTOR)));
}

#[AsTask(name: 'architecture', namespace: 'lint', description: 'Check the shape of the classes with Arkitect and the layers with Deptrac', aliases: ['lint-architecture'])]
function lint_architecture(): int
{
    title('lint:architecture');

    return success(aggregate(
        exit_code(sprintf('%s check --config=arkitect.php', ARKITECT)),
        exit_code(sprintf('%s deptrac', PHIL_DEV)),
    ));
}

#[AsTask(name: 'all', namespace: 'lint', description: 'Run every lint and the static analysis', aliases: ['lint'])]
function lint_all(): int
{
    title('lint:all');

    return success(aggregate(
        lint_composer(),
        lint_php(),
        lint_twig(),
        lint_js(),
        lint_yaml(),
        lint_container(),
        analyse(),
        lint_rector(),
        lint_architecture(),
    ));
}

// Fixers —————————————————————————————————————————————————————————————————————

#[AsTask(name: 'php', namespace: 'fix', description: 'Fix the code style of the PHP files with PHP-CS-Fixer', aliases: ['fix-php'])]
function fix_php(): int
{
    title('fix:php');

    return success(exit_code(sprintf('%s fix', PHP_CS_FIXER)));
}

#[AsTask(name: 'rector', namespace: 'fix', description: 'Apply the changes of Rector', aliases: ['fix-rector'])]
function fix_rector(): int
{
    title('fix:rector');

    return success(exit_code(sprintf('%s process', RECTOR)));
}

#[AsTask(name: 'twig', namespace: 'fix', description: 'Fix the code style of the Twig templates', aliases: ['fix-twig'])]
function fix_twig(): int
{
    title('fix:twig');

    return success(exit_code(sprintf('%s twig --fix', PHIL_DEV)));
}

#[AsTask(name: 'js', namespace: 'fix', description: 'Fix the Stimulus controllers and the styles with Biome', aliases: ['fix-js'])]
function fix_js(): int
{
    title('fix:js');

    return success(exit_code(sprintf('%s js --fix', PHIL_DEV)));
}

#[AsTask(name: 'composer', namespace: 'fix', description: 'Normalize composer.json', aliases: ['fix-composer'])]
function fix_composer(): int
{
    title('fix:composer');

    return success(exit_code(sprintf('%s normalize --fix', PHIL_DEV)));
}

#[AsTask(name: 'all', namespace: 'fix', description: 'Run every fixer', aliases: ['fix'])]
function fix_all(): int
{
    title('fix:all');

    return success(aggregate(fix_rector(), fix_php(), fix_twig(), fix_js(), fix_composer()));
}

// Continuous integration —————————————————————————————————————————————————————

#[AsTask(name: 'all', namespace: 'ci', description: 'Run the continuous integration locally: coverage, then every lint', aliases: ['ci'])]
function ci(): int
{
    title('ci:all');
    purge();
    io()->section('Coverage');
    $coverage = coverage();
    io()->section('Lints');

    return success(aggregate($coverage, lint_all()));
}

// Helpers ————————————————————————————————————————————————————————————————————

#[AsTask(name: 'hooks', namespace: 'helpers', description: 'Install the git hooks: the fast checks on the staged files before each commit', aliases: ['hooks'])]
function hooks(): int
{
    title('helpers:hooks');

    return success(exit_code(sprintf('%s install --force --configuration=captainhook.json', CAPTAINHOOK)));
}

#[AsTask(name: 'versions', namespace: 'helpers', description: 'Output the versions of the stack', aliases: ['versions'])]
function versions(): int
{
    title('helpers:versions');

    return success(aggregate(
        exit_code('castor --version'),
        exit_code('php -v'),
        exit_code('composer --version'),
        exit_code('bin/console --version'),
        exit_code(sprintf('%s --version', PHPUNIT)),
        exit_code(sprintf('%s --version', PHPSTAN)),
        exit_code(sprintf('%s --version', PHP_CS_FIXER)),
    ));
}

#[AsTask(name: 'check-requirements', namespace: 'helpers', description: 'Check the requirements of Symfony', aliases: ['check-requirements'])]
function check_requirements(): int
{
    title('helpers:check-requirements');

    return success(exit_code('vendor/bin/requirements-checker'));
}
