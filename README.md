# “**Proclaim** *Honestly*, **Interact** *Liberally*” **Micro***Symfony*

“**Proclaim** *Honestly*, **Interact** *Liberally*” **Micro***Symfony* is a Symfony application skeleton on steroids, ready to use.

The purpose of **Micro***Symfony* is to provide a sandbox with some sensible defaults and ready to use. 
It can be a solution if you want to quickly set up something, create a POC, test things, 
and even make a small "one-page" application.

It was base on [strangebuzz/MicroSymfony](https://github.com/strangebuzz/MicroSymfony) with adjustment
we're usually adding on all our projects. We also remove many examples. 

## Demo 🌈

Because a live demo is always better than all explanations. Here is it:

* Live demo will be available at [https://ph-il.ca/demos/microsymfony](https://ph-il.ca/demos/microsymfony)

## Requirements ⛮

All “**Proclaim** *Honestly*, **Interact** *Liberally*” project will use the latest version within 1/2 month depending on dependency availability.

* [PHP 8.2](https://www.php.net/releases/8.2/en.php)
* The [Symfony CLI](https://symfony.com/download)
* The [Xdebug](https://xdebug.org/) PHP extension if you want to run the code coverage report (optional but recommended)
* [Castor 0.8](https://github.com/jolicode/castor) task runner (optional)

## Stack 🔗

All “**Proclaim** Honestly, **Interact** Liberally” project will use the latest version within 1/2 month depending on dependency availability.

* [Symfony 6.3](https://symfony.com) 
* [Twig 3](https://twig.symfony.com)
* [Stimulus 3.2](https://stimulus.hotwired.dev/)
* [PHPUnit 9.5](https://phpunit.de)

## Features 🚀

**Micro***Symfony* ships these features, ready to use:

* One task runner
  * Castor ([source](https://github.com/parler-haut-interagir-librement/MicroSymfony/blob/main/castor.php)) 
* Static analysis with PHPStan
  * [Configuration](https://github.com/parler-haut-interagir-librement/MicroSymfony/blob/main/phpstan.neon)
* Coding standards with php-cs-fixer
  * [Configuration](https://github.com/parler-haut-interagir-librement/MicroSymfony/blob/main/.php-cs-fixer.dist.php)
* Refactoring with Rector
  * [Configuration](https://github.com/parler-haut-interagir-librement/MicroSymfony/blob/main/restor.php)
* The debug toolbar ([doc](https://symfony.com/doc/current/profiler.html))
* Tests ([organisation](https://www.strangebuzz.com/en/blog/organizing-your-symfony-project-tests))
  * Unit test [example](https://github.com/parler-haut-interagir-librement/MicroSymfony/tree/main/tests/Unit/Helper) 
  * Integration test [example](https://github.com/parler-haut-interagir-librement/MicroSymfony/blob/main/tests/Integration/Twig/Extension/ResponseExtensionTest.php) 
  * Functional test [example](https://github.com/parler-haut-interagir-librement/MicroSymfony/blob/main/tests/Functional/Controller/AppControllerTest.php) 
  * API test [example](https://github.com/parler-haut-interagir-librement/MicroSymfony/blob/main/tests/Api/Controller/SlugifyActionTest.php) 
  * E2E test [example](https://github.com/parler-haut-interagir-librement/MicroSymfony/blob/main/tests/E2E/Controller/AppControllerTest.php)
* Code coverage at 100%
  * [Output on CI](https://github.com/parler-haut-interagir-librement/MicroSymfony/actions/runs/6178372662/job/16771491572)
  * [Failing output example](https://github.com/parler-haut-interagir-librement/MicroSymfony/actions/runs/6176766049/job/16766431026)
* GitHub CI ([actions](https://github.com/parler-haut-interagir-librement/MicroSymfony/actions))
  * [Tests job output](https://github.com/parler-haut-interagir-librement/MicroSymfony/actions/runs/6178372662/job/16771491572)
  * [Lint job output](https://github.com/parler-haut-interagir-librement/MicroSymfony/actions/runs/6178372662/job/16771491353)
* Asset mapper+Stimulus ([documentation](https://symfony.com/doc/current/frontend/asset_mapper.html))
  * Vanilla Js ([source](https://github.com/parler-haut-interagir-librement/MicroSymfony/blob/main/assets/controllers/hello_controller.js)) ([demo](https://microsymfony.ovh/stimulus))
  * Fetch on a JSON endpoint of the application ([source](https://github.com/parler-haut-interagir-librement/MicroSymfony/blob/main/assets/controllers/api_controller.js)) ([demo](https://ph-il.ca/demos/microsymfony/stimulus)) 
* Symfony Maker ([documentation](https://symfony.com/bundles/SymfonyMakerBundle/current/index.html))
* A custom error template
  * [Source](https://github.com/parler-haut-interagir-librement/MicroSymfony/blob/main/templates/bundles/TwigBundle/Exception/error.html.twig)
  * [Demo](https://ph-il.ca/demos/microsymfony/404) 

## Other good practices 👌

* Using strict types in all PHP files ([source](https://github.com/parler-haut-interagir-librement/MicroSymfony/blob/main/src/Controller/AppController.php))
* Using the ADR pattern in an action controller ([source](https://github.com/parler-haut-interagir-librement/MicroSymfony/blob/main/src/Controller/SlugifyAction.php)) ([doc](https://symfony.com/doc/current/controller/service.html#invokable-controllers))

## What it doesn't ship? ❌

* Doctrine ([installation](https://symfony.com/doc/current/doctrine.html#installing-doctrine)) or use ([WebSymfony](https://github.com/parler-haut-interagir-librement/WebSymfony))

## Initializing an application with MicroSymfony 🪄

As the application template is [registered on Packagist](https://packagist.org/packages/phil/microsymfony), 
you can use composer to install it with the following command:

```
$ composer create-project phil/microsymfony
```

It creates a microsymfony directory with the new project. 
In this case, you must set up Git and a repository yourself. 
But that's the fastest way to test it. 

Note that the composer install command downloads all the required dependencies and builds the assets.

Or use the GitHub template:

![Use this template button](https://github.com/parler-haut-interagir-librement/MicroSymfony/blob/main/doc/use-this-template.png "Use this template")

To serve the application with the Symfony binary, run:

```
$ symfony server:start --daemon
```

```
$ castor symfony:start
```

The application is now available at https://127.0.0.1:8000 (considering your 8000 port is available). 


## References 📚

* https://jolicode.com/blog/castor-a-journey-across-the-sea-of-task-runners
* https://www.strangebuzz.com/en/blog/introducing-the-microsymfony-application-template (🇬🇧)

## Others “**Proclaim** Honestly, **Interact** Liberally” Skeletons 🩻

* [WebSymfony](https://github.com/parler-haut-interagir-librement/WebSymfony)
  * MicroSource +
  * Database
    * StofDoctrineExtensionsBundle
  * EasyAdmin
  * Security Layers
    * SymfonySecurity
    * NelmioSecurityBundle
    * NelmioCorsBundle
  * more.

* [ApiSymfony](https://github.com/parler-haut-interagir-librement/ApiSymfony)
  * API Platform

* [WebSkeleton](https://github.com/parler-haut-interagir-librement/WebSkeleton)
  * WebSymfony +
  * “**Proclaim** Honestly, **Interact** Liberally” Bundles
    * PhilBodyBundle - Add Base Twig Components
    * PhilDoctrineExtensionPublishBundle - Add Publish functionality to Doctrine Entity
    * PhilDoctrineExtensionStofBundle - Add missing stuff to StofDoctrineExtensionsBundle
  * more.
