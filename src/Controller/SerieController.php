<?php

namespace App\Controller;

use App\Entity\Genre;
use App\Entity\Serie;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SerieController extends AbstractController
{
    /**
     * @Route("/series", name="series")
     */
    public function index(): Response
    {
        $repository = $this->getDoctrine()->getRepository(Serie::class);
        $lesSeries = $repository->findAll();
        $repository = $this->getDoctrine()->getRepository(Genre::class);
        $lesGenres = $repository->findAll();
        return $this->render('serie/index.html.twig', ['lesSeries' => $lesSeries, 'lesGenres' => $lesGenres]);
    }

    /**
     * @Route("/series/{id}", name="laSerie")
     */
    public function uneSerie($id): Response
    {
        $repository = $this->getDoctrine()->getRepository(Serie::class);

        $laSerie = $repository->find($id);
        return $this->render('serie/uneSerie.html.twig', ['laSerie' => $laSerie]);
    }

    /**
     * @Route("/series/genres/{id}", name="uneSerieByGenre")
     */
    public function ListeSeriesByGenre($id): Response
    {
        $repository = $this->getDoctrine()->getRepository(Genre::class);

        $leGenre = $repository->find($id);
        $series = $leGenre->getLesSeries();
        $repository = $this->getDoctrine()->getRepository(Genre::class);
        $lesGenres = $repository->findAll();
        return $this->render('serie/index.html.twig', ['lesSeries' => $series, 'lesGenres' => $lesGenres]);
    }
}
