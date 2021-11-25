<?php

namespace App\Controller;

use App\Entity\Appartement;
use App\Entity\Role;
use App\Entity\Utilisateur;
use App\Form\AppartementFormType;
use App\Form\RegistrationFormType;
use App\Form\UtilisateurFormType;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Address;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

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
            "utilisateurs" => $utilisateurs, "current_user" => $currentUser
        ]);
    }

    /**
     * @Route("/dashboardUser", name="dashboard_user")
     */
    public function dashboardUser()
    {
        $utilisateurs = $this->getDoctrine()->getRepository(Utilisateur::class)->findAll();
        $currentUser = $this->getDoctrine()->getRepository(Utilisateur::class)->findOneBy(array('login' => $this->getUser()->getUsername()));
        return $this->render('dashboardUser.html.twig', [
            "utilisateurs" => $utilisateurs, "current_user" => $currentUser
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
     * @Route("/ajouterUtilisateur", name="ajouter_utilisateur")
     */
    public function ajouterUtilisateur(Request $request, UserPasswordEncoderInterface $userPasswordEncoderInterface): Response
    {
        $user = new Utilisateur();
        $form = $this->createForm(UtilisateurFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setMdp(
                $userPasswordEncoderInterface->encodePassword(
                    $user,
                    $form->get('mdp')->getData()
                )
            );
            $entityManager = $this->getDoctrine()->getManager();

            $role = $entityManager->getRepository(Role::class)->find(2);
            $user->setRole($role);
            $user->setPhoto("6193a3f279855311457432.jpeg");

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('dashboard_admin');
        }

        $currentUser = $this->getDoctrine()->getRepository(Utilisateur::class)->findOneBy(array('login' => $this->getUser()->getUsername()));
        return $this->render("utilisateur/utilisateur-form.html.twig", [
            "form_title" => "Ajouter un utilisateur",
            "form_utilisateur" => $form->createView(),
            "current_user" => $currentUser,
        ]);

    }

    /**
     * @Route("/modifier-utilisateur/{id}", name="modifier_utilisateur")
     */
    public
    function modifierUtilisateur(Request $request, int $id,UserPasswordEncoderInterface $userPasswordEncoderInterface): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $utilisateur = $entityManager->getRepository(Utilisateur::class)->find($id);
        $form = $this->createForm(UtilisateurFormType::class, $utilisateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $utilisateur->setMdp(
                $userPasswordEncoderInterface->encodePassword(
                    $utilisateur,
                    $form->get('mdp')->getData()
                )
            );
            $entityManager->flush();
            return $this->redirectToRoute("dashboard_admin");
        }
        $currentUser = $this->getDoctrine()->getRepository(Utilisateur::class)->findOneBy(array('login' => $this->getUser()->getUsername()));
        return $this->render("utilisateur/utilisateur-form.html.twig", [
            "form_title" => "Modifier un utilisateur",
            "form_utilisateur" => $form->createView(),
            "current_user" => $currentUser,
        ]);
    }


    /**
     * @Route("/supprimer-utilisateur/{id}", name="supprimer_utilisateur")
     */
    public
    function supprimerUtilisateur(int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $utilisateur = $entityManager->getRepository(Utilisateur::class)->find($id);
        $entityManager->remove($utilisateur);
        $entityManager->flush();

        return $this->redirectToRoute("dashboard_admin");
    }

    /**
     * @Route("/utilisateurs", name="utilisateurs")
     */
    public
    function utilisateurs()
    {
        $utilisateurs = $this->getDoctrine()->getRepository(Utilisateur::class)->findAll();

        return $this->render('utilisateur/utilisateurs.html.twig', [
            "utilisateurs" => $utilisateurs,
        ]);
    }
}
