<?php

declare(strict_types=1);

namespace App\Tests\Functional\Controller;

use App\Controller\ListUsersAction;
use App\Data\Controller\ListUsersActionData;
use App\Dto\Controller\ListUsersActionDto;
use App\Factory\UserFactory;
use App\Repository\UserRepository;
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
#[CoversClass(ListUsersActionDto::class)]
#[CoversClass(UserRepository::class)]
#[CoversClass(AppStory::class)]
#[CoversClass(UserFactory::class)]
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
