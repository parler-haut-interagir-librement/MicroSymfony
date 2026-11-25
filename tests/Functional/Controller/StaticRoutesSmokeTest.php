<?php

declare(strict_types=1);

namespace App\Tests\Functional\Controller;

use App\Controller\ComposerAction;
use App\Controller\FormAction;
use App\Controller\HelloWorldAction;
use App\Controller\HomeAction;
use App\Controller\SlugifyAction;
use Generator;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use RuntimeException;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Routing\RouterInterface;

/**
 * Extracted and simplified from the "pierstoval/smoke-testing" package.
 *
 * @see https://github.com/Pierstoval/SmokeTesting
 */
#[CoversClass(ComposerAction::class)]
#[CoversClass(FormAction::class)]
#[CoversClass(HelloWorldAction::class)]
#[CoversClass(HomeAction::class)]
#[CoversClass(SlugifyAction::class)]
final class StaticRoutesSmokeTest extends WebTestCase
{
    #[DataProvider('provideRouteCollection')]
    public function testRoutesDoNotReturnInternalError(string $httpMethod, string $routeName, string $routePath): void
    {
        $client = self::createClient();
        $client->request($httpMethod, $routePath);

        $response = $client->getResponse();
        self::assertLessThan(
            500,
            $response->getStatusCode(),
            \sprintf('Request "%s %s" for route "%s" returned an internal error.', $httpMethod, $routePath, $routeName),
        );
    }

    /**
     * @return Generator<string, array{httpMethod: string, routeName: string, routePath: string}>
     */
    public static function provideRouteCollection(): Generator
    {
        self::bootKernel();

        $router = self::getContainer()->get(RouterInterface::class);
        $routes = $router->getRouteCollection();
        self::ensureKernelShutdown();

        if (0 === $routes->count()) {
            throw new RuntimeException('No routes found in the application.');
        }

        yield from self::extractRoutesFromRouter($router);
    }

    /**
     * @return Generator<string, array{httpMethod: string, routeName: string, routePath: string}>
     */
    public static function extractRoutesFromRouter(RouterInterface $router): Generator
    {
        foreach ($router->getRouteCollection() as $routeName => $route) {
            /** @var array<int, string> $variables */
            $variables = $route->compile()->getVariables();
            if (\count($variables) > 0) {
                $defaults = $route->getDefaults();
                $defaultsKeys = array_keys($defaults);
                $diff = array_diff($variables, $defaultsKeys);
                if (\count($diff) > 0) {
                    // Dynamic route with no defaults, won't handle it
                    continue;
                }
            }

            $methods = $route->getMethods();
            if ([] === $methods) {
                // If we get there, it is because your route doesn't have methods requirment.
                // You can add one by adding ` methods: ['GET']` to your Route attribute.
                $methods[] = 'GET';
            }

            foreach ($methods as $method) {
                $routePath = $router->generate($routeName);
                yield "$method {$routePath}" => ['httpMethod' => $method, 'routeName' => $routeName, 'routePath' => $routePath];
            }
        }
    }
}
