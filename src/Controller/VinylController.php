<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\MixRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function Symfony\Component\String\u;

/**
 * VinylController
 */
class VinylController extends AbstractController
{
    public function __construct(
        private MixRepository $repository,
        private bool $isDebug
    ) {

    }

    #[Route('/', name: 'app_homepage')]
    public function homepage(): Response
    {
        $tracks = [
            [
                'song' => 'Gangsta\'s Paradise',
                'artist' => 'Coolio',
            ],
            [
                'song' => 'Waterfalls',
                'artist' => 'TLC',
            ],
            [
                'song' => 'Creep',
                'artist' => 'TLC',
            ],
            [
                'song' => 'Kiss from a Rose',
                'artist' => 'Seal',
            ],
            [
                'song' => 'On Bended Knee',
                'artist' => 'Boyz II Men',
            ],
            [
                'song' => 'Another Night',
                'artist' => 'Real McCoy',
            ],
            [
                'song' => 'Fantasy',
                'artist' => 'Mariah Carey',
            ],
            [
                'song' => 'Take a Bow',
                'artist' => 'Madonna',
            ],
        ];

        return $this->render('vinyl/homepage.html.twig', [
            'title' => 'Some test title',
            'tracks' => $tracks
        ]);
    }

    #[Route('/browse/{slug}', name: 'app_browse')]
    public function browse(
        ?string $slug = null
    ): Response {
        $genre = $slug ? u(str_replace('-', ' ', $slug))->title(true) : null;
        $mixes = $this->repository->findAll();

        return $this->render('vinyl/browse.html.twig', [
            'genre' => $genre,
            'mixes' => $mixes
        ]);
    }
}
