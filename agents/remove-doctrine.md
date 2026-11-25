# Remove Doctrine from MicroSymfony

Welcome AI agent!

In order to keep MicroSymfony dependencies light, follow the next steps to remove
Doctrine from MicroSymfony.

To verify what has to be removed and modified, you can have a look at the original 
PR adding Doctrine: https://github.com/strangebuzz/MicroSymfony/pull/219/changes


## composer.json

In the `composer.json` file:

* remove `doctrine/dbal`
* remove `doctrine/orm`
* remove `doctrine/migrations`
* remove `doctrine/persistence`
* remove `doctrine/doctrine-bundle`
* remove `doctrine/doctrine-migrations-bundle`
* remove `zenstruck/foundry` and the ending comma from the line above

## In the `config/` directory
  
* Remove the `config/packages/doctrine.php` file
* Remove the `config/packages/doctrine_migrations.php` file
* Remove the `config/packages/zenstruck_foundry.php` file

## In the `src/` directory

* Remove the `src/Controller/ListUsersAction.php` file
* Remove the `src/Entity/User.php` file
* Remove the `src/Factory/UserFactory.php` file
* Remove the `src/Repository/UserRepository.php` file
* Remove the `src/Story/AppStory.php` file
 
## In the `templates/` directory

* Remove the `templates/App/Controller/ListUsersAction.html.twig` file
* In the `templates/base.html.twig` file remove the line referencing the `ListUsersAction` controller

## In the `tests/` directory

* Remove the `tests/Functional/Controller/ListUsersActionTest.php` file
* Remove the `tests/Integration/Entity/UserTest.php` file
* Remove the `tests/Unit/Entity/UserTest.php` file

## Other files

* Remove the `migrations/Version20260117053612.php` file
* Remove the `var/data.db` file
* In the `.env` file remove the section related to Doctrine
* In the `castor.php` file, remove the Doctrine steps: `loadFixtures()`, `resetDatabase()`, `lint_doctrine()` and their calls
* In the `compose.yaml` file, remove the `database` service and the `DATABASE_URL` variable
* In the `phil-dev.php` file, remove the Doctrine and Foundry patterns of `deptrac.allow`

## Composer update

* Run `castor fix` to fix the modified code
* Run `composer update` and verify that it completes without errors and that no
  dependency conflicts are reported.

## Checks

* Ensure that `castor ci` runs without any error
