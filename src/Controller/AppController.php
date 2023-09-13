<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @see AppControllerTest
 */
#[AsController]
final class AppController extends AbstractController
{
    /**
     * Simple page with some dynamic content.
     */
    #[Route(path: '/', name: 'homepage')]
    public function home(): Response
    {
        $readme = file_get_contents(__DIR__.'/../../README.md');

        return $this->render('home.html.twig', ['readme' => $readme]);
    }
}
