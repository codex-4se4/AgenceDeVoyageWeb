<?php

namespace App\Controller;

use App\Entity\Circuit;
use App\Entity\Utilisateur;
use App\Form\CircuitFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CircuitController extends AbstractController
{
    /**
     * @Route("/circuit", name="circuit")
     */
    public function index(): Response
    {
        return $this->render('circuit/index.html.twig', [
            'controller_name' => 'CircuitController',
        ]);
    }


    /**
     * @Route("/circuit/{id}", name="circuit")
     */
    public function circuit(int $id): Response
    {
        $circuit = $this->getDoctrine()->getRepository(Circuit::class)->find($id);

        return $this->render("circuit/circuit.html.twig", [
            "circuit" => $circuit,
        ]);
    }

    /**
     * @Route("/ajouter-circuit", name="ajouter_circuit")
     */
    public function ajouterCircuit(Request $request): Response
    {
        $circuit = new Circuit();


        $form = $this->createForm(CircuitFormType::class,$circuit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($circuit);
            $entityManager->flush();
            return $this->redirectToRoute("circuits");
        }
        $currentUser = $this->getDoctrine()->getRepository(Utilisateur::class)->findOneBy(array('login' => $this->getUser()->getUsername()));
        return $this->render("circuit/circuit-form.html.twig", [
            "form_title" => "Modifier un circuit",
            "form_circuit" => $form->createView(),
            "current_user" => $currentUser
        ]);
    }

    /**
     * @Route("/modifier-circuit/{id}", name="modifier_circuit")
     */
    public function modifierCircuit(Request $request, int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $circuit = $entityManager->getRepository(Circuit::class)->find($id);
        $form = $this->createForm(CircuitFormType::class, $circuit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            return $this->redirectToRoute("circuits");
        }
        $currentUser = $this->getDoctrine()->getRepository(Utilisateur::class)->findOneBy(array('login' => $this->getUser()->getUsername()));
        return $this->render("circuit/circuit-form.html.twig", [
            "form_title" => "Modifier un circuit",
            "form_circuit" => $form->createView(),
            "current_user" => $currentUser
        ]);
    }


    /**
     * @Route("/supprimer-circuit/{id}", name="supprimer_circuit")
     */
    public function supprimerCircuit(int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $circuit = $entityManager->getRepository(Circuit::class)->find($id);
        $entityManager->remove($circuit);
        $entityManager->flush();

        return $this->redirectToRoute("circuits");
    }

    /**
     * @Route("/circuits", name="circuits")
     */
    public function circuits()
    {
        $circuits = $this->getDoctrine()->getRepository(Circuit::class)->findAll();
        $currentUser = $this->getDoctrine()->getRepository(Utilisateur::class)->findOneBy(array('login' => $this->getUser()->getUsername()));


        return $this->render('circuit/circuits.html.twig', [
            "circuits" => $circuits,
            "current_user" => $currentUser
        ]);
    }
}

