# MicroSymfony 🎶

[![Latest Version](https://img.shields.io/packagist/v/phil/microsymfony.svg?style=flat-square)](https://packagist.org/packages/phil/microsymfony)
[![PHP Version Require](https://poser.pugx.org/phil/microsymfony/require/php?style=flat-square)](https://packagist.org/packages/phil/microsymfony)
[![Symfony Version](https://img.shields.io/badge/Symfony-8.2-black?logo=symfony)](https://symfony.com/8)
[![Symfony Style](https://img.shields.io/badge/code%20style-symfony-black?logo=symfony)](https://symfony.com/doc/current/contributing/code/standards.html)
[![PHPStan level](https://img.shields.io/badge/PHPStan-level%20max-success?style=flat-square)](phpstan.neon)
[![Software License](https://img.shields.io/badge/License-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Build Status (GitHub)](https://img.shields.io/github/actions/workflow/status/parler-haut-interagir-librement/MicroSymfony/symfony.yml?branch=main&style=flat-square)](https://github.com/parler-haut-interagir-librement/MicroSymfony/actions?query=workflow%3ASymfony+branch%3Amain)

## About 🖋

MicroSymfony is a [Symfony 8.2](https://symfony.com/8) application template on steroids, ready to use: a sandbox with
sensible defaults, tests of every kind and strict quality gates, to start a proof of concept, try an idea or build a
small application. It stays micro: no database, English and French pages, and nothing a small application does not
need. Doctrine comes with [WebSymfony](https://github.com/parler-haut-interagir-librement/WebSymfony), the next
template up.

This template is the PHIL version of [strangebuzz/MicroSymfony](https://github.com/strangebuzz/MicroSymfony), created
and maintained by [COil](https://github.com/COil) of [Strangebuzz](https://www.strangebuzz.com). It keeps its name,
its features and its spirit, and follows its releases. What differs, and why, is listed in
[Differences from strangebuzz/MicroSymfony](#differences-from-strangebuzzmicrosymfony-). The philosophy behind the
template is explained by its author:

* [Introducing the MicroSymfony application template](https://www.strangebuzz.com/en/blog/introducing-the-microsymfony-application-template)
* [MicroSymfony 8: ready for the LTS promise](https://www.strangebuzz.com/en/blog/microsymfony-8-ready-for-the-lts-promise)

## Table of Contents 📖

* [Demo](#demo-)
* [Quick-start](#quick-start-)
  * [With the Symfony binary](#with-the-symfony-binary-)
  * [With FrankenPHP](#with-frankenphp-)
* [Requirements](#requirements-)
* [Stack](#stack-)
* [Features](#features-)
* [Tasks](#tasks-)
* [Quality gates](#quality-gates-)
* [Differences from strangebuzz/MicroSymfony](#differences-from-strangebuzzmicrosymfony-)
* [Notes](#notes-)
* [Other good practices](#other-good-practices-)
* [ADR](#adr-)
* [What it doesn't ship?](#what-it-doesnt-ship-)
* [PHIL bundles](#phil-bundles-)
* [References](#references-)
* [Others “Proclaim Honestly, Interact Liberally” Skeletons](#others-proclaim-honestly-interact-liberally-skeletons-)
* [Contributing](#contributing-)
* [Security](#security-)
* [Credits](#credits-)
* [License](#license-)
* [Built with MicroSymfony](#built-with-microsymfony-)

## Demo 🌈

A live demo is always better than an explanation:

* the live demo will be at [https://ph-il.ca/demos/microsymfony](https://ph-il.ca/demos/microsymfony);
* the one served by [FrankenPHP](https://frankenphp.dev/) in worker mode will be at
  [https://ph-il.ca/demos/frankenphp/microsymfony](https://ph-il.ca/demos/frankenphp/microsymfony).

## Quick-start ⚡

Create a new project from the latest release:

    composer create-project phil/microsymfony my-project && cd my-project

The repository is also a GitHub template repository: the "Use this template" button creates a new repository from the
main branch, whose commits all pass the continuous integration.

### With the Symfony binary 🎶

You need the [Symfony binary](https://symfony.com/download#step-1-install-symfony-cli) and
[Castor](https://castor.jolicode.com/getting-started/installation/):

    castor start

Open [https://127.0.0.1:8000](https://127.0.0.1:8000) (if port 8000 is free). `castor stop` stops the server.

### With FrankenPHP 🧟

You need [Docker](https://www.docker.com/). `compose.yaml` serves the application with
[FrankenPHP](https://frankenphp.dev/) in worker mode, which boots the kernel once and serves request after request,
and restarts its workers when a file changes:

    castor up

Open [https://localhost](https://localhost). `castor down` stops the service. The image of `docker/Dockerfile` is
for development: an application deployed from this template brings its own deployment.

## Requirements ⚙

* [PHP 8.5](https://www.php.net/releases/8.5/en.php) or later, with the extensions of `composer.json`, and
  [Castor](https://castor.jolicode.com)
* The [Symfony binary](https://symfony.com/download), or [Docker](https://www.docker.com)
* The [Xdebug](https://xdebug.org/) or [PCOV](https://github.com/krakjoe/pcov) extension for the code coverage report

## Stack 🔗

* [PHP 8.5](https://www.php.net/releases/8.5/en.php)
* [Symfony 8.2](https://symfony.com/8), from its release candidate
* [Twig 3](https://twig.symfony.com), with the pages in English and in French
* [Sentry](https://docs.sentry.io/platforms/php/guides/symfony/) for the errors of the production environment
* [AssetMapper](https://symfony.com/doc/current/frontend/asset_mapper.html), [Stimulus 3.2](https://stimulus.hotwired.dev/) and [Turbo 8](https://turbo.hotwired.dev/), without Node.js
* [PHPUnit 13](https://phpunit.de)
* [Pico CSS 2.1](https://picocss.com)
* [FrankenPHP](https://frankenphp.dev/) in worker mode, through Docker Compose

## Features 🚀

* Tasks run by [Castor](https://castor.jolicode.com) ([source](castor.php), [output](doc/castor-output.txt)): the
  common tasks of `phil/dev-tools`, imported from `vendor/`, and the template's own servers and environments
* Static analysis with [PHPStan 2](https://phpstan.org) at the maximum level, with the strict, deprecation, Symfony and
  PHPUnit rules ([configuration](phpstan.neon))
* Coding standards with [PHP-CS-Fixer](https://github.com/PHP-CS-Fixer/PHP-CS-Fixer), Twig-CS-Fixer and
  [Biome](https://biomejs.dev) for the Stimulus controllers
* Tests of every kind, with one example each:
  * unit: [StringHelperTest](tests/Unit/Helper/StringHelperTest.php)
  * integration: [RoutingExtensionTest](tests/Integration/Twig/Extension/RoutingExtensionTest.php), and
    [ContainerTest](tests/Integration/ContainerTest.php), which builds every service of `src/`
  * functional: [ComposerActionTest](tests/Functional/Controller/ComposerActionTest.php), and
    [RouteSmokeTest](tests/Functional/Controller/RouteSmokeTest.php), which requests every GET route
  * API: [SlugifyActionTest](tests/Api/Controller/SlugifyActionTest.php)
  * end-to-end: [AppControllerTest](tests/E2E/Controller/AppControllerTest.php)
* Code coverage at 100 % (the threshold is the `coverage_threshold` setting of `PHIL_CASTOR` in `castor.php`)
* A GitHub Actions workflow: security, tests on PHP 8.5 and 8.6, lints
* Pages in English and in French: the layout, the menu and the footer read their texts from
  [translations/](translations), and the home page shows the README of the language the browser prefers
* AssetMapper and Stimulus: a vanilla controller ([source](assets/controllers/hello_controller.js)) and one that fetches
  JSON from an endpoint of the application ([source](assets/controllers/api_controller.js))
* A custom error template ([source](templates/bundles/TwigBundle/Exception/error.html.twig))

## Tasks 🧰

`castor` lists every task. The main ones:

| Task | What it does |
|---|---|
| `castor start`, `castor stop` | The Symfony binary's web server. |
| `castor up`, `castor down` | FrankenPHP in worker mode, with Docker Compose. |
| `castor test` | Every PHPUnit suite; `--filter` and `--options` pass on to PHPUnit. |
| `castor test:unit`, `test:integration`, `test:api`, `test:functional`, `test:e2e` | One suite. |
| `castor test:suite <name>` | One suite of `phpunit.dist.xml`, by its name. |
| `castor test:next` | The tests on the next PHP version, in its Docker image. |
| `castor coverage` | The HTML coverage report in `var/coverage/`, and its threshold. |
| `castor infection` | Mutation testing. |
| `castor taint` | The taint analysis of Psalm. |
| `castor lint` | Every lint and the static analysis. |
| `castor fix` | Rector, PHP-CS-Fixer, Twig-CS-Fixer, Biome and composer-normalize. |
| `castor ci` | The continuous integration, locally: coverage, then every lint. |
| `castor hooks` | The git hooks: the fast checks on the staged files before each commit. |

Every task but the servers, `go-prod`, `go-dev`, `purge` and `check-requirements` comes from `phil/dev-tools`:
`castor.php` imports `vendor/phil/dev-tools/resources/castor/tasks.php` and sets the suites and the coverage threshold
in its `PHIL_CASTOR` constant. A task of the application's own is added to `castor.php` under a name of its own, and
named in the `test_also`, `lint_also`, `fix_also` or `ci_also` setting to run with the aggregate tasks; the tasks and
settings are described in `vendor/phil/dev-tools/doc/castor.md`.

Until `phil/dev-tools` 0.2.1-alpha is published, `composer.json` resolves it from a sibling checkout of the
`dev-tools` repository (`../dev-tools`), through a path repository copied into `vendor/`. That repository is removed
when the template is released, and `phil/dev-tools` then comes from Packagist.

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
| `castor lint:yaml`, `lint:container` | The YAML files, the messages included, and the container. |
| `castor stan` | PHPStan at the maximum level, with type coverage at 100 %, a cognitive complexity limit and forbidden calls. |
| `castor lint:rector` | Rector has nothing left to change. |
| `castor lint:architecture` | Arkitect on the shape of the classes; Deptrac on the libraries `src/` may use, listed in `phil-dev.php`. |

The taint analysis of Psalm, `castor taint`, runs on its own, before a release and once a week: it follows what comes
from a request, a file or the environment to an HTML page, a shell, a file path or `unserialize()`. The `.github/`
directory also holds the security files of `phil/dev-tools`: Dependabot, with a cooldown of seven days, the OpenSSF
Scorecard and zizmor, which audits the workflows.

## Differences from strangebuzz/MicroSymfony 🔀

This template follows the releases of [strangebuzz/MicroSymfony](https://github.com/strangebuzz/MicroSymfony). It
differs where the principles of PHIL ask for it:

| strangebuzz/MicroSymfony | This template | Why |
|---|---|---|
| The latest stable Symfony (8.1) | Symfony 8.2 from its first release candidate, `minimum-stability` at `beta` | PHIL tests on the next Symfony as soon as its release candidate is out. Symfony tags only the components that changed since the last beta, so `beta` is the lowest stability that installs 8.2.0-RC1; `prefer-stable` takes the stable releases first. |
| PHP 8.4 or later | PHP 8.5 or later | The floor of every PHIL package and template; the continuous integration also runs the next PHP. |
| Configuration in PHP, with the array shapes of `App::config()` | Configuration in YAML: `config/packages`, routes and services | The format of the Symfony documentation and of the Flex recipes, with `when@env` blocks; `config/bundles.php` and `config/preload.php` stay PHP. |
| Make and Castor | Castor only, no task script in `composer.json` | One task runner, written in PHP; Composer stays a dependency manager. |
| PHPStan and PHP-CS-Fixer, Biome through a bundle | The gates of `phil/dev-tools`: PHPStan with its extensions, Rector, Arkitect, Deptrac, Twig-CS-Fixer, Biome, the dependency analysis, composer-unused, composer-normalize, CaptainHook, Infection | The checks every PHIL repository passes, so that an application starts at the same bar. |
| PHPUnit tests, coverage metadata optional | `#[CoversClass]` or `#[CoversNothing]` required, deprecations, notices and warnings fail | Coverage counts only what a test sets out to test, and a deprecation is fixed before the next version removes it. |
| Doctrine ORM on SQLite, a `User` entity and Foundry | No database | A micro application needs none; [WebSymfony](https://github.com/parler-haut-interagir-librement/WebSymfony) brings Doctrine. |
| Pages in English | Pages in English and in French, chosen from the browser's languages | PHIL publishes in both languages. |
| No error tracking | Sentry in the production environment, off while `SENTRY_DSN` is empty | An application in production reports its errors from its first deployment. |
| A FrankenPHP demo with `docker run` | `compose.yaml` with FrankenPHP in worker mode | One command for the production-like setup; the Symfony binary stays the light choice. |
| Deployment tasks, Apache configuration, Scrutinizer | None | A template holds no deployment: each application brings its own. |
| A procedure to downgrade to Symfony 7.4 LTS | None | PHIL supports the latest Symfony only. |
| Exit codes of the aggregate tasks summed | Exit codes reduced to 0 or 1 | A shell keeps exit codes modulo 256: a sum of 256 reads as a success. |

Besides those, the template keeps the PHIL identity: its name, its logo as the favicon and its copyright. The template
requires no PHIL package at run time: `phil/dev-tools` is a development dependency only, and the
application stays micro.

## Notes 📒

### Symfony UX

Turbo forms are disabled in [assets/app.js](assets/app.js). To enable them for a form, add the `data-turbo="true"`
attribute to it, or set `Turbo.setFormMode` to `on` to enable them everywhere. In both cases, the controller has to be
[adapted](https://symfony.com/bundles/ux-turbo/current/index.html#3-form-response-code-changes).

### YAML configuration files

The configuration of Symfony and of the bundles is in YAML, under `config/`: `config/packages/*.yaml`, with
`when@dev`, `when@test` and `when@prod` blocks for what changes by environment, `config/routes.yaml`,
`config/routes/*.yaml` and `config/services.yaml`. A Flex recipe adds its files in the same format. Only
`config/bundles.php` and `config/preload.php` stay PHP. `castor lint:yaml` checks every file of `config/`, and
`castor lint:container` checks the container they build.

```yaml
# config/packages/framework.yaml
framework:
    default_locale: en
    enabled_locales: [en, fr]
    set_locale_from_accept_language: true
```

### Languages

The pages are in English, the default locale, and in French: `config/packages/framework.yaml` enables both, and a
browser whose `Accept-Language` header prefers French gets the French pages, on the same addresses. The messages are
in [translations/](translations); a new visible text gets its key in both files.

### Sentry

In the production environment, the errors go to [Sentry](https://sentry.io) once `SENTRY_DSN` holds the DSN of your
project, set as a real environment variable or a secret, never in a committed file. While it is empty, as in `.env`,
nothing is sent. The configuration is in `config/packages/sentry.yaml`.

### A database

MicroSymfony has none. For Doctrine, start from [WebSymfony](https://github.com/parler-haut-interagir-librement/WebSymfony),
or add it with `composer require symfony/orm-pack`.

## Other good practices 👌

* Strict types in every PHP file ([source](src/Controller/SlugifyAction.php))
* The ADR pattern: one invokable action controller per route ([source](src/Controller/HomeAction.php),
  [documentation](https://symfony.com/doc/current/controller/service.html#invokable-controllers))
* The configuration in YAML, under `config/` ([source](config/packages/framework.yaml))
* A [composer.json](composer.json) normalized with [ergebnis/composer-normalize](https://github.com/ergebnis/composer-normalize)
* Each quality tool in its own `vendor-bin/<tool>/` directory, installed by the
  [composer bin plugin](https://github.com/bamarni/composer-bin-plugin)
* Tests that name what they cover, with `#[CoversClass]` or `#[CoversNothing]`

## ADR 📝

[Architecture Decision Records](https://adr.github.io/) of strangebuzz/MicroSymfony; this template keeps every one but
the one on Doctrine and the two on PHP configuration:

* [2026-01-17] Use Doctrine ORM as the default database layer ([PR](https://github.com/strangebuzz/MicroSymfony/pull/219))
* [2025-12-29] Use the new PHP configuration ([PR](https://github.com/strangebuzz/MicroSymfony/pull/197))
* [2025-01-25] Include the FrankenPHP runtime by default ([PR](https://github.com/strangebuzz/MicroSymfony/pull/54))
* [2025-01-21] Add PHPUnit test suites ([PR](https://github.com/strangebuzz/MicroSymfony/pull/155))
* [2024-12-18] Use PicoCSS instead of BareCSS as the CSS framework ([PR](https://github.com/strangebuzz/MicroSymfony/pull/85))
* [2024-12-05] Convert all configuration files to PHP (fluent interface) ([PR](https://github.com/strangebuzz/MicroSymfony/pull/129))
* [2024-09-22] Use the ADR pattern for all controllers ([PR](https://github.com/strangebuzz/MicroSymfony/pull/58))

Those of this template:

* [2026-11-25] Symfony 8.2 from its release candidate, PHP 8.5, the gates of `phil/dev-tools`, Castor only,
  FrankenPHP in worker mode in `compose.yaml`
* [2026-11-25] No database: Doctrine moves to WebSymfony; pages in English and in French; Sentry in production
* [2026-11-26] The configuration in YAML: `config/packages`, routes and services
* [2026-11-26] The common Castor tasks of `phil/dev-tools` imported by `castor.php`; the route smoke test of
  `phil/dev-tools`; every requirement at its latest minor release

## What it doesn't ship? ❌

* Doctrine and a database: start from [WebSymfony](https://github.com/parler-haut-interagir-librement/WebSymfony)
  (`phil/websymfony`), MicroSymfony with Doctrine

## PHIL bundles 🧩

The bundles of [PHIL](https://ph-il.ca) add what an application needs, one at a time, with `composer require`. A few
that suit a small application:

* [`phil/ux-kit`](https://packagist.org/packages/phil/ux-kit) and [`phil/ux-css`](https://packagist.org/packages/phil/ux-css):
  phil-ux, the components of the Symfony UX Toolkit and their styles
* [`phil/structured-data-bundle`](https://packagist.org/packages/phil/structured-data-bundle) and
  [`phil/sitemap-bundle`](https://packagist.org/packages/phil/sitemap-bundle): the JSON-LD and the sitemap of the pages
* [`phil/browser-security-bundle`](https://packagist.org/packages/phil/browser-security-bundle): the security headers
  of the responses
* [`phil/privacy-bundle`](https://packagist.org/packages/phil/privacy-bundle) and
  [`phil/legal-notices-bundle`](https://packagist.org/packages/phil/legal-notices-bundle): the consent and the legal pages
* [`phil/well-known-bundle`](https://packagist.org/packages/phil/well-known-bundle): `security.txt` and the other
  files of `/.well-known/`
* [`phil/typography-bundle`](https://packagist.org/packages/phil/typography-bundle): the typography of French and
  English texts

The [PHIL organization on GitHub](https://github.com/parler-haut-interagir-librement) lists every package.

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

## Others “Proclaim Honestly, Interact Liberally” Skeletons 🩻

* [WebSymfony](https://github.com/parler-haut-interagir-librement/WebSymfony) (`phil/websymfony`)
  * MicroSymfony +
  * A database
    * Doctrine ORM and its migrations
    * StofDoctrineExtensionsBundle
  * Still Pico CSS, with Stimulus and Turbo
  * EasyAdmin
  * KnpMenuBundle
  * Security layers
    * Symfony Security
    * NelmioSecurityBundle
    * NelmioCorsBundle
  * Sentry
  * and more.

* [WebSkeleton](https://github.com/parler-haut-interagir-librement/WebSkeleton) (`phil/webskeleton`)
  * WebSymfony +
  * The PHIL tools
    * The PHIL UX kit ([`phil/ux-kit`](https://packagist.org/packages/phil/ux-kit)) and its styles
      ([`phil/ux-css`](https://packagist.org/packages/phil/ux-css))
    * PHIL bundles, such as [`phil/doctrine-behaviours-bundle`](https://packagist.org/packages/phil/doctrine-behaviours-bundle),
      the behaviours of the Doctrine entities, and [`phil/publishing`](https://packagist.org/packages/phil/publishing),
      the publication of contents
  * Organised in DDD
  * In French and in English (`/fr`, `/en`)
  * and more.

* [ApiSymfony](https://github.com/parler-haut-interagir-librement/ApiSymfony) (`phil/apisymfony`)
  * API Platform
  * The same tasks, run by Castor
  * Static analysis with PHPStan
  * Coding standards with PHP-CS-Fixer
  * Refactoring with Rector
  * Tests: unit, API and end-to-end
  * GitHub CI
  * Symfony Maker

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

## Built with MicroSymfony 🛠️

* [WebSymfony](https://github.com/parler-haut-interagir-librement/WebSymfony), which lists what is built with it, starting with WebSkeleton.
