<?php

declare(strict_types=1);

namespace App\Tests\Functional\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * This file tests static pages without associated controller.
 *
 * @see config/routes/static_page.yaml
 *
 * @internal
 */
final class StaticControllerTest extends WebTestCase
{
    public function testStimulus(): void
    {
        $client = self::createClient();
        $client->request(Request::METHOD_GET, '/stimulus');
        self::assertResponseIsSuccessful();
    }
}
