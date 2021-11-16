<?php

namespace App\Controller;

use App\Entity\Genre;
use App\Entity\Serie;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GenreController extends AbstractController
{
    /**
     * @Route("/genre", name="genre")
     */
    public function index(): Response
    {
        return $this->render('genre/index.html.twig', [
            'controller_name' => 'GenreController',
        ]);
    }

    /**
     * @Route("/testGenre", name="testGenre")
     */
    public function testGenre(): Response
    {
        $leGenre = new Genre();
        $leGenre->setLibelle('Drame');
        $leGenre2 = new Genre();
        $leGenre2->setLibelle('Crime');
        $repository = $this->getDoctrine()->getRepository(Serie::class);
        $uneSerie = $repository->find(28);
        $uneSerie->addLesGenre($leGenre);
        $uneSerie->addLesGenre($leGenre2);
        $em = $this->getDoctrine()->getManager();
        $em->persist($leGenre);
        $em->persist($leGenre2);
        $em->persist($uneSerie);
        $em->flush();
        return $this->render('genre/index.html.twig', ['uneSerie' => $uneSerie]);
    }
}
