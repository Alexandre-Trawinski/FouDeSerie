<?php

namespace App\Controller;

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
        return $this->render('home/series.html.twig', ['series' => $lesSeries]);
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
}
