<?php

namespace App\Controller;

use App\Entity\Serie;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        return $this->render('home/index.html.twig');
    }
    /**
     * @Route("/news", name="news")
     */
    public function news(): Response
    {
        return $this->render('home/news.html.twig');
    }

    /**
     * @Route("/testEntity", name="news")
     */
    public function testEntity(): Response
    {
        $laSerie = new Serie();
        $laSerie->setTitre('Narcos');
        $laSerie->setResume('Bonne série');
        $em = $this->getDoctrine()->getManager();
        $em->persist($laSerie);
        $em->flush();
        return $this->render('home/testEntity.html.twig', ['laSerie' => $laSerie]);
    }
}
