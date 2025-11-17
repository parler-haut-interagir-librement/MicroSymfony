# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

### Added

- Nothing of notes

### Changed

- Nothing of notes

### Deprecated

- Nothing of notes

### Removed

- Nothing of notes

### Fixed

- Nothing of notes

### Security

- N/A


## [7.3.1] - 2025-11-16

### Changed

- Upgrade Symfony to 7.3.7
- CODE_OF_CONDUCT.md now in version 3.0

### Removed

- roave/security-advisories. Use Composer 2.9

### Fixed

- Castor.php for Castor v1
- Fix Rector Configuration for version 2.2
- Update Code to follow PHP 8.4 and Symfony 7.3 using Rector
- Clean Code using cs-fixer
- Fixed missing tests


## [7.3.0] - 2025-11-16

### Added

- CODE_OF_CONDUCT.md
- CONTRIBUTING.md
- LICENSE
- Badges in README.md
- Security Policy
- Bug Report Template
- GitHub templates
- Darkmode in template
- Contrib.rocks image
- Article reference
- Sentry Bundle
- Maker Bundle
- Binome Bundle
- Scrutinizer-ci
- Scrutinizer coverage report link
- FrankenPHP runtime
- Psalm
- Favicon

### Changed

- Upgrade Symfony to 7.3.4
- Upgrade Castor to 1.0
- Upgrade league/CommonMark to 2.7.1
- Upgrade PHPStan to 2.0
- Upgrade Rector to 2.2
- Upgrade Twig to 3.22
- Upgrade Stimulus To 2.31
- Upgrade Turbo To 2.31
- Test use ADR controller class FQCN as route name
- Update the Features section in README.md
- Update PHPStan configuration
- Clean and upgrade README.md
- Correct typos in README.md
- Better layout
- Better configs

### Removed

- Trademark sign previously shown after the project description in version
  0.3.0


## [7.0.1] - 2024-02-24

### Changed

- Upgrade Symfony to 7.0.4

### Fixed

- Fix CI Workflow
- Fix PHPUnit 11 change in php-cs-fixer


## [7.0.0] - 2024-02-24

Now the major and minor version is sync with the symfony major and minor version

### Added

- Add symfony/requirements-checker 2.0
- Add bamarni/composer-bin-plugin
- Add many functions to Castor

### Changed

- Upgrade requirement to PHP 8.3
- Upgrade Symfony to 7.0
- Upgrade Twig to 3.8
- Upgrade PHPUnit to 11
- Upgrade Castor to 0.13
- Upgrade to Rector to 1.0
- Upgrade Symfony Maker to 1.55
- Move PHP CS Fixer to use bamarni/composer-bin-plugin
- Better .gitignore
- More pleasing configurations for PHP CS Fixer
- More pleasing configurations for Rector
 
### Removed

- No more Annotations, all in Attributes


## [0.2.0] - 2023-11-16

### Added

- Add symfony/panther
- Add symfony/var-dumper

### Changed

- Upgrade to Symfony 6.3.8
- Update Rector Config
- Rename phpstan.neon (for local only) to phpstan.dist.neon
- Upgrade Flex to 2.4.1
- Upgrade MonologBundle to 3.10.0
- Upgrade StimulusBundle to 2.13.2
- Upgrade PhpCsFixer to 3.38.2

### Fixed

- Fix Others Skeletons Sections in README.md
- Fix Demo URLs in README.md


## [0.1.2] - 2023-09-19

### Fixed

- Fix Others Skeletons Sections in README.md
- Fix Demo URLs in README.md


## [0.1.1] - 2023-09-14

### Fixed

- Fix texts in README.md
- Fix URLs in README.md


## [0.1.0] - 2023-09-13

First beta release
