<?php

declare(strict_types=1);

namespace App\Tests\Integration\Entity;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\Attributes\CoversClass;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Zenstruck\Foundry\Test\ResetDatabase;

#[CoversClass(User::class)]
#[CoversClass(UserRepository::class)]
final class UserTest extends KernelTestCase
{
    use ResetDatabase;

    public function testPersistNewUserSuccess(): void
    {
        $em = self::getContainer()->get(EntityManagerInterface::class);
        $user = new User(
            email: 'test@example.com',
            password: 'password',
            username: 'username'
        );
        self::assertNull($user->getId());

        // persist (@see User::PrePersist())
        $em->persist($user);
        $em->flush();
        self::assertSame(1, (int) $user->getId());
        self::assertSame('username (1)', (string) $user);
        $updatedAt = $user->getUpdatedAt();

        // update (@see User::onPreUpdate())
        $user->setEmail('new_email@example.com');
        $em->flush();
        self::assertSame('new_email@example.com', $user->getEmail());
        self::assertNotSame($updatedAt, $user->getUpdatedAt());
    }
}
