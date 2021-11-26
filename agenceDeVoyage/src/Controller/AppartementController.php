<?php

namespace App\Controller;

use App\Entity\Appartement;
use App\Entity\Role;
use App\Entity\Utilisateur;
use App\Form\AppartementFormType;
use App\Form\RegistrationFormType;
use App\Security\AppCustomAuthenticator;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Address;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;

class AppartementController extends AbstractController
{
    /**
     * @Route("/appartement", name="appartement")
     */
    public function index(): Response
    {
        return $this->render('appartement/index.html.twig', [
            'controller_name' => 'AppartementController',
        ]);
    }


    /**
     * @Route("/ajouterAppartement", name="ajouter_appartement")
     */
    public function ajouterAppartement(Request $request): Response
    {
        $appartement = new Appartement();
        $form = $this->createForm(AppartementFormType::class, $appartement);
        $form->handleRequest($request);
        $currentUser = $this->getDoctrine()->getRepository(Utilisateur::class)->findOneBy(array('login' => $this->getUser()->getUsername()));

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($appartement);
            $entityManager->flush();
            $appartements = $this->getDoctrine()->getRepository(Appartement::class)->findAll();


            return $this->render('appartement/maisonsHote.html.twig', [
                "appartements" => $appartements,
                "current_user" => $currentUser
            ]);

        }



        return $this->render('appartement/maisonHote-form.html.twig', [
            'form_appartement' => $form->createView(),
            "current_user" => $currentUser
        ]);


    }

    /**
     * @Route("/modifier-appartement/{id}", name="modifier_appartement")
     */
    public function modifierAppartement(Request $request, int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $appartement = $entityManager->getRepository(Appartement::class)->find($id);
        $form = $this->createForm(AppartementFormType::class, $appartement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            return $this->redirectToRoute("appartements");
        }
        $currentUser = $this->getDoctrine()->getRepository(Utilisateur::class)->findOneBy(array('login' => $this->getUser()->getUsername()));
        return $this->render("appartement/maisonHote-form.html.twig", [
            "form_title" => "Modifier un appartement",
            "form_appartement" => $form->createView(),
            "current_user" => $currentUser
        ]);
    }


    /**
     * @Route("/supprimer-appartement/{id}", name="supprimer_appartement")
     */
    public function supprimerAppartement(int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $appartement = $entityManager->getRepository(Appartement::class)->find($id);
        $entityManager->remove($appartement);
        $entityManager->flush();

        return $this->redirectToRoute("appartements");
    }

    /**
     * @Route("/appartements", name="appartements")
     */
    public function appartements()
    {
        $appartements = $this->getDoctrine()->getRepository(Appartement::class)->findAll();
        $currentUser = $this->getDoctrine()->getRepository(Utilisateur::class)->findOneBy(array('login' => $this->getUser()->getUsername()));

        return $this->render('appartement/appartements.html.twig', [
            "appartements" => $appartements,
            "current_user" => $currentUser
        ]);
    }
}
