<?php

declare(strict_types=1);

namespace App\Tests\Functional\Controller;

use App\Controller\ComposerAction;
use App\Controller\FormAction;
use App\Controller\HelloWorldAction;
use App\Controller\HomeAction;
use App\Controller\SlugifyAction;
use Phil\DevTools\Testing\RouteSmokeTesting;
use PHPUnit\Framework\Attributes\CoversClass;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Every GET route of the application answers without a server error: a new page is tested as soon as its route exists.
 * The routes have no parameter; the profiler and the error pages, named `_…`, are left out.
 */
#[CoversClass(ComposerAction::class)]
#[CoversClass(FormAction::class)]
#[CoversClass(HelloWorldAction::class)]
#[CoversClass(HomeAction::class)]
#[CoversClass(SlugifyAction::class)]
final class RouteSmokeTest extends WebTestCase
{
    use RouteSmokeTesting;
}
