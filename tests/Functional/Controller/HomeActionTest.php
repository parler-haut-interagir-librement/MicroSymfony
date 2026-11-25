<?php

declare(strict_types=1);

namespace App\Tests\Functional\Controller;

use App\Controller\HomeAction;
use PHPUnit\Framework\Attributes\CoversClass;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * The home page in each enabled locale: the messages of the layout and the README of the locale.
 */
#[CoversClass(HomeAction::class)]
final class HomeActionTest extends WebTestCase
{
    public function testEnglishByDefault(): void
    {
        $client = self::createClient();
        $client->request('GET', '/');

        self::assertResponseIsSuccessful();
        self::assertSelectorExists('html[lang="en"]');
        self::assertPageTitleSame('Proclaim Honestly, Interact Liberally: MicroSymfony');
        self::assertSelectorTextContains('main p', 'This page displays the README.md file of the GitHub repository.');
        self::assertSelectorExists('main a[href$="/blob/main/README.md"]');
        self::assertSelectorTextContains('main h2', 'About');
        self::assertSelectorTextContains('footer', 'All rights reserved');
        self::assertSelectorExists('link[rel="icon"][href*="phil_img_logo"]');
    }

    public function testFrenchForABrowserThatPrefersIt(): void
    {
        $client = self::createClient();
        $client->request('GET', '/', server: ['HTTP_ACCEPT_LANGUAGE' => 'fr-CA,fr;q=0.9,en;q=0.5']);

        self::assertResponseIsSuccessful();
        self::assertSelectorExists('html[lang="fr"]');
        self::assertResponseHeaderSame('Content-Language', 'fr');
        self::assertPageTitleSame('Parler Haut, Interagir Librement : MicroSymfony');
        self::assertSelectorTextContains('main p', 'Cette page affiche le fichier README.fr.md du dépôt GitHub.');
        self::assertSelectorExists('main a[href$="/blob/main/README.fr.md"]');
        self::assertSelectorTextContains('main h2', 'À propos');
        self::assertSelectorTextContains('footer', 'Tous droits réservés');
    }
}
