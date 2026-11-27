<?php

declare(strict_types=1);

namespace App\Tests\E2E\Controller;

use App\Controller\SlugifyAction;
use PHPUnit\Framework\Attributes\CoversClass;
use Symfony\Component\Panther\PantherTestCase;

/**
 * The Stimulus page in a real browser, Chrome driven by Panther: the `api` controller sends the typed title to the
 * slug endpoint and writes its answer in the read-only field, so reading the slug proves that AssetMapper serves the
 * JavaScript, that Stimulus connects the controller and that the endpoint answers the browser. Run by
 * `castor test:e2e` alone; Chrome and chromedriver must be on the PATH.
 *
 * @see https://github.com/symfony/panther
 */
#[CoversClass(SlugifyAction::class)]
final class StimulusPageTest extends PantherTestCase
{
    public function testTheApiControllerWritesTheSlugOfTheTitle(): void
    {
        $client = self::createPantherClient(['hostname' => 'localhost']);
        $crawler = $client->request('GET', '/stimulus');

        self::assertInputValueSame('slug', '');

        $crawler->filter('#title')->sendKeys('Hello Panther World');
        $client->waitForAttributeToContain('#slug', 'value', 'hello-panther-world', 10);

        self::assertInputValueSame('slug', 'hello-panther-world');
    }
}
