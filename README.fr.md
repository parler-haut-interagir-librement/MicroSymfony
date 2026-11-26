<!-- phil-dev source-sha256=a113b00c3977e941ebd3813a21a7160d5da69624a1a2ebc9e31d3b5fa700c756 -->
# MicroSymfony 🎶

[![Latest Version](https://img.shields.io/packagist/v/phil/microsymfony.svg?style=flat-square)](https://packagist.org/packages/phil/microsymfony)
[![PHP Version Require](https://poser.pugx.org/phil/microsymfony/require/php?style=flat-square)](https://packagist.org/packages/phil/microsymfony)
[![Symfony Version](https://img.shields.io/badge/Symfony-8.2-black?logo=symfony)](https://symfony.com/8)
[![Symfony Style](https://img.shields.io/badge/code%20style-symfony-black?logo=symfony)](https://symfony.com/doc/current/contributing/code/standards.html)
[![PHPStan level](https://img.shields.io/badge/PHPStan-level%20max-success?style=flat-square)](phpstan.neon)
[![Software License](https://img.shields.io/badge/License-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Build Status (GitHub)](https://img.shields.io/github/actions/workflow/status/parler-haut-interagir-librement/MicroSymfony/symfony.yml?branch=main&style=flat-square)](https://github.com/parler-haut-interagir-librement/MicroSymfony/actions?query=workflow%3ASymfony+branch%3Amain)

## À propos 🖋

MicroSymfony est un gabarit d'application [Symfony 8.2](https://symfony.com/8) survitaminé et prêt à l'emploi : un bac
à sable aux valeurs par défaut raisonnables, des tests de tous les types et des portes de qualité strictes, pour
démarrer une preuve de concept, essayer une idée ou construire une petite application. Il reste micro : aucune base de données, des pages en anglais et en français, et
rien dont une petite application n'a pas besoin. Doctrine vient avec
[WebSymfony](https://github.com/parler-haut-interagir-librement/WebSymfony), le gabarit suivant.

Ce gabarit est la version PHIL de [strangebuzz/MicroSymfony](https://github.com/strangebuzz/MicroSymfony), créé et
maintenu par [COil](https://github.com/COil) de [Strangebuzz](https://www.strangebuzz.com). Il garde son nom, ses
fonctionnalités et son esprit, et suit ses versions. Ce qui diffère, et pourquoi, est listé dans
[Différences avec strangebuzz/MicroSymfony](#différences-avec-strangebuzzmicrosymfony-). L'auteur explique la
philosophie du gabarit :

* [Introducing the MicroSymfony application template](https://www.strangebuzz.com/en/blog/introducing-the-microsymfony-application-template)
* [MicroSymfony 8: ready for the LTS promise](https://www.strangebuzz.com/en/blog/microsymfony-8-ready-for-the-lts-promise)

## Table des matières 📖

* [Démo](#démo-)
* [Démarrage rapide](#démarrage-rapide-)
  * [Avec le binaire Symfony](#avec-le-binaire-symfony-)
  * [Avec FrankenPHP](#avec-frankenphp-)
* [Prérequis](#prérequis-)
* [Pile technologique](#pile-technologique-)
* [Fonctionnalités](#fonctionnalités-)
* [Tâches](#tâches-)
* [Portes de qualité](#portes-de-qualité-)
* [Différences avec strangebuzz/MicroSymfony](#différences-avec-strangebuzzmicrosymfony-)
* [Notes](#notes-)
* [Autres bonnes pratiques](#autres-bonnes-pratiques-)
* [ADR](#adr-)
* [Ce qu'il ne contient pas](#ce-quil-ne-contient-pas-)
* [Bundles PHIL](#bundles-phil-)
* [Références](#références-)
* [Autres gabarits « Parler Haut, Interagir Librement »](#autres-gabarits--parler-haut-interagir-librement--)
* [Contribuer](#contribuer-)
* [Sécurité](#sécurité-)
* [Crédits](#crédits-)
* [Licence](#licence-)
* [Construit avec MicroSymfony](#construit-avec-microsymfony-)

## Démo 🌈

Une démo en ligne vaut mieux que toutes les explications :

* la démo en ligne sera à [https://ph-il.ca/demos/microsymfony](https://ph-il.ca/demos/microsymfony) ;
* celle servie par [FrankenPHP](https://frankenphp.dev/) en mode *worker* sera à
  [https://ph-il.ca/demos/frankenphp/microsymfony](https://ph-il.ca/demos/frankenphp/microsymfony).

## Démarrage rapide ⚡

Créez un nouveau projet à partir de la dernière version :

    composer create-project phil/microsymfony my-project && cd my-project

Le dépôt est aussi un dépôt gabarit de GitHub : le bouton « Use this template » crée un nouveau dépôt à partir de la
branche principale, dont tous les commits passent l'intégration continue.

### Avec le binaire Symfony 🎶

Il vous faut le [binaire Symfony](https://symfony.com/download#step-1-install-symfony-cli) et
[Castor](https://castor.jolicode.com/getting-started/installation/) :

    castor start

Ouvrez [https://127.0.0.1:8000](https://127.0.0.1:8000) (si le port 8000 est libre). `castor stop` arrête le serveur.

### Avec FrankenPHP 🧟

Il vous faut [Docker](https://www.docker.com/). `compose.yaml` sert l'application avec
[FrankenPHP](https://frankenphp.dev/) en mode *worker*, qui démarre le noyau une seule fois, sert requête après
requête et redémarre ses *workers* quand un fichier change :

    castor up

Ouvrez [https://localhost](https://localhost). `castor down` arrête le service. L'image de `docker/Dockerfile` est
destinée au développement : une application déployée à partir de ce gabarit apporte son propre déploiement.

## Prérequis ⚙

* [PHP 8.5](https://www.php.net/releases/8.5/en.php) ou plus récent, avec les extensions de `composer.json`, et
  [Castor](https://castor.jolicode.com)
* Le [binaire Symfony](https://symfony.com/download), ou [Docker](https://www.docker.com)
* L'extension [Xdebug](https://xdebug.org/) ou [PCOV](https://github.com/krakjoe/pcov) pour le rapport de couverture
  de code

## Pile technologique 🔗

* [PHP 8.5](https://www.php.net/releases/8.5/en.php)
* [Symfony 8.2](https://symfony.com/8), dès sa version candidate
* [Twig 3](https://twig.symfony.com), avec les pages en anglais et en français
* [Sentry](https://docs.sentry.io/platforms/php/guides/symfony/) pour les erreurs de l'environnement de production
* [AssetMapper](https://symfony.com/doc/current/frontend/asset_mapper.html), [Stimulus 3.2](https://stimulus.hotwired.dev/) et [Turbo 8](https://turbo.hotwired.dev/), sans Node.js
* [PHPUnit 13](https://phpunit.de)
* [Pico CSS 2.1](https://picocss.com)
* [FrankenPHP](https://frankenphp.dev/) en mode *worker*, avec Docker Compose

## Fonctionnalités 🚀

* Des tâches exécutées par [Castor](https://castor.jolicode.com) ([source](castor.php), [sortie](docs/castor-output.txt))
* L'analyse statique avec [PHPStan 2](https://phpstan.org) au niveau maximal, avec les règles strictes, d'obsolescence,
  Symfony et PHPUnit ([configuration](phpstan.neon))
* Les standards de code avec [PHP-CS-Fixer](https://github.com/PHP-CS-Fixer/PHP-CS-Fixer), Twig-CS-Fixer et
  [Biome](https://biomejs.dev) pour les contrôleurs Stimulus
* Des tests de tous les types, avec un exemple de chacun :
  * unitaire : [StringHelperTest](tests/Unit/Helper/StringHelperTest.php)
  * intégration : [RoutingExtensionTest](tests/Integration/Twig/Extension/RoutingExtensionTest.php), et
    [ContainerTest](tests/Integration/ContainerTest.php), qui construit chaque service de `src/`
  * fonctionnel : [ComposerActionTest](tests/Functional/Controller/ComposerActionTest.php)
  * API : [SlugifyActionTest](tests/Api/Controller/SlugifyActionTest.php)
  * de bout en bout : [AppControllerTest](tests/E2E/Controller/AppControllerTest.php)
* Une couverture de code de 100 % (le seuil est une constante de `castor.php`)
* Un workflow GitHub Actions : sécurité, tests sur PHP 8.5 et 8.6, *linters*
* Des pages en anglais et en français : la mise en page, le menu et le pied de page lisent leurs textes dans
  [translations/](translations), et la page d'accueil affiche le README de la langue que préfère le navigateur
* AssetMapper et Stimulus : un contrôleur standard ([source](assets/controllers/hello_controller.js)) et un autre qui
  récupère du JSON auprès d'un point de terminaison de l'application ([source](assets/controllers/api_controller.js))
* Un gabarit d'erreur personnalisé ([source](templates/bundles/TwigBundle/Exception/error.html.twig))

## Tâches 🧰

`castor` liste toutes les tâches. Les principales :

| Tâche | Ce qu'elle fait |
|---|---|
| `castor start`, `castor stop` | Le serveur Web du binaire Symfony. |
| `castor up`, `castor down` | FrankenPHP en mode *worker*, avec Docker Compose. |
| `castor test` | Toutes les suites PHPUnit ; `--filter` et `--options` sont transmis à PHPUnit. |
| `castor test:unit`, `test:integration`, `test:api`, `test:functional`, `test:e2e` | Une seule suite. |
| `castor test:next` | Les tests sur la prochaine version de PHP, dans son image Docker. |
| `castor coverage` | Le rapport de couverture HTML dans `var/coverage/`, et son seuil. |
| `castor infection` | Les tests de mutation. |
| `castor taint` | L'analyse de contamination de Psalm. |
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
| `castor lint:yaml`, `lint:container` | Les fichiers YAML, messages compris, et le conteneur. |
| `castor stan` | PHPStan au niveau maximal, avec une couverture des types de 100 %, une limite de complexité cognitive et des appels interdits. |
| `castor lint:rector` | Rector n'a plus rien à changer. |
| `castor lint:architecture` | Arkitect sur la forme des classes ; Deptrac sur les bibliothèques que `src/` peut utiliser, listées dans `phil-dev.php`. |

L'analyse de contamination de Psalm, `castor taint`, s'exécute à part, avant une version et chaque semaine : elle suit
ce qui vient d'une requête, d'un fichier ou de l'environnement jusqu'à une page HTML, un interpréteur de commandes, un
chemin de fichier ou `unserialize()`. Le répertoire `.github/` contient aussi les fichiers de sécurité de
`phil/dev-tools` : Dependabot, avec un délai de sept jours, l'OpenSSF Scorecard et zizmor, qui audite les workflows.

## Différences avec strangebuzz/MicroSymfony 🔀

Ce gabarit suit les versions de [strangebuzz/MicroSymfony](https://github.com/strangebuzz/MicroSymfony). Il diffère là
où les principes de PHIL l'exigent :

| strangebuzz/MicroSymfony | Ce gabarit | Pourquoi |
|---|---|---|
| La dernière version stable de Symfony (8.1) | Symfony 8.2 dès sa première version candidate, `minimum-stability` à `beta` | PHIL teste la prochaine version de Symfony dès que sa version candidate est publiée. Symfony n'étiquette que les composants qui ont changé depuis la dernière bêta : `beta` est donc la plus basse stabilité qui installe 8.2.0-RC1 ; `prefer-stable` prend d'abord les versions stables. |
| PHP 8.4 ou plus récent | PHP 8.5 ou plus récent | Le plancher de tous les paquets et gabarits PHIL ; l'intégration continue exécute aussi la prochaine version de PHP. |
| La configuration en PHP, avec les formes de tableaux de `App::config()` | La configuration en YAML : `config/packages`, routes et services | Le format de la documentation de Symfony et des recettes Flex, avec des blocs `when@env` ; `config/bundles.php` et `config/preload.php` restent en PHP. |
| Make et Castor | Castor seulement, aucun script de tâche dans `composer.json` | Un seul exécuteur de tâches, écrit en PHP ; Composer reste un gestionnaire de dépendances. |
| PHPStan et PHP-CS-Fixer, Biome par un bundle | Les portes de `phil/dev-tools` : PHPStan avec ses extensions, Rector, Arkitect, Deptrac, Twig-CS-Fixer, Biome, l'analyse des dépendances, composer-unused, composer-normalize, CaptainHook, Infection | Les vérifications que passe chaque dépôt PHIL, pour qu'une application démarre au même niveau d'exigence. |
| Tests PHPUnit, métadonnées de couverture facultatives | `#[CoversClass]` ou `#[CoversNothing]` obligatoire, les dépréciations, avis et avertissements font échouer les tests | La couverture ne compte que ce qu'un test vise à tester, et une dépréciation est corrigée avant que la prochaine version la retire. |
| Doctrine ORM sur SQLite, une entité `User` et Foundry | Aucune base de données | Une application micro n'en a pas besoin ; [WebSymfony](https://github.com/parler-haut-interagir-librement/WebSymfony) apporte Doctrine. |
| Des pages en anglais | Des pages en anglais et en français, choisies d'après les langues du navigateur | PHIL publie dans les deux langues. |
| Aucun suivi des erreurs | Sentry dans l'environnement de production, inactif tant que `SENTRY_DSN` est vide | Une application en production signale ses erreurs dès son premier déploiement. |
| Une démo FrankenPHP avec `docker run` | `compose.yaml` avec FrankenPHP en mode *worker* | Une seule commande pour l'installation proche de la production ; le binaire Symfony reste le choix léger. |
| Tâches de déploiement, configuration Apache, Scrutinizer | Aucun | Un gabarit ne contient aucun déploiement : chaque application apporte le sien. |
| Une procédure pour revenir à Symfony 7.4 LTS | Aucune | PHIL ne prend en charge que la dernière version de Symfony. |
| Codes de sortie des tâches agrégées additionnés | Codes de sortie réduits à 0 ou 1 | Un interpréteur de commandes garde les codes de sortie modulo 256 : une somme de 256 se lit comme un succès. |

En plus de celles-là, le gabarit garde l'identité de PHIL : son nom, son logo comme icône du site et son droit
d'auteur. Le gabarit ne requiert aucun paquet PHIL à l'exécution : `phil/dev-tools` est une dépendance de développement
seulement, et l'application reste micro.

## Notes 📒

### Symfony UX

Les formulaires Turbo sont désactivés dans [assets/app.js](assets/app.js). Pour les activer pour un formulaire,
ajoutez-lui l'attribut `data-turbo="true"`, ou donnez à `Turbo.setFormMode` la valeur `on` pour les activer partout.
Dans les deux cas, le contrôleur doit être
[adapté](https://symfony.com/bundles/ux-turbo/current/index.html#3-form-response-code-changes).

### Fichiers de configuration YAML

La configuration de Symfony et des bundles est en YAML, sous `config/` : `config/packages/*.yaml`, avec des blocs
`when@dev`, `when@test` et `when@prod` pour ce qui change selon l'environnement, `config/routes.yaml`,
`config/routes/*.yaml` et `config/services.yaml`. Une recette Flex ajoute ses fichiers dans le même format. Seuls
`config/bundles.php` et `config/preload.php` restent en PHP. `castor lint:yaml` vérifie chaque fichier de `config/`, et
`castor lint:container` vérifie le conteneur qu'ils construisent.

```yaml
# config/packages/framework.yaml
framework:
    default_locale: en
    enabled_locales: [en, fr]
    set_locale_from_accept_language: true
```

### Langues

Les pages sont en anglais, la locale par défaut, et en français : `config/packages/framework.yaml` active les deux, et un
navigateur dont l'en-tête `Accept-Language` préfère le français reçoit les pages en français, aux mêmes adresses. Les
messages sont dans [translations/](translations) ; un nouveau texte visible reçoit sa clé dans les deux fichiers.

### Sentry

Dans l'environnement de production, les erreurs vont à [Sentry](https://sentry.io) dès que `SENTRY_DSN` contient le
DSN de votre projet, défini comme une vraie variable d'environnement ou un secret, jamais dans un fichier commité. Tant
qu'elle est vide, comme dans `.env`, rien n'est envoyé. La configuration est dans `config/packages/sentry.yaml`.

### Une base de données

MicroSymfony n'en a pas. Pour Doctrine, partez de
[WebSymfony](https://github.com/parler-haut-interagir-librement/WebSymfony), ou ajoutez-le avec
`composer require symfony/orm-pack`.

## Autres bonnes pratiques 👌

* Des types stricts dans chaque fichier PHP ([source](src/Controller/SlugifyAction.php))
* Le patron ADR : un contrôleur d'action invocable par route ([source](src/Controller/HomeAction.php),
  [documentation](https://symfony.com/doc/current/controller/service.html#invokable-controllers))
* La configuration en YAML, sous `config/` ([source](config/packages/framework.yaml))
* Un [composer.json](composer.json) normalisé par [ergebnis/composer-normalize](https://github.com/ergebnis/composer-normalize)
* Chaque outil de qualité dans son propre répertoire `vendor-bin/<tool>/`, installé par le
  [plugin Composer bin](https://github.com/bamarni/composer-bin-plugin)
* Des tests qui nomment ce qu'ils couvrent, avec `#[CoversClass]` ou `#[CoversNothing]`

## ADR 📝

[Architecture Decision Records](https://adr.github.io/) de strangebuzz/MicroSymfony ; ce gabarit les conserve tous
sauf celui sur Doctrine et les deux sur la configuration en PHP :

* [2026-01-17] Use Doctrine ORM as the default database layer ([PR](https://github.com/strangebuzz/MicroSymfony/pull/219))
* [2025-12-29] Use the new PHP configuration ([PR](https://github.com/strangebuzz/MicroSymfony/pull/197))
* [2025-01-25] Include the FrankenPHP runtime by default ([PR](https://github.com/strangebuzz/MicroSymfony/pull/54))
* [2025-01-21] Add PHPUnit test suites ([PR](https://github.com/strangebuzz/MicroSymfony/pull/155))
* [2024-12-18] Use PicoCSS instead of BareCSS as the CSS framework ([PR](https://github.com/strangebuzz/MicroSymfony/pull/85))
* [2024-12-05] Convert all configuration files to PHP (fluent interface) ([PR](https://github.com/strangebuzz/MicroSymfony/pull/129))
* [2024-09-22] Use the ADR pattern for all controllers ([PR](https://github.com/strangebuzz/MicroSymfony/pull/58))

Ceux de ce gabarit :

* [2026-11-25] Symfony 8.2 dès sa version candidate, PHP 8.5, les portes de `phil/dev-tools`, Castor seulement,
  FrankenPHP en mode *worker* dans `compose.yaml`
* [2026-11-25] Aucune base de données : Doctrine passe à WebSymfony ; des pages en anglais et en français ; Sentry en
  production
* [2026-11-26] La configuration en YAML : `config/packages`, routes et services

## Ce qu'il ne contient pas ❌

* Doctrine et une base de données : partez de [WebSymfony](https://github.com/parler-haut-interagir-librement/WebSymfony)
  (`phil/websymfony`), MicroSymfony avec Doctrine

## Bundles PHIL 🧩

Les bundles de [PHIL](https://ph-il.ca) ajoutent ce dont une application a besoin, un à la fois, avec
`composer require`. Quelques-uns qui conviennent à une petite application :

* [`phil/ux-kit`](https://packagist.org/packages/phil/ux-kit) et [`phil/ux-css`](https://packagist.org/packages/phil/ux-css) :
  phil-ux, les composants du Symfony UX Toolkit et leurs styles
* [`phil/structured-data-bundle`](https://packagist.org/packages/phil/structured-data-bundle) et
  [`phil/sitemap-bundle`](https://packagist.org/packages/phil/sitemap-bundle) : le JSON-LD et le plan du site des pages
* [`phil/browser-security-bundle`](https://packagist.org/packages/phil/browser-security-bundle) : les en-têtes de
  sécurité des réponses
* [`phil/privacy-bundle`](https://packagist.org/packages/phil/privacy-bundle) et
  [`phil/legal-notices-bundle`](https://packagist.org/packages/phil/legal-notices-bundle) : le consentement et les pages
  légales
* [`phil/well-known-bundle`](https://packagist.org/packages/phil/well-known-bundle) : `security.txt` et les autres
  fichiers de `/.well-known/`
* [`phil/typography-bundle`](https://packagist.org/packages/phil/typography-bundle) : la typographie des textes
  français et anglais

L'[organisation PHIL sur GitHub](https://github.com/parler-haut-interagir-librement) liste tous les paquets.

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

## Autres gabarits « Parler Haut, Interagir Librement » 🩻

* [WebSymfony](https://github.com/parler-haut-interagir-librement/WebSymfony) (`phil/websymfony`)
  * MicroSymfony +
  * Une base de données
    * Doctrine ORM et ses migrations
    * StofDoctrineExtensionsBundle
  * Toujours Pico CSS, avec Stimulus et Turbo
  * EasyAdmin
  * KnpMenuBundle
  * Des couches de sécurité
    * Symfony Security
    * NelmioSecurityBundle
    * NelmioCorsBundle
  * Sentry
  * et plus encore.

* [WebSkeleton](https://github.com/parler-haut-interagir-librement/WebSkeleton) (`phil/webskeleton`)
  * WebSymfony +
  * Les outils de PHIL
    * Le kit PHIL UX ([`phil/ux-kit`](https://packagist.org/packages/phil/ux-kit)) et ses styles
      ([`phil/ux-css`](https://packagist.org/packages/phil/ux-css))
    * Des bundles PHIL, comme [`phil/doctrine-behaviours-bundle`](https://packagist.org/packages/phil/doctrine-behaviours-bundle),
      les comportements des entités Doctrine, et [`phil/publishing`](https://packagist.org/packages/phil/publishing),
      la publication des contenus
  * Organisé en DDD
  * En français et en anglais (`/fr`, `/en`)
  * et plus encore.

* [ApiSymfony](https://github.com/parler-haut-interagir-librement/ApiSymfony) (`phil/apisymfony`)
  * API Platform
  * Les mêmes tâches, exécutées par Castor
  * L'analyse statique avec PHPStan
  * Les standards de code avec PHP-CS-Fixer
  * Le réusinage avec Rector
  * Des tests : unitaires, d'API et de bout en bout
  * L'intégration continue de GitHub
  * Symfony Maker

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

## Construit avec MicroSymfony 🛠️

* [WebSymfony](https://github.com/parler-haut-interagir-librement/WebSymfony), qui liste ce qui est construit avec lui, à commencer par WebSkeleton.
