<?php

namespace App\Controller;

use App\Entity\Serie;
use App\Form\SerieType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin/series/add", name="addSerie")
     */
    public function add(Request $request): Response
    {
        $uneSerie = new Serie();
        $form = $this->createForm(SerieType::class, $uneSerie);
        $form->handleRequest($request);
        if ($form->isSubmitted() &&  $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($uneSerie);
            $em->flush();
            return $this->redirectToRoute('series');
        }
        return $this->render('admin/index.html.twig', [
            'Form' => $form->createView(),
        ]);
    }
}
