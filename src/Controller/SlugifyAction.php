<?php

declare(strict_types=1);

namespace App\Controller;

use App\Helper\StringHelper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;

/**
 * This is an action implementing the ADR pattern.
 *
 * @see https://symfony.com/doc/current/controller/service.html#invokable-controllers
 */
#[AsController]
final class SlugifyAction extends AbstractController
{
    /**
     * Simple API endpoint returning JSON.
     */
    #[Route(path: '/api/slugify', name: 'slugify_action')]
    public function __invoke(Request $request, StringHelper $stringHelper): Response
    {
        return $this->json(['slug' => $stringHelper->slugify((string) $request->query->get('title'))]);
    }
}
