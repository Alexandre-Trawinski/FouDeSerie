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


    /**
     * @Route("/admin/series/delete", name="deleteSerie")
     */
    public function delete(): Response
    {
        $repository = $this->getDoctrine()->getRepository(Serie::class);
        $lesSeries = $repository->findAll();

        return $this->render('admin/supprimer.html.twig', [
            'lesSeries' => $lesSeries
        ]);
    }

    /**
     * @Route("/admin/series/delete/{id}", name="deleteUneSerie", methods="DELETE")
     */
    public function deleteUneSerie(Request $request, $id): Response
    {
        $token = $request->get('token');
        $nomToken = "delete_serie" . $id;
        if ($this->isCsrfTokenValid($nomToken, $token)) {
            $em = $this->getDoctrine()->getManager();
            $serie = $em->getRepository(Serie::class)->find($id);
            $em->remove($serie);
            $em->flush();
        }
        return $this->redirectToRoute('deleteSerie');
    }
}
