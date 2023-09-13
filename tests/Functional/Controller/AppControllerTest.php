<?php

declare(strict_types=1);

namespace App\Tests\Functional\Controller;

use Iterator;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class AppControllerTest extends WebTestCase
{
    private const FORM_SUBMIT_BUTTON_ID = 'register_form_save';

    /**
     * @see AppController::home()
     * @see AppController::composer()
     */
    public static function provideTestSimplePage(): Iterator
    {
        yield ['/'];
    }

    /**
     * @dataProvider provideTestSimplePage
     */
    public function testSimplePage(string $page): void
    {
        $client = self::createClient();
        $client->request('GET', $page);
        self::assertResponseIsSuccessful("Page {$page} is not successfull.");
    }

}
