# Changelog

All notable changes to this template are documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/). The template follows the releases of
[strangebuzz/MicroSymfony](https://github.com/strangebuzz/MicroSymfony); its own changes are listed here.

## [Unreleased]

### Added

- The application of strangebuzz/MicroSymfony 8.1.1, up to its commit of 2026-09-02, without a database: the form,
  the slug API, the Stimulus examples, the custom error template and the five test suites. Doctrine comes with
  WebSymfony.
- Symfony 8.2 from its first release candidate, on PHP 8.5 or later, every other dependency at its latest version.
- `composer create-project phil/microsymfony`: the package is of type `project`.
- Tasks run by Castor only: tests by suite, coverage and its threshold, mutation testing, every lint, every fixer, the
  local continuous integration, the git hooks, the Symfony binary's server and Docker Compose. The aggregate tasks
  reduce the exit codes of their steps to 0 or 1.
- The quality gates of `phil/dev-tools`, each tool in its own `vendor-bin/` directory: PHP-CS-Fixer, PHPStan at the
  maximum level with its extensions, Rector, Arkitect, Deptrac, Twig-CS-Fixer, Biome, the dependency analysis,
  `composer audit`, composer-unused, composer-normalize, CaptainHook and Infection.
- Tests that name what they cover with `#[CoversClass]` or `#[CoversNothing]`; PHPUnit fails on a deprecation, a
  notice or a warning.
- `compose.yaml`: FrankenPHP in worker mode, with its workers restarted when a file changes.
- A GitHub Actions workflow: security, tests on PHP 8.5 and 8.6 with the coverage threshold, lints.
- The differences from strangebuzz/MicroSymfony, and their reasons, in the README.
- The package name `phil/microsymfony`, the one published on Packagist.
- Pages in English and in French: the layout, the menu, the footer and the home page read their texts from
  `translations/messages.en.yaml` and `messages.fr.yaml`, the locale comes from the browser's `Accept-Language`
  header on the same addresses, and the home page shows `README.md` or `README.fr.md`.
- The PHIL identity: the name in the header, the title and the footer version line, the PHIL logo as the favicon, the
  copyright linked to ph-il.ca, beside the credit to Strangebuzz.
- Sentry in the production environment, with `sentry/sentry-symfony`: the DSN comes from `SENTRY_DSN`, empty in `.env`
  so that nothing is sent until it is set.
- `tests/Integration/ContainerTest.php`: every service of `src/` is built from the container.
- `castor taint`: the taint analysis of Psalm from `phil/dev-tools`, in its own `vendor-bin/psalm/`.
- The security files of `phil/dev-tools` in `.github/`: Dependabot with a cooldown of seven days, the OpenSSF
  Scorecard and zizmor; the actions of every workflow pinned to a commit, the checkout without credentials.
- In the README and its French mirror: the live demo on ph-il.ca, the other good practices, what the template does not
  ship, the PHIL bundles a small application can add, the other PHIL templates (WebSymfony, WebSkeleton, ApiSymfony)
  and what is built with MicroSymfony.
