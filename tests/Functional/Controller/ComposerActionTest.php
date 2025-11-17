<?php

declare(strict_types=1);

namespace App\Tests\Functional\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;

/**
 * @internal
 */
final class ComposerActionTest extends WebTestCase
{
    /**
     * This test is kept for the example, but this page is already tested by StaticRoutesSmokeTest.
     *
     * @see StaticRoutesSmokeTest
     */
    public function testComposerPage(): void
    {
        $client = self::createClient();
        $client->request(Request::METHOD_GET, '/composer');
        self::assertResponseIsSuccessful();
    }
}
