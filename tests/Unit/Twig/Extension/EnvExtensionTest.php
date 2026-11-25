<?php

declare(strict_types=1);

namespace App\Tests\Unit\Twig\Extension;

use App\Twig\Extension\EnvExtension;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpKernel\Kernel;

#[CoversClass(EnvExtension::class)]
final class EnvExtensionTest extends TestCase
{
    public function testGlobals(): void
    {
        self::assertSame(
            ['sf_version' => Kernel::VERSION, 'php_version' => \PHP_VERSION, 'php_sapi' => \PHP_SAPI],
            new EnvExtension()->getGlobals(),
        );
    }
}
