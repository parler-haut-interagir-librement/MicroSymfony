<?php

declare(strict_types=1);

namespace App\Tests\Integration;

use PHPUnit\Framework\Attributes\CoversNothing;
use ReflectionClass;
use SimpleXMLElement;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Every service of the application can be built: the services whose class is in src/ are read from the container the
 * kernel dumps in debug mode, then fetched one by one from the test container.
 *
 * Symfony 8 no longer loads XML service files, so the dump is read as plain XML.
 *
 * @see https://gist.github.com/lyrixx/0adb8fd414451596557871d2d9af5695#file-containertest-php
 */
#[CoversNothing]
final class ContainerTest extends KernelTestCase
{
    public function testEveryServiceOfTheApplicationCanBeBuilt(): void
    {
        self::bootKernel(['debug' => true]);
        $container = self::getContainer();
        $projectDir = $container->getParameter('kernel.project_dir');
        $dump = $container->getParameter('debug.container.dump');
        self::assertIsString($projectDir);
        self::assertIsString($dump);

        $ids = $this->applicationServices(new SimpleXMLElement((string) file_get_contents($dump)), $projectDir.'/src/');
        self::assertNotSame([], $ids, 'The container holds no service of src/.');

        foreach ($ids as $id) {
            self::assertIsObject($container->get($id), $id);
        }
    }

    /**
     * @return list<string> the identifiers of the concrete services whose class is in $sourceDir
     */
    private function applicationServices(SimpleXMLElement $xml, string $sourceDir): array
    {
        $xml->registerXPathNamespace('c', 'http://symfony.com/schema/dic/services');
        $ids = [];
        $services = $xml->xpath('//c:services/c:service[@class and not(@abstract="true")]');
        foreach (false === $services || null === $services ? [] : $services as $service) {
            $id = (string) $service['id'];
            $class = (string) $service['class'];
            if (str_starts_with($id, '.') || !class_exists($class)) {
                continue; // Symfony internal stuff, or a class built at run time
            }

            $reflection = new ReflectionClass($class);
            if (!$reflection->isAbstract() && str_starts_with((string) $reflection->getFileName(), $sourceDir)) {
                $ids[] = $id;
            }
        }

        return $ids;
    }
}
