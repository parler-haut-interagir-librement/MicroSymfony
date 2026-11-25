<?php

declare(strict_types=1);

namespace App\Tests\Unit\Entity;

use App\Entity\User;
use Doctrine\ORM\Mapping\Column;
use LogicException;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

#[CoversClass(User::class)]
final class UserTest extends TestCase
{
    public function testUserEntity(): void
    {
        $user = new User('', '', '');

        self::assertNull($user->getId());
        self::assertTrue($user->isNew());
        $normalizedEmail = 'test@example.com';
        self::assertSame($normalizedEmail, $user->setEmail('test@example.com')->getEmail());
        self::assertSame($normalizedEmail, $user->setEmail('Test@Example.CoM  ')->getEmail());
        self::assertSame($normalizedEmail, $user->setEmail('   Test@Example.CoM')->getEmail());
        self::assertSame($normalizedEmail, $user->setEmail('Test@example.CoM')->getEmail());
        self::assertSame('COil', $user->setUsername('COil')->getUsername());
        self::assertSame('COil', $user->getUserIdentifier());
        self::assertSame('123456', $user->setPassword('123456')->getPassword());
        self::assertSame('COil (not persisted)', (string) $user);
        self::assertSame(['ROLE_USER'], $user->getRoles());
    }

    public function testDatesAreSetByTheConstructorAndTheLifecycleCallbacks(): void
    {
        $before = time();
        $user = new User('email', 'password', 'username');
        self::assertGreaterThanOrEqual($before, $user->getCreatedAt()->getTimestamp());
        self::assertSame($user->getCreatedAt()->getTimestamp(), $user->getUpdatedAt()->getTimestamp());

        $user->onPrePersist();
        $created = $user->getCreatedAt();
        self::assertGreaterThanOrEqual($before, $created->getTimestamp());
        self::assertGreaterThanOrEqual($before, $user->getUpdatedAt()->getTimestamp());

        $user->onPreUpdate();
        self::assertSame($created, $user->getCreatedAt());
        self::assertGreaterThanOrEqual($created->getTimestamp(), $user->getUpdatedAt()->getTimestamp());
    }

    public function testUserGetUserIdentifier(): void
    {
        $user = new User('email', 'password', 'username');
        $user->setUsername('');
        $this->expectException(LogicException::class);
        $user->getUserIdentifier();
    }

    public function testUserSerialize(): void
    {
        $user = new User('email', 'password', 'serialized');
        $serializedUser = 'O:15:"App\Entity\User":4:{i:0;N;i:1;s:10:"serialized";i:2;s:8:"password";i:3;s:5:"email";}';
        self::assertSame($serializedUser, serialize($user));
    }

    public function testUserUnserialize(): void
    {
        $user = new User('other-email', 'other-password', 'other');
        $user->__unserialize([null, 'serialized', 'password', 'email']);
        self::assertNull($user->getId());
        self::assertSame('serialized', $user->getUsername());
        self::assertSame('password', $user->getPassword());
        self::assertSame('email', $user->getEmail());
    }

    public function testPersistedUserIsPrintedWithItsId(): void
    {
        $user = new User('email', 'password', 'username');
        (new ReflectionClass(User::class))->getProperty('id')->setValue($user, 7);

        self::assertSame('username (7)', (string) $user);
    }

    public function testColumnsOfTheConstructorAreMappedAsDeclared(): void
    {
        $columns = [];
        foreach (['email', 'password', 'username'] as $name) {
            $attributes = (new ReflectionClass(User::class))->getProperty($name)->getAttributes(Column::class);
            self::assertCount(1, $attributes, $name);
            $columns[$name] = $attributes[0]->newInstance();
        }

        self::assertSame(['email', 'password', 'username'], array_keys($columns));
        foreach ($columns as $name => $column) {
            self::assertSame(255, $column->length, $name);
            self::assertFalse($column->nullable, $name);
        }

        self::assertTrue($columns['email']->unique);
        self::assertFalse($columns['password']->unique);
        self::assertTrue($columns['username']->unique);
    }
}
