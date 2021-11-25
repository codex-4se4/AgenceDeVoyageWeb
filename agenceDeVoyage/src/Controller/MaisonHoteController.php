<?php

namespace App\Controller;

use App\Entity\Maison;
use App\Entity\MaisonHote;
use App\Entity\Utilisateur;
use App\Form\MaisonFormType;
use App\Form\MaisonHoteFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MaisonHoteController extends AbstractController
{
    /**
     * @Route("/maison/hote", name="maison_hote")
     */
    public function index(): Response
    {
        return $this->render('maison_hote/index.html.twig', [
            'controller_name' => 'MaisonHoteController',
        ]);
    }


    /**
     * @Route("/ajouterMaisonHote", name="ajouter_maison_hote")
     */
    public function ajouterMaisonHote(Request $request): Response
    {
        $maisonHote = new MaisonHote();
        $form = $this->createForm(MaisonHoteFormType::class, $maisonHote);
        $form->handleRequest($request);
        $currentUser = $this->getDoctrine()->getRepository(Utilisateur::class)->findOneBy(array('login' => $this->getUser()->getUsername()));

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($maisonHote);
            $entityManager->flush();
            $maisonsHote = $this->getDoctrine()->getRepository(MaisonHote::class)->findAll();


            return $this->render('maison_hote/maisonsHote.html.twig', [
                "maisonsHote" => $maisonsHote,
                "current_user" => $currentUser
            ]);

        }


        return $this->render('maison_hote/maisonHote-form.html.twig', [
            'form_maison_hote' => $form->createView(),
            "current_user" => $currentUser
        ]);


    }

    /**
     * @Route("/modifier-maison-hote/{id}", name="modifier_maison_hote")
     */
    public function modifierMaisonHote(Request $request, int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $maisonHote = $entityManager->getRepository(MaisonHote::class)->find($id);
        $form = $this->createForm(MaisonHoteFormType::class, $maisonHote);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            return $this->redirectToRoute("maisonsHote");
        }
        $currentUser = $this->getDoctrine()->getRepository(Utilisateur::class)->findOneBy(array('login' => $this->getUser()->getUsername()));
        return $this->render("maison_hote/maisonHote-form.html.twig", [
            "form_title" => "Modifier une maison d'hôte",
            "form_maison_hote" => $form->createView(),
            "current_user" => $currentUser
        ]);
    }


    /**
     * @Route("/supprimer-maison-hote/{id}", name="supprimer_maison_hote")
     */
    public function supprimerMaisonHote(int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $maisonHote = $entityManager->getRepository(MaisonHote::class)->find($id);
        $entityManager->remove($maisonHote);
        $entityManager->flush();

        return $this->redirectToRoute("maisonsHote");
    }

    /**
     * @Route("/maisonsHote", name="maisonsHote")
     */
    public function maisonsHote()
    {
        $maisonsHote = $this->getDoctrine()->getRepository(MaisonHote::class)->findAll();
        $currentUser = $this->getDoctrine()->getRepository(Utilisateur::class)->findOneBy(array('login' => $this->getUser()->getUsername()));

        return $this->render('maison_hote/maisonsHote.html.twig', [
            "maisonsHote" => $maisonsHote,
            "current_user" => $currentUser
        ]);
    }
}
