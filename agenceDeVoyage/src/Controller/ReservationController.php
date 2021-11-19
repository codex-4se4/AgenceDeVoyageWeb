<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Form\ResevationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReservationController extends AbstractController
{
    /**
     * @Route("/reservation", name="reservation")
     */
    public function index(): Response
    {
        return $this->render('reservation/index.html.twig', [
            'controller_name' => 'ReservationController',
        ]);
    }

    /**
     * @Route("/dashboardAdmin", name="dashboard_admin")
     */
    public function dashboardAdmin()
    {
        $reservation = $this->getDoctrine()->getRepository(Reservation::class)->findAll();
        $currentRes= $this->getDoctrine()->getRepository(Reservation::class)->findOneBy(array('login' => $this->getUser()->getUsername()));
        return $this->render('dashboardAdmin.html.twig', [
            "reservation" => $reservation,"current_user" => $currentRes
        ]);
    }

    /**
     * @Route("/dashboardUser", name="dashboard_user")
     */
    public function dashboardRes()
    {
        $resevations = $this->getDoctrine()->getRepository(Reservation::class)->findAll();

        return $this->render('dashboardRes.html.twig', [
            "reservations" => $resevations,
        ]);
    }

    /**
     * @Route("/utilisateur/{id}", name="utilisateur")
     */
    public function reservation(int $id): Response
    {
        $reservation = $this->getDoctrine()->getRepository(Reservation::class)->find($id);

        return $this->render("reservation/reservation.html.twig", [
            "reservation" => $reservation,
        ]);
    }

    /**
     * @Route("/modifier-reservation/{id}", name="modifier_reservation")
     */
    public function modifierreservation(Request $request, int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $reservation = $entityManager->getRepository(Reservation::class)->find($id);
        $form = $this->createForm(ResevationFormType::class, $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
        }

        return $this->render("reservation/reservation-form.html.twig", [
            "form_title" => "Modifier un reservation",
            "form_reservation" => $form->createView(),
        ]);
    }


    /**
     * @Route("/supprimer-reservation/{id}", name="supprimer_reservation")
     */
    public function supprimerReservation(int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $reservation = $entityManager->getRepository(Reservation::class)->find($id);
        $entityManager->remove($reservationsssssss);
        $entityManager->flush();

        return $this->redirectToRoute("reservations");
    }

    /**
     * @Route("/reservations", name="reservations")
     */
    public function resesrvations()
    {
        $reservations = $this->getDoctrine()->getRepository(Reservation::class)->findAll();

        return $this->render('reservation/reservations.html.twig', [
            "reservations" => $reservations,
        ]);
    }
}
