<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function Symfony\Component\String\u;

/**
 * VinylController
 */
class VinylController extends AbstractController
{
    #[Route('/')]
    public function homepage(): Response
    {
        $tracks = [
            [
                'song' => 'Song 1',
                'artist' => 'Artist 1',
            ],
            [
                'song' => 'Song 2',
                'artist' => 'Artist 2',
            ],
            [
                'song' => 'Song 3',
                'artist' => 'Artist 3',
            ],
            [
                'song' => 'Song 4',
                'artist' => 'Artist 4',
            ],
            [
                'song' => 'Song 5',
                'artist' => 'Artist 5',
            ],
            [
                'song' => 'Song 6',
                'artist' => 'Artist 6',
            ]
        ];

        return $this->render('vinyl/homepage.html.twig', [
            'title' => 'Some test title',
            'tracks' => $tracks
        ]);
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
