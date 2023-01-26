<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function Symfony\Component\String\u;

/**
 * VinylController
 */
class VinylController
{
    #[Route('/')]
    public function homepage(): Response
    {
        return new Response('Title: some test title');
    }

    #[Route('/browse/{slug}')]
    public function browse(?string $slug = null): Response
    {
        $title = 'Genre: ';
        if ($slug) {
            $title .= u(str_replace('-', ' ', $slug))->title(true);
        } else {
            $title .= 'All Genres';
        }
        return new Response($title);
    }
}
