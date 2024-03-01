<?php

declare(strict_types=1);

namespace App\Tests\Unit\Helper;

use App\Helper\StringHelper;
use Iterator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Symfony\Component\String\Slugger\AsciiSlugger;

/**
 * Delete this test if you want to verify that the coverage checker script works
 * properly.
 *
 * @internal
 */
final class StringHelperTest extends TestCase
{
    public static function provideSlugify(): Iterator
    {
        yield ['', ''];
        yield [null, ''];
        yield ['  Symfony IS GreAT ! !!', 'symfony-is-great'];
    }

    #[DataProvider('provideSlugify')]
    public function testSlugify(?string $input, string $expected): void
    {
        $stringHelper = new StringHelper(new AsciiSlugger());
        self::assertSame($expected, $stringHelper->slugify($input));
    }
}
