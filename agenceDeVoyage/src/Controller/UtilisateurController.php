<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\UtilisateurFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UtilisateurController extends AbstractController
{
    /**
     * @Route("/", name="")
     */
    public function index(): Response
    {
        return $this->render('utilisateur/index.html.twig', [
            'controller_name' => 'UtilisateurController',
        ]);
    }

    /**
     * @Route("/dashboardAdmin", name="dashboard_admin")
     */
    public function dashboardAdmin()
    {
        $utilisateurs = $this->getDoctrine()->getRepository(Utilisateur::class)->findAll();
        $currentUser = $this->getDoctrine()->getRepository(Utilisateur::class)->findOneBy(array('login' => $this->getUser()->getUsername()));
        return $this->render('dashboardAdmin.html.twig', [
            "utilisateurs" => $utilisateurs,"current_user" => $currentUser
        ]);
    }

    /**
     * @Route("/dashboardUser", name="dashboard_user")
     */
    public function dashboardUser()
    {
        $utilisateurs = $this->getDoctrine()->getRepository(Utilisateur::class)->findAll();

        return $this->render('dashboardUser.html.twig', [
            "utilisateurs" => $utilisateurs,
        ]);
    }

    /**
     * @Route("/utilisateur/{id}", name="utilisateur")
     */
    public function utilisateur(int $id): Response
    {
        $utilisateur = $this->getDoctrine()->getRepository(Utilisateur::class)->find($id);

        return $this->render("utilisateur/utilisateur.html.twig", [
            "utilisateur" => $utilisateur,
        ]);
    }

    /**
     * @Route("/modifier-utilisateur/{id}", name="modifier_utilisateur")
     */
    public function modifierUtilisateur(Request $request, int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $utilisateur = $entityManager->getRepository(Utilisateur::class)->find($id);
        $form = $this->createForm(UtilisateurFormType::class, $utilisateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
        }

        return $this->render("utilisateur/utilisateur-form.html.twig", [
            "form_title" => "Modifier un utilisateur",
            "form_utilisateur" => $form->createView(),
        ]);
    }


    /**
     * @Route("/supprimer-utilisateur/{id}", name="supprimer_utilisateur")
     */
    public function supprimerUtilisateur(int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $utilisateur = $entityManager->getRepository(Utilisateur::class)->find($id);
        $entityManager->remove($utilisateur);
        $entityManager->flush();

        return $this->redirectToRoute("utilisateurs");
    }

    /**
     * @Route("/utilisateurs", name="utilisateurs")
     */
    public function utilisateurs()
    {
        $utilisateurs = $this->getDoctrine()->getRepository(Utilisateur::class)->findAll();

        return $this->render('utilisateur/utilisateurs.html.twig', [
            "utilisateurs" => $utilisateurs,
        ]);
    }
}
