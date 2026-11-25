<?php

declare(strict_types=1);

namespace App\Tests\Integration\Twig\Extension;

use App\Controller\HomeAction;
use App\Controller\SlugifyAction;
use App\Twig\Extension\RoutingExtension;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\CoversClass;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

#[CoversClass(RoutingExtension::class)]
final class RoutingExtensionTest extends KernelTestCase
{
    /**
     * Do not remove this test if you use the ctrl_fqcn() Twig helper and want to
     * keep the 100% code coverage.
     */
    public function testRoutingExtensionInvalidArgumentException(): void
    {
        self::bootKernel();
        /** @var RoutingExtension $extension */
        $extension = self::getContainer()->get(RoutingExtension::class);
        $this->expectException(InvalidArgumentException::class);
        $extension->getControllerFqcn('foo');
    }

    public function testControllerFqcnFromItsShortname(): void
    {
        self::bootKernel();
        $extension = self::getContainer()->get(RoutingExtension::class);
        self::assertSame(HomeAction::class, $extension->getControllerFqcn('HomeAction'));
        self::assertSame(SlugifyAction::class, $extension->getControllerFqcn('SlugifyAction'));
    }

    public function testAttributeIf(): void
    {
        self::bootKernel();
        $extension = self::getContainer()->get(RoutingExtension::class);
        self::assertSame(' class="active"', $extension->getAttributeIf(true, 'class', 'active'));
        self::assertSame('', $extension->getAttributeIf(false, 'class', 'active'));
        self::assertSame(' aria-current="page"', $extension->getAriaCurrentPageIf(true));
        self::assertSame('', $extension->getAriaCurrentPageIf(false));
    }
}
