# Contributing to MicroSymfony

Thank you for contributing. This guide covers this template, `phil/micro-symfony`. A change that would also suit
[strangebuzz/MicroSymfony](https://github.com/strangebuzz/MicroSymfony), the template it follows, is welcome there
too: see its own contributing guide.

## Reporting a bug

Before reporting a bug, read the [README](README.md) and check that the bug is not
[already reported](https://github.com/parler-haut-interagir-librement/MicroSymfony/issues?q=is%3Aopen+is%3Aissue+label%3Abug).
Then open an issue with a title that sums it up and the steps that reproduce it, with your operating system, your PHP
version and its extensions.

A security issue is never reported in a public issue: see [SECURITY.md](SECURITY.md).

## Pull requests

Base your changes on the `main` branch, then run the checks with [Castor](https://castor.jolicode.com):

```bash
castor hooks   # once: the fast checks on the staged files before each commit
castor fix     # Rector, PHP-CS-Fixer, Twig-CS-Fixer, Biome and composer-normalize
castor ci      # the tests with their coverage threshold, then every lint and the static analysis
```

A pull request:

- adds tests for what it changes, each naming what it covers with `#[CoversClass]` or `#[CoversNothing]`; the
  [smoke tests](tests/Functional/Controller/StaticRoutesSmokeTest.php) already request every route;
- keeps `castor ci` green, the coverage at its threshold and PHPStan at the maximum level without a new exception;
- documents what it changes in the README and in the `Unreleased` section of the [CHANGELOG](CHANGELOG.md);
- holds only the commits of its change.

## Licence

By opening a pull request, you agree to license your contribution under the [licence of the project](LICENSE). If
you include code from another project, name it in the pull request and credit its author.
