# Changelog

All notable changes to this template are documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/). The template follows the releases of
[strangebuzz/MicroSymfony](https://github.com/strangebuzz/MicroSymfony); its own changes are listed here.

## [Unreleased]

### Added

- The application of strangebuzz/MicroSymfony 8.1.1, up to its commit of 2026-09-02: Doctrine ORM on SQLite with a
  `User` entity, its Foundry factory and story, the list of users, the form, the slug API, the Stimulus examples, the
  custom error template and the five test suites.
- Symfony 8.2 from its first release candidate, on PHP 8.5 or later, every other dependency at its latest version.
- `composer create-project phil/micro-symfony`: the package is of type `project`.
- Tasks run by Castor only: tests by suite, coverage and its threshold, mutation testing, every lint, every fixer, the
  local continuous integration, the git hooks, the Symfony binary's server and Docker Compose. The aggregate tasks
  reduce the exit codes of their steps to 0 or 1.
- The quality gates of `phil/dev-tools`, each tool in its own `vendor-bin/` directory: PHP-CS-Fixer, PHPStan at the
  maximum level with its extensions, Rector, Arkitect, Deptrac, Twig-CS-Fixer, Biome, the dependency analysis,
  `composer audit`, composer-unused, composer-normalize, CaptainHook and Infection.
- Tests that name what they cover with `#[CoversClass]` or `#[CoversNothing]`; PHPUnit fails on a deprecation, a
  notice or a warning.
- `compose.yaml`: FrankenPHP in worker mode, with its workers restarted when a file changes, and PostgreSQL 17; MySQL
  documented as the other choice.
- An initial migration described through the DBAL schema API, which creates the user table on SQLite, PostgreSQL and
  MySQL.
- A GitHub Actions workflow: security, tests on PHP 8.5 and 8.6 with the coverage threshold, lints.
- The differences from strangebuzz/MicroSymfony, and their reasons, in the README.
