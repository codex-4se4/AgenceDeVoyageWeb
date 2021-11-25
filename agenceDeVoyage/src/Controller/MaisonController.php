<?php

namespace App\Controller;

use App\Entity\Hotel;
use App\Entity\Maison;
use App\Entity\Utilisateur;
use App\Form\HotelFormType;
use App\Form\MaisonFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MaisonController extends AbstractController
{
    /**
     * @Route("/maison", name="maison")
     */
    public function index(): Response
    {
        return $this->render('maison/index.html.twig', [
            'controller_name' => 'MaisonController',
        ]);
    }

    /**
     * @Route("/ajouterMaison", name="ajouter_maison")
     */
    public function ajouterMaison(Request $request): Response
    {
        $maison = new Maison();
        $form = $this->createForm(MaisonFormType::class, $maison);
        $form->handleRequest($request);
        $currentUser = $this->getDoctrine()->getRepository(Utilisateur::class)->findOneBy(array('login' => $this->getUser()->getUsername()));

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($maison);
            $entityManager->flush();
            $maisons = $this->getDoctrine()->getRepository(Maison::class)->findAll();


            return $this->render('maison/maisons.html.twig', [
                "maisons" => $maisons,
                "current_user" => $currentUser
            ]);

        }


        return $this->render('maison/maison-form.html.twig', [
            'form_maison' => $form->createView(),
            "current_user" => $currentUser
        ]);


    }

    /**
     * @Route("/modifier-maison/{id}", name="modifier_maison")
     */
    public function modifierMaison(Request $request, int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $maison = $entityManager->getRepository(Maison::class)->find($id);
        $form = $this->createForm(MaisonFormType::class, $maison);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            return $this->redirectToRoute("maisons");
        }
        $currentUser = $this->getDoctrine()->getRepository(Utilisateur::class)->findOneBy(array('login' => $this->getUser()->getUsername()));
        return $this->render("maison/maison-form.html.twig", [
            "form_title" => "Modifier une maison",
            "form_maison" => $form->createView(),
            "current_user" => $currentUser
        ]);
    }


    /**
     * @Route("/supprimer-maison/{id}", name="supprimer_maison")
     */
    public function supprimerMaison(int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $maison = $entityManager->getRepository(Maison::class)->find($id);
        $entityManager->remove($maison);
        $entityManager->flush();

        return $this->redirectToRoute("maisons");
    }

    /**
     * @Route("/maisons", name="maisons")
     */
    public function maisons()
    {
        $maisons = $this->getDoctrine()->getRepository(Maison::class)->findAll();
        $currentUser = $this->getDoctrine()->getRepository(Utilisateur::class)->findOneBy(array('login' => $this->getUser()->getUsername()));

        return $this->render('maison/maisons.html.twig', [
            "maisons" => $maisons,
            "current_user" => $currentUser
        ]);
    }
}
