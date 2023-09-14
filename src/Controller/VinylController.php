<?php

namespace App\Controller;

// use the Route class from the Symfony\Component\Routing\Annotation namespace

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function Symfony\Component\String\u;

class VinylController
{
    #[Route('/')]
    public function homepage(): Response
    {

        return new Response('Homepage');
    }
    // q: create a new route for the homepage at /.
    #[Route('/browse/{slug}')]
    public function browse(string $slug = null): Response
    {
        if ($slug) {
            // changes from 'rock-music' to 'rock music', the changes are made only for $slug
            $title = u(str_replace('-', ' ', $slug))->title(true);
        } else {
            $title = 'All Genres';
        }
        return new Response($title);
    }
}
