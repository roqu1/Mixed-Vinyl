<?php

namespace App\Controller;

use App\Entity\VinylMix;
use App\Repository\VinylMixRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MixController extends AbstractController
{
    #[Route('/mix/new', name: 'app_mix_new')]
    public function new(EntityManagerInterface $entityManager): Response
    {
        $mix = new VinylMix();
        $mix->setTitle('The Hottest Mixtape Ever');
        $mix->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec a diam lectus. Sed sit amet ipsum mauris.');
        $mix->setTrackCount(rand(5, 20));
        $genres = ['pop', 'rock', 'heavy-metal'];
        $mix->setGenre($genres[array_rand($genres)]);
        $mix->setVotes(rand(-50, 50));

        $entityManager->persist($mix);
        $entityManager->flush();

        return new Response(sprintf(
            'Hiya! New Mix id: #%d, title: %s',
            $mix->getId(),
            $mix->getTitle(),
        ));
    }

    #[Route('mix/{id}')]
    public function show($id, VinylMixRepository $mixRepository)
    {
        $mix = $mixRepository->find($id);

        return $this->render('mix/show.html.twig', [
            'mix' => $mix,
        ]);
    }
}
