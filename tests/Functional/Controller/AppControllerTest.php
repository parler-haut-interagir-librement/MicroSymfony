<?php

declare(strict_types=1);

namespace App\Tests\Functional\Controller;

use Symfony\Component\HttpFoundation\Request;
use Iterator;
use PHPUnit\Framework\Attributes\DataProvider;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * @internal
 */
final class AppControllerTest extends WebTestCase
{
    /**
     * @see AppController::home()
     * @return Iterator<array<int, string>>
     */
    public static function provideTestSimplePage(): Iterator
    {
        yield ['/'];
    }

    #[DataProvider('provideTestSimplePage')]
    public function testSimplePage(string $page): void
    {
        $client = self::createClient();
        $client->request(Request::METHOD_GET, $page);
        self::assertResponseIsSuccessful("Page {$page} is not successfull.");
    }
}
