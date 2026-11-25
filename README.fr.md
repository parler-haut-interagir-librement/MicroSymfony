<!-- phil-dev source-sha256=54d274f3706c28dc24dbbad08a0125accc9bc5a8fcc662fb3da09fd1d63de0c2 -->
# MicroSymfony 🎶

[![Latest Version](https://img.shields.io/packagist/v/phil/micro-symfony.svg?style=flat-square)](https://packagist.org/packages/phil/micro-symfony)
[![PHP Version Require](https://poser.pugx.org/phil/micro-symfony/require/php?style=flat-square)](https://packagist.org/packages/phil/micro-symfony)
[![Symfony Version](https://img.shields.io/badge/Symfony-8.2-black?logo=symfony)](https://symfony.com/8)
[![Symfony Style](https://img.shields.io/badge/code%20style-symfony-black?logo=symfony)](https://symfony.com/doc/current/contributing/code/standards.html)
[![PHPStan level](https://img.shields.io/badge/PHPStan-level%20max-success?style=flat-square)](phpstan.neon)
[![Software License](https://img.shields.io/badge/License-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Build Status (GitHub)](https://img.shields.io/github/actions/workflow/status/parler-haut-interagir-librement/MicroSymfony/symfony.yml?branch=main&style=flat-square)](https://github.com/parler-haut-interagir-librement/MicroSymfony/actions?query=workflow%3ASymfony+branch%3Amain)

## À propos 🖋

MicroSymfony est un gabarit d'application [Symfony 8.2](https://symfony.com/8) survitaminé et prêt à l'emploi : un bac
à sable aux valeurs par défaut raisonnables, des tests de tous les types et des portes de qualité strictes, pour
démarrer une preuve de concept, essayer une idée ou construire une petite application.

Ce gabarit est la version PHIL de [strangebuzz/MicroSymfony](https://github.com/strangebuzz/MicroSymfony), créé et
maintenu par [COil](https://github.com/COil) de [Strangebuzz](https://www.strangebuzz.com). Il garde son nom, ses
fonctionnalités et son esprit, et suit ses versions. Ce qui diffère, et pourquoi, est listé dans
[Différences avec strangebuzz/MicroSymfony](#différences-avec-strangebuzzmicrosymfony-). L'auteur explique la
philosophie du gabarit :

* [Introducing the MicroSymfony application template](https://www.strangebuzz.com/en/blog/introducing-the-microsymfony-application-template)
* [MicroSymfony 8: ready for the LTS promise](https://www.strangebuzz.com/en/blog/microsymfony-8-ready-for-the-lts-promise)

## Table des matières 📖

* [Démarrage rapide](#démarrage-rapide-)
  * [Avec le binaire Symfony](#avec-le-binaire-symfony-)
  * [Avec FrankenPHP et PostgreSQL](#avec-frankenphp-et-postgresql-)
  * [Avec MySQL](#avec-mysql-)
* [Prérequis](#prérequis-)
* [Pile technologique](#pile-technologique-)
* [Fonctionnalités](#fonctionnalités-)
* [Tâches](#tâches-)
* [Portes de qualité](#portes-de-qualité-)
* [Différences avec strangebuzz/MicroSymfony](#différences-avec-strangebuzzmicrosymfony-)
* [Notes](#notes-)
* [ADR](#adr-)
* [Références](#références-)
* [Contribuer](#contribuer-)
* [Sécurité](#sécurité-)
* [Crédits](#crédits-)
* [Licence](#licence-)

## Démarrage rapide ⚡

Créez un nouveau projet à partir de la dernière version :

    composer create-project phil/micro-symfony my-project && cd my-project

Le dépôt est aussi un dépôt gabarit de GitHub : le bouton « Use this template » crée un nouveau dépôt à partir de la
branche principale, dont tous les commits passent l'intégration continue.

### Avec le binaire Symfony 🎶

Il vous faut le [binaire Symfony](https://symfony.com/download#step-1-install-symfony-cli) et
[Castor](https://castor.jolicode.com/getting-started/installation/). La base de données est un fichier SQLite dans
`var/` :

    castor start

Ouvrez [https://127.0.0.1:8000](https://127.0.0.1:8000) (si le port 8000 est libre). `castor stop` arrête le serveur
et supprime la base de données.

### Avec FrankenPHP et PostgreSQL 🧟

Il vous faut [Docker](https://www.docker.com/). `compose.yaml` sert l'application avec
[FrankenPHP](https://frankenphp.dev/) en mode *worker*, qui démarre le noyau une seule fois, sert requête après
requête et redémarre ses *workers* quand un fichier change ; la base de données est PostgreSQL 17 :

    castor up

Ouvrez [https://localhost](https://localhost). `castor down` arrête les services. L'image de `docker/Dockerfile` est
destinée au développement : une application déployée à partir de ce gabarit apporte son propre déploiement.

### Avec MySQL 🐬

MySQL est l'autre base de données que le gabarit prend en charge. Dans `compose.yaml`, remplacez le service
`database` par une image `mysql:8.4` et donnez à `DATABASE_URL` la valeur :

    mysql://app:app@database:3306/app?serverVersion=8.4&charset=utf8mb4

Avec le binaire Symfony, définissez la même variable dans `.env.local`, avec l'hôte de votre serveur. La migration
est écrite dans le SQL de la base de données sur laquelle elle s'exécute : elle n'a besoin d'aucun changement.

## Prérequis ⚙

* [PHP 8.5](https://www.php.net/releases/8.5/en.php) ou plus récent, avec les extensions de `composer.json`, et
  [Castor](https://castor.jolicode.com)
* Le [binaire Symfony](https://symfony.com/download), ou [Docker](https://www.docker.com)
* L'extension [Xdebug](https://xdebug.org/) ou [PCOV](https://github.com/krakjoe/pcov) pour le rapport de couverture
  de code

## Pile technologique 🔗

* [PHP 8.5](https://www.php.net/releases/8.5/en.php)
* [Symfony 8.2](https://symfony.com/8), dès sa version candidate
* [Doctrine ORM 3 (DBAL 4)](https://www.doctrine-project.org), sur SQLite, PostgreSQL ou MySQL
* [Twig 3](https://twig.symfony.com)
* [AssetMapper](https://symfony.com/doc/current/frontend/asset_mapper.html), [Stimulus 3.2](https://stimulus.hotwired.dev/) et [Turbo 8](https://turbo.hotwired.dev/), sans Node.js
* [PHPUnit 13](https://phpunit.de)
* [Pico CSS 2.1](https://picocss.com)
* [FrankenPHP](https://frankenphp.dev/) en mode *worker*, avec Docker Compose

## Fonctionnalités 🚀

* Des tâches exécutées par [Castor](https://castor.jolicode.com) ([source](castor.php), [sortie](docs/castor-output.txt))
* L'analyse statique avec [PHPStan 2](https://phpstan.org) au niveau maximal, avec les règles strictes, d'obsolescence,
  Symfony, Doctrine et PHPUnit ([configuration](phpstan.neon))
* Les standards de code avec [PHP-CS-Fixer](https://github.com/PHP-CS-Fixer/PHP-CS-Fixer), Twig-CS-Fixer et
  [Biome](https://biomejs.dev) pour les contrôleurs Stimulus
* Des tests de tous les types, avec un exemple de chacun :
  * unitaire : [StringHelperTest](tests/Unit/Helper/StringHelperTest.php)
  * intégration : [RoutingExtensionTest](tests/Integration/Twig/Extension/RoutingExtensionTest.php)
  * fonctionnel : [ComposerActionTest](tests/Functional/Controller/ComposerActionTest.php)
  * API : [SlugifyActionTest](tests/Api/Controller/SlugifyActionTest.php)
  * de bout en bout : [AppControllerTest](tests/E2E/Controller/AppControllerTest.php)
* Une couverture de code de 100 % (le seuil est une constante de `castor.php`)
* Un workflow GitHub Actions : sécurité, tests sur PHP 8.5 et 8.6, *linters*
* Doctrine avec une entité `User`, sa [fabrique](src/Factory/UserFactory.php) et son [histoire](src/Story/AppStory.php)
  pour [Foundry](https://github.com/zenstruck/foundry), et une [liste d'utilisateurs](src/Controller/ListUsersAction.php)
* AssetMapper et Stimulus : un contrôleur standard ([source](assets/controllers/hello_controller.js)) et un autre qui
  récupère du JSON auprès d'un point de terminaison de l'application ([source](assets/controllers/api_controller.js))
* Un gabarit d'erreur personnalisé ([source](templates/bundles/TwigBundle/Exception/error.html.twig))

## Tâches 🧰

`castor` liste toutes les tâches. Les principales :

| Tâche | Ce qu'elle fait |
|---|---|
| `castor start`, `castor stop` | Le serveur Web du binaire Symfony avec SQLite, ses migrations et ses jeux de données d'essai. |
| `castor up`, `castor down` | FrankenPHP en mode *worker* et PostgreSQL, avec Docker Compose. |
| `castor load-fixtures` | La base de données SQLite remise à zéro, migrée et remplie. |
| `castor test` | Toutes les suites PHPUnit ; `--filter` et `--options` sont transmis à PHPUnit. |
| `castor test:unit`, `test:integration`, `test:api`, `test:functional`, `test:e2e` | Une seule suite. |
| `castor test:next` | Les tests sur la prochaine version de PHP, dans son image Docker. |
| `castor coverage` | Le rapport de couverture HTML dans `var/coverage/`, et son seuil. |
| `castor infection` | Les tests de mutation. |
| `castor lint` | Tous les *linters* et l'analyse statique. |
| `castor fix` | Rector, PHP-CS-Fixer, Twig-CS-Fixer, Biome et composer-normalize. |
| `castor ci` | L'intégration continue, en local : la couverture, puis tous les *linters*. |
| `castor hooks` | Les crochets git : les vérifications rapides sur les fichiers indexés avant chaque commit. |

## Portes de qualité 🚦

Les vérifications viennent de [`phil/dev-tools`](https://packagist.org/packages/phil/dev-tools), l'outillage commun de
PHIL, adapté à une application. Chaque outil est installé dans son propre répertoire `vendor-bin/<tool>/` par le
[plugin Composer bin](https://github.com/bamarni/composer-bin-plugin), pour que ses dépendances ne croisent jamais
celles de l'application. Les fichiers de configuration minces à la racine (`phpstan.neon`, `rector.php`,
`.php-cs-fixer.dist.php`, `arkitect.php`) appellent les fichiers communs ; `phil-dev.php` contient ce qui est propre à
l'application, chaque exception avec sa raison.

| Tâche | Vérifie |
|---|---|
| `castor lint:composer` | L'analyse des dépendances (une classe utilisée sans que son paquet soit requis), `composer audit`, composer-unused et composer-normalize. |
| `castor lint:php` | PHP-CS-Fixer : `@Symfony`, `@Symfony:risky`, types stricts et comparaisons strictes. |
| `castor lint:twig` | `lint:twig`, puis le style de code des gabarits. |
| `castor lint:js` | Biome sur les contrôleurs Stimulus. |
| `castor lint:yaml`, `lint:container`, `lint:doctrine` | Les fichiers YAML, le conteneur et le mappage Doctrine. |
| `castor stan` | PHPStan au niveau maximal, avec une couverture des types de 100 %, une limite de complexité cognitive et des appels interdits. |
| `castor lint:rector` | Rector n'a plus rien à changer. |
| `castor lint:architecture` | Arkitect sur la forme des classes ; Deptrac sur les bibliothèques que `src/` peut utiliser, listées dans `phil-dev.php`. |

## Différences avec strangebuzz/MicroSymfony 🔀

Ce gabarit suit les versions de [strangebuzz/MicroSymfony](https://github.com/strangebuzz/MicroSymfony). Il diffère là
où les principes de PHIL l'exigent :

| strangebuzz/MicroSymfony | Ce gabarit | Pourquoi |
|---|---|---|
| La dernière version stable de Symfony (8.1) | Symfony 8.2 dès sa première version candidate, `minimum-stability` à `beta` | PHIL teste la prochaine version de Symfony dès que sa version candidate est publiée. Symfony n'étiquette que les composants qui ont changé depuis la dernière bêta : `beta` est donc la plus basse stabilité qui installe 8.2.0-RC1 ; `prefer-stable` prend d'abord les versions stables. |
| PHP 8.4 ou plus récent | PHP 8.5 ou plus récent | Le plancher de tous les paquets et gabarits PHIL ; l'intégration continue exécute aussi la prochaine version de PHP. |
| Make et Castor | Castor seulement, aucun script de tâche dans `composer.json` | Un seul exécuteur de tâches, écrit en PHP ; Composer reste un gestionnaire de dépendances. |
| PHPStan et PHP-CS-Fixer, Biome par un bundle | Les portes de `phil/dev-tools` : PHPStan avec ses extensions, Rector, Arkitect, Deptrac, Twig-CS-Fixer, Biome, l'analyse des dépendances, composer-unused, composer-normalize, CaptainHook, Infection | Les vérifications que passe chaque dépôt PHIL, pour qu'une application démarre au même niveau d'exigence. |
| Tests PHPUnit, métadonnées de couverture facultatives | `#[CoversClass]` ou `#[CoversNothing]` obligatoire, les dépréciations, avis et avertissements font échouer les tests | La couverture ne compte que ce qu'un test vise à tester, et une dépréciation est corrigée avant que la prochaine version la retire. |
| Une migration initiale propre à SQLite | La même migration décrite par l'API de schéma de DBAL, écrite dans le SQL de la plateforme | Le gabarit fonctionne sur SQLite, PostgreSQL et MySQL. |
| Une démo FrankenPHP avec `docker run` | `compose.yaml` avec FrankenPHP en mode *worker* et PostgreSQL | Une seule commande pour l'installation proche de la production ; le binaire Symfony avec SQLite reste le choix léger. |
| Tâches de déploiement, configuration Apache, Scrutinizer | Aucun | Un gabarit ne contient aucun déploiement : chaque application apporte le sien. |
| Une procédure pour revenir à Symfony 7.4 LTS | Aucune | PHIL ne prend en charge que la dernière version de Symfony. |
| Dates typées `DateTimeInterface` | `DateTimeImmutable`, définies par le constructeur | Correspond au mappage `datetime_immutable` et ne laisse aucune propriété non initialisée. |
| Codes de sortie des tâches agrégées additionnés | Codes de sortie réduits à 0 ou 1 | Un interpréteur de commandes garde les codes de sortie modulo 256 : une somme de 256 se lit comme un succès. |

Le gabarit ne requiert aucun paquet PHIL à l'exécution : `phil/dev-tools` est une dépendance de développement
seulement, et l'application reste micro.

## Notes 📒

### Symfony UX

Les formulaires Turbo sont désactivés dans [assets/app.js](assets/app.js). Pour les activer pour un formulaire,
ajoutez-lui l'attribut `data-turbo="true"`, ou donnez à `Turbo.setFormMode` la valeur `on` pour les activer partout.
Dans les deux cas, le contrôleur doit être
[adapté](https://symfony.com/bundles/ux-turbo/current/index.html#3-form-response-code-changes).

### Fichiers de configuration PHP

Une recette Flex peut ajouter des fichiers YAML au projet. Ils sont chargés tels quels ; pour les convertir en PHP,
suivez les autres fichiers de `config/packages`.

### Sans Doctrine

[`agents/remove-doctrine.md`](agents/remove-doctrine.md) liste les étapes qui retirent Doctrine, pour une application
qui n'a besoin d'aucune base de données.

## ADR 📝

[Architecture Decision Records](https://adr.github.io/) de strangebuzz/MicroSymfony, que ce gabarit conserve :

* [2026-01-17] Use Doctrine ORM as the default database layer ([PR](https://github.com/strangebuzz/MicroSymfony/pull/219))
* [2025-12-29] Use the new PHP configuration ([PR](https://github.com/strangebuzz/MicroSymfony/pull/197))
* [2025-01-25] Include the FrankenPHP runtime by default ([PR](https://github.com/strangebuzz/MicroSymfony/pull/54))
* [2025-01-21] Add PHPUnit test suites ([PR](https://github.com/strangebuzz/MicroSymfony/pull/155))
* [2024-12-18] Use PicoCSS instead of BareCSS as the CSS framework ([PR](https://github.com/strangebuzz/MicroSymfony/pull/85))
* [2024-12-05] Convert all configuration files to PHP (fluent interface) ([PR](https://github.com/strangebuzz/MicroSymfony/pull/129))
* [2024-09-22] Use the ADR pattern for all controllers ([PR](https://github.com/strangebuzz/MicroSymfony/pull/58))

Ceux de ce gabarit :

* [2026-11-25] Symfony 8.2 dès sa version candidate, PHP 8.5, les portes de `phil/dev-tools`, Castor seulement,
  FrankenPHP en mode *worker* avec PostgreSQL dans `compose.yaml`

## Références 📚

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

## Contribuer 🤝

Voir [CONTRIBUTING](CONTRIBUTING.md) et le [Code de conduite](CODE_OF_CONDUCT.md).

## Sécurité 🧯

Voir [SECURITY](SECURITY.md).

## Crédits 🙏

* [COil](https://github.com/COil), auteur de [strangebuzz/MicroSymfony](https://github.com/strangebuzz/MicroSymfony),
  et [ses contributeurs](https://github.com/strangebuzz/MicroSymfony/graphs/contributors)
* [Philippe Gamache](https://ph-il.ca), mainteneur de ce gabarit, pour
  [Parler Haut, Interagir Librement](https://ph-il.ca)

## Licence ⚖️

The MIT License, avec l'attribution au dépôt d'origine qu'elle demande. Voir le [fichier de licence](LICENSE).
