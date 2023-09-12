# MicroSymfony 🎶

MicroSymfony is a Symfony application skeleton on steroids, ready to use.

This was base on [strangebuzz/MicroSymfony](https://github.com/strangebuzz/MicroSymfony) with adjustment
we're usually adding on all our projects.


## Demo 🌈

Because a live demo is always better than all explanations. Here is it:

* Live demo will be available at [https://ph-il.ca/demos/microsymfony](https://ph-il.ca/demos/microsymfony)


## Requirements ⚙

All “Proclaim Honestly, Interact Liberally” project will use the latest version within 1/2 month depending on dependency availability.

* [PHP 8.2](https://www.php.net/releases/8.2/en.php)
* The [Symfony CLI](https://symfony.com/download)
* The [Xdebug](https://xdebug.org/) PHP extension if you want to run the code coverage report (optional but recommended)
* [Castor 0.8](https://github.com/jolicode/castor) task runner (optional)

## Stack 🔗

All “Proclaim Honestly, Interact Liberally” project will use the latest version within 1/2 month depending on dependency availability.

* [Symfony 6.3](https://symfony.com) 
* [Twig 3](https://twig.symfony.com)
* [Stimulus 3.2](https://stimulus.hotwired.dev/)
* [PHPUnit 9.5](https://phpunit.de)
* [Tailwind CSS](https://tailwindcss.com/) framework 


## Features 🚀

**MicroSymfony** ships these features, ready to use:

* One task runner
  * Castor ([source](https://github.com/parler-haut-interagir-librement/MicroSymfony/blob/main/castor.php)) 
* Static analysis with PHPStan
  * [Configuration](https://github.com/parler-haut-interagir-librement/MicroSymfony/blob/main/phpstan.neon)
* Coding standards with php-cs-fixer
  * [Configuration](https://github.com/parler-haut-interagir-librement/MicroSymfony/blob/main/.php-cs-fixer.dist.php)
* Refactoring with Rector
  * [Configuration](https://github.com/parler-haut-interagir-librement/MicroSymfony/blob/main/restor.php)
* The debug toolbar ([doc](https://symfony.com/doc/current/profiler.html))
* Tests ([demo](https://www.strangebuzz.com/en/blog/introducing-the-microsymfony-application-template#h2_7))
  * Unit test [example](https://github.com/parler-haut-interagir-librement/MicroSymfony/tree/main/tests/Unit/Helper) 
  * Integration test [example](https://github.com/parler-haut-interagir-librement/MicroSymfony/blob/main/tests/Integration/Twig/Extension/ResponseExtensionTest.php) 
  * Functional test [example](https://github.com/parler-haut-interagir-librement/MicroSymfony/blob/main/tests/Functional/Controller/AppControllerTest.php) 
  * API test [example](https://github.com/parler-haut-interagir-librement/MicroSymfony/blob/main/tests/Api/Controller/SlugifyActionTest.php) 
  * E2E test [example](https://github.com/parler-haut-interagir-librement/MicroSymfony/blob/main/tests/E2E/Controller/AppControllerTest.php)
* Code coverage at 100%
  * [Output on CI](https://github.com/strangebuzz/MicroSymfony/actions/runs/5793881686/job/15702426150)
  * [Failing output example](https://github.com/strangebuzz/MicroSymfony/actions/runs/5220428064/jobs/9423476258)
* GitHub CI ([actions](https://github.com/strangebuzz/MicroSymfony/actions))
  * [Tests job output](https://github.com/strangebuzz/MicroSymfony/actions/runs/5793881686/job/15702426150)
  * [Lint job output](https://github.com/strangebuzz/MicroSymfony/actions/runs/5793881686/job/15702425939)
* Asset mapper+Stimulus ([documentation](https://symfony.com/doc/current/frontend/asset_mapper.html))
  * Vanilla Js ([source](https://github.com/parler-haut-interagir-librement/MicroSymfony/blob/main/assets/controllers/hello_controller.js)) ([demo](https://microsymfony.ovh/stimulus))
  * Fetch on a JSON endpoint of the application ([source](https://github.com/parler-haut-interagir-librement/MicroSymfony/blob/main/assets/controllers/api_controller.js)) ([demo](https://microsymfony.ovh/stimulus)) 
* Symfony Maker ([documentation](https://symfony.com/bundles/SymfonyMakerBundle/current/index.html))
* A custom error template
  * [Source](https://github.com/parler-haut-interagir-librement/MicroSymfony/blob/main/templates/bundles/TwigBundle/Exception/error.html.twig)
  * [Demo](https://https://ph-il.ca/demos/microsymfony/404) 

## Other good practices 👌

* Using strict types in all PHP files ([source](https://github.com/parler-haut-interagir-librement/MicroSymfony/blob/main/src/Controller/AppController.php))
* Using the ADR pattern in an action controller ([source](https://github.com/parler-haut-interagir-librement/MicroSymfony/blob/main/src/Controller/SlugifyAction.php)) ([doc](https://symfony.com/doc/current/controller/service.html#invokable-controllers))

## What it doesn't ship? ❌

* Doctrine ([installation](https://symfony.com/doc/current/doctrine.html#installing-doctrine))


## References 📚

* https://jolicode.com/blog/castor-a-journey-across-the-sea-of-task-runners
* https://www.strangebuzz.com/en/blog/introducing-the-microsymfony-application-template (🇬🇧)


