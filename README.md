# MicroSymfony 🎶

[![Latest Version](https://img.shields.io/packagist/v/phil/micro-symfony.svg?style=flat-square)](https://packagist.org/packages/phil/micro-symfony)
[![PHP Version Require](https://poser.pugx.org/phil/micro-symfony/require/php?style=flat-square)](https://packagist.org/packages/phil/micro-symfony)
[![Symfony Version](https://img.shields.io/badge/Symfony-8.2-black?logo=symfony)](https://symfony.com/8)
[![Symfony Style](https://img.shields.io/badge/code%20style-symfony-black?logo=symfony)](https://symfony.com/doc/current/contributing/code/standards.html)
[![PHPStan level](https://img.shields.io/badge/PHPStan-level%20max-success?style=flat-square)](phpstan.neon)
[![Software License](https://img.shields.io/badge/License-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Build Status (GitHub)](https://img.shields.io/github/actions/workflow/status/parler-haut-interagir-librement/MicroSymfony/symfony.yml?branch=main&style=flat-square)](https://github.com/parler-haut-interagir-librement/MicroSymfony/actions?query=workflow%3ASymfony+branch%3Amain)

## About 🖋

MicroSymfony is a [Symfony 8.2](https://symfony.com/8) application template on steroids, ready to use: a sandbox with
sensible defaults, tests of every kind and strict quality gates, to start a proof of concept, try an idea or build a
small application.

This template is the PHIL version of [strangebuzz/MicroSymfony](https://github.com/strangebuzz/MicroSymfony), created
and maintained by [COil](https://github.com/COil) of [Strangebuzz](https://www.strangebuzz.com). It keeps its name,
its features and its spirit, and follows its releases. What differs, and why, is listed in
[Differences from strangebuzz/MicroSymfony](#differences-from-strangebuzzmicrosymfony-). The philosophy behind the
template is explained by its author:

* [Introducing the MicroSymfony application template](https://www.strangebuzz.com/en/blog/introducing-the-microsymfony-application-template)
* [MicroSymfony 8: ready for the LTS promise](https://www.strangebuzz.com/en/blog/microsymfony-8-ready-for-the-lts-promise)

## Table of Contents 📖

* [Quick-start](#quick-start-)
  * [With the Symfony binary](#with-the-symfony-binary-)
  * [With FrankenPHP and PostgreSQL](#with-frankenphp-and-postgresql-)
  * [With MySQL](#with-mysql-)
* [Requirements](#requirements-)
* [Stack](#stack-)
* [Features](#features-)
* [Tasks](#tasks-)
* [Quality gates](#quality-gates-)
* [Differences from strangebuzz/MicroSymfony](#differences-from-strangebuzzmicrosymfony-)
* [Notes](#notes-)
* [ADR](#adr-)
* [References](#references-)
* [Contributing](#contributing-)
* [Security](#security-)
* [Credits](#credits-)
* [License](#license-)

## Quick-start ⚡

Create a new project from the latest release:

    composer create-project phil/micro-symfony my-project && cd my-project

The repository is also a GitHub template repository: the "Use this template" button creates a new repository from the
main branch, whose commits all pass the continuous integration.

### With the Symfony binary 🎶

You need the [Symfony binary](https://symfony.com/download#step-1-install-symfony-cli) and
[Castor](https://castor.jolicode.com/getting-started/installation/). The database is a SQLite file in `var/`:

    castor start

Open [https://127.0.0.1:8000](https://127.0.0.1:8000) (if port 8000 is free). `castor stop` stops the server and
deletes the database.

### With FrankenPHP and PostgreSQL 🧟

You need [Docker](https://www.docker.com/). `compose.yaml` serves the application with
[FrankenPHP](https://frankenphp.dev/) in worker mode, which boots the kernel once and serves request after request,
and restarts its workers when a file changes; the database is PostgreSQL 17:

    castor up

Open [https://localhost](https://localhost). `castor down` stops the services. The image of `docker/Dockerfile` is
for development: an application deployed from this template brings its own deployment.

### With MySQL 🐬

MySQL is the other database the template supports. In `compose.yaml`, replace the `database` service with a
`mysql:8.4` image and set `DATABASE_URL` to:

    mysql://app:app@database:3306/app?serverVersion=8.4&charset=utf8mb4

With the Symfony binary, set the same variable in `.env.local`, with the host of your server. The migration is written
in the SQL of the database it runs on, so it needs no change.

## Requirements ⚙

* [PHP 8.5](https://www.php.net/releases/8.5/en.php) or later, with the extensions of `composer.json`, and
  [Castor](https://castor.jolicode.com)
* The [Symfony binary](https://symfony.com/download), or [Docker](https://www.docker.com)
* The [Xdebug](https://xdebug.org/) or [PCOV](https://github.com/krakjoe/pcov) extension for the code coverage report

## Stack 🔗

* [PHP 8.5](https://www.php.net/releases/8.5/en.php)
* [Symfony 8.2](https://symfony.com/8), from its release candidate
* [Doctrine ORM 3 (DBAL 4)](https://www.doctrine-project.org), on SQLite, PostgreSQL or MySQL
* [Twig 3](https://twig.symfony.com)
* [AssetMapper](https://symfony.com/doc/current/frontend/asset_mapper.html), [Stimulus 3.2](https://stimulus.hotwired.dev/) and [Turbo 8](https://turbo.hotwired.dev/), without Node.js
* [PHPUnit 13](https://phpunit.de)
* [Pico CSS 2.1](https://picocss.com)
* [FrankenPHP](https://frankenphp.dev/) in worker mode, through Docker Compose

## Features 🚀

* Tasks run by [Castor](https://castor.jolicode.com) ([source](castor.php), [output](docs/castor-output.txt))
* Static analysis with [PHPStan 2](https://phpstan.org) at the maximum level, with the strict, deprecation, Symfony,
  Doctrine and PHPUnit rules ([configuration](phpstan.neon))
* Coding standards with [PHP-CS-Fixer](https://github.com/PHP-CS-Fixer/PHP-CS-Fixer), Twig-CS-Fixer and
  [Biome](https://biomejs.dev) for the Stimulus controllers
* Tests of every kind, with one example each:
  * unit: [StringHelperTest](tests/Unit/Helper/StringHelperTest.php)
  * integration: [RoutingExtensionTest](tests/Integration/Twig/Extension/RoutingExtensionTest.php)
  * functional: [ComposerActionTest](tests/Functional/Controller/ComposerActionTest.php)
  * API: [SlugifyActionTest](tests/Api/Controller/SlugifyActionTest.php)
  * end-to-end: [AppControllerTest](tests/E2E/Controller/AppControllerTest.php)
* Code coverage at 100 % (the threshold is a constant of `castor.php`)
* A GitHub Actions workflow: security, tests on PHP 8.5 and 8.6, lints
* Doctrine with a `User` entity, its [factory](src/Factory/UserFactory.php) and [story](src/Story/AppStory.php) for
  [Foundry](https://github.com/zenstruck/foundry), and a [list of users](src/Controller/ListUsersAction.php)
* AssetMapper and Stimulus: a vanilla controller ([source](assets/controllers/hello_controller.js)) and one that fetches
  JSON from an endpoint of the application ([source](assets/controllers/api_controller.js))
* A custom error template ([source](templates/bundles/TwigBundle/Exception/error.html.twig))

## Tasks 🧰

`castor` lists every task. The main ones:

| Task | What it does |
|---|---|
| `castor start`, `castor stop` | The Symfony binary's web server with SQLite, its migrations and its fixtures. |
| `castor up`, `castor down` | FrankenPHP in worker mode and PostgreSQL, with Docker Compose. |
| `castor load-fixtures` | The SQLite database reset, migrated and filled. |
| `castor test` | Every PHPUnit suite; `--filter` and `--options` pass on to PHPUnit. |
| `castor test:unit`, `test:integration`, `test:api`, `test:functional`, `test:e2e` | One suite. |
| `castor test:next` | The tests on the next PHP version, in its Docker image. |
| `castor coverage` | The HTML coverage report in `var/coverage/`, and its threshold. |
| `castor infection` | Mutation testing. |
| `castor lint` | Every lint and the static analysis. |
| `castor fix` | Rector, PHP-CS-Fixer, Twig-CS-Fixer, Biome and composer-normalize. |
| `castor ci` | The continuous integration, locally: coverage, then every lint. |
| `castor hooks` | The git hooks: the fast checks on the staged files before each commit. |

## Quality gates 🚦

The checks come from [`phil/dev-tools`](https://packagist.org/packages/phil/dev-tools), the shared tooling of PHIL,
adapted to an application. Each tool is installed in its own `vendor-bin/<tool>/` directory by the
[Composer bin plugin](https://github.com/bamarni/composer-bin-plugin), so that its dependencies never meet the
application's. The thin configuration files at the root (`phpstan.neon`, `rector.php`, `.php-cs-fixer.dist.php`,
`arkitect.php`) call the shared ones; `phil-dev.php` holds what is particular to the application, each exception with
its reason.

| Task | Checks |
|---|---|
| `castor lint:composer` | The dependency analysis (a class used without its package required), `composer audit`, composer-unused and composer-normalize. |
| `castor lint:php` | PHP-CS-Fixer: `@Symfony`, `@Symfony:risky`, strict types and strict comparisons. |
| `castor lint:twig` | `lint:twig`, then the code style of the templates. |
| `castor lint:js` | Biome on the Stimulus controllers. |
| `castor lint:yaml`, `lint:container`, `lint:doctrine` | The YAML files, the container and the Doctrine mapping. |
| `castor stan` | PHPStan at the maximum level, with type coverage at 100 %, a cognitive complexity limit and forbidden calls. |
| `castor lint:rector` | Rector has nothing left to change. |
| `castor lint:architecture` | Arkitect on the shape of the classes; Deptrac on the libraries `src/` may use, listed in `phil-dev.php`. |

## Differences from strangebuzz/MicroSymfony 🔀

This template follows the releases of [strangebuzz/MicroSymfony](https://github.com/strangebuzz/MicroSymfony). It
differs where the principles of PHIL ask for it:

| strangebuzz/MicroSymfony | This template | Why |
|---|---|---|
| The latest stable Symfony (8.1) | Symfony 8.2 from its first release candidate, `minimum-stability` at `beta` | PHIL tests on the next Symfony as soon as its release candidate is out. Symfony tags only the components that changed since the last beta, so `beta` is the lowest stability that installs 8.2.0-RC1; `prefer-stable` takes the stable releases first. |
| PHP 8.4 or later | PHP 8.5 or later | The floor of every PHIL package and template; the continuous integration also runs the next PHP. |
| Make and Castor | Castor only, no task script in `composer.json` | One task runner, written in PHP; Composer stays a dependency manager. |
| PHPStan and PHP-CS-Fixer, Biome through a bundle | The gates of `phil/dev-tools`: PHPStan with its extensions, Rector, Arkitect, Deptrac, Twig-CS-Fixer, Biome, the dependency analysis, composer-unused, composer-normalize, CaptainHook, Infection | The checks every PHIL repository passes, so that an application starts at the same bar. |
| PHPUnit tests, coverage metadata optional | `#[CoversClass]` or `#[CoversNothing]` required, deprecations, notices and warnings fail | Coverage counts only what a test sets out to test, and a deprecation is fixed before the next version removes it. |
| A SQLite-specific initial migration | The same migration described through the DBAL schema API, written in the SQL of the platform | The template runs on SQLite, PostgreSQL and MySQL. |
| A FrankenPHP demo with `docker run` | `compose.yaml` with FrankenPHP in worker mode and PostgreSQL | One command for the production-like setup; the Symfony binary with SQLite stays the light choice. |
| Deployment tasks, Apache configuration, Scrutinizer | None | A template holds no deployment: each application brings its own. |
| A procedure to downgrade to Symfony 7.4 LTS | None | PHIL supports the latest Symfony only. |
| Dates typed `DateTimeInterface` | `DateTimeImmutable`, set by the constructor | Matches the `datetime_immutable` mapping and leaves no uninitialised property. |
| Exit codes of the aggregate tasks summed | Exit codes reduced to 0 or 1 | A shell keeps exit codes modulo 256: a sum of 256 reads as a success. |

The template requires no PHIL package at run time: `phil/dev-tools` is a development dependency only, and the
application stays micro.

## Notes 📒

### Symfony UX

Turbo forms are disabled in [assets/app.js](assets/app.js). To enable them for a form, add the `data-turbo="true"`
attribute to it, or set `Turbo.setFormMode` to `on` to enable them everywhere. In both cases, the controller has to be
[adapted](https://symfony.com/bundles/ux-turbo/current/index.html#3-form-response-code-changes).

### PHP configuration files

A Flex recipe can add YAML files to the project. They are loaded as they are; to convert them to PHP, follow the
other files of `config/packages`.

### Without Doctrine

[`agents/remove-doctrine.md`](agents/remove-doctrine.md) lists the steps that remove Doctrine, for an application
that needs no database.

## ADR 📝

[Architecture Decision Records](https://adr.github.io/) of strangebuzz/MicroSymfony, which this template keeps:

* [2026-01-17] Use Doctrine ORM as the default database layer ([PR](https://github.com/strangebuzz/MicroSymfony/pull/219))
* [2025-12-29] Use the new PHP configuration ([PR](https://github.com/strangebuzz/MicroSymfony/pull/197))
* [2025-01-25] Include the FrankenPHP runtime by default ([PR](https://github.com/strangebuzz/MicroSymfony/pull/54))
* [2025-01-21] Add PHPUnit test suites ([PR](https://github.com/strangebuzz/MicroSymfony/pull/155))
* [2024-12-18] Use PicoCSS instead of BareCSS as the CSS framework ([PR](https://github.com/strangebuzz/MicroSymfony/pull/85))
* [2024-12-05] Convert all configuration files to PHP (fluent interface) ([PR](https://github.com/strangebuzz/MicroSymfony/pull/129))
* [2024-09-22] Use the ADR pattern for all controllers ([PR](https://github.com/strangebuzz/MicroSymfony/pull/58))

Those of this template:

* [2026-11-25] Symfony 8.2 from its release candidate, PHP 8.5, the gates of `phil/dev-tools`, Castor only,
  FrankenPHP in worker mode with PostgreSQL in `compose.yaml`

## References 📚

* [Introducing the MicroSymfony application template](https://www.strangebuzz.com/en/blog/introducing-the-microsymfony-application-template) (strangebuzz.com)
* [MicroSymfony 8: ready for the LTS promise](https://www.strangebuzz.com/en/blog/microsymfony-8-ready-for-the-lts-promise) (strangebuzz.com)
* [Initializing your Symfony project with solid foundations](https://www.strangebuzz.com/en/blog/initializing-your-symfony-project-with-solid-foundations) (strangebuzz.com)
* [Organizing your Symfony project tests](https://www.strangebuzz.com/en/blog/organizing-your-symfony-project-tests) (strangebuzz.com)
* [A better ADR pattern for your Symfony controllers](https://www.strangebuzz.com/en/blog/a-better-adr-pattern-for-your-symfony-controllers) (strangebuzz.com)
* [Castor, a journey across the sea of task runners](https://jolicode.com/blog/castor-a-journey-across-the-sea-of-task-runners) (jolicode.com)
* [PHPStan 2.0 Released With Level 10 and Elephpants!](https://phpstan.org/blog/phpstan-2-0-released-level-10-elephpants) (phpstan.org)
* [You should be using PHPStan's bleeding edge](https://backendtea.com/post/use-phpstan-bleeding-edge/) (backendtea.com)
* [A Good Naming Convention for Routes, Controllers and Templates?](https://jolicode.com/blog/a-good-naming-convention-for-routes-controllers-and-templates) (jolicode.com)
* [Front-end application development, Symfony-style(s)](https://dunglas.dev/2024/04/front-end-application-development-symfony-styles/) (dunglas.dev)
* [The Symfony Framework Best Practices](https://symfony.com/doc/current/best_practices.html) (symfony.com)

## Contributing 🤝

See [CONTRIBUTING](CONTRIBUTING.md) and the [Code of Conduct](CODE_OF_CONDUCT.md).

## Security 🧯

See [SECURITY](SECURITY.md).

## Credits 🙏

* [COil](https://github.com/COil), author of [strangebuzz/MicroSymfony](https://github.com/strangebuzz/MicroSymfony),
  and [its contributors](https://github.com/strangebuzz/MicroSymfony/graphs/contributors)
* [Philippe Gamache](https://ph-il.ca), maintainer of this template, for
  [Parler Haut, Interagir Librement](https://ph-il.ca)

## License ⚖️

The MIT License, with the attribution to the original repository it asks for. See the [license file](LICENSE).
