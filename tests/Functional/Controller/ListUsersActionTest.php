<?php

declare(strict_types=1);

namespace App\Tests\Functional\Controller;

use App\Controller\ListUsersAction;
use App\Data\Controller\ListUsersActionData;
use App\Story\AppStory;
use PHPUnit\Framework\Attributes\CoversClass;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Zenstruck\Foundry\Test\Factories;
use Zenstruck\Foundry\Test\ResetDatabase;

/**
 * @see ListUsersAction
 */
#[CoversClass(ListUsersAction::class)]
#[CoversClass(ListUsersActionData::class)]
final class ListUsersActionTest extends WebTestCase
{
    use Factories;
    use ResetDatabase;

    public function testListUserActionSuccess(): void
    {
        $client = self::createClient();
        AppStory::load();
        $client->request('GET', '/users');
        self::assertResponseIsSuccessful();
    }
}
