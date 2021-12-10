<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Form\ReservationType;;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ReservationController extends AbstractController
{
    /**
     * @Route("/Reservation", name="Reservation")
     */
    public function index(): Response
    {
        return $this->render('Reservation/index.html.twig', [
            'controller_name' => 'ReservationController',
        ]);
    }
    /**
     * @Route("/listReservation",name="list")
     */
    public function listReservation()
    {
        $reservations= $this->getDoctrine()->getRepository(Reservation::class)->findAll();
        return $this->render("reservation/list.html.twig",array("tabReservation"=>$reservations));
    }


    /**
     * @Route("/ajouteReservation",name="ajouterReservation")
     */
    public function ajouterReservation(Request $request)
    {
        $reservation = new Reservation();
        $form= $this->createForm(ReservationType::class,$reservation);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $em= $this->getDoctrine()->getManager();
            $em->persist($reservation);
            $em->flush();
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute("list");
        }
        return $this->render("reservation/ajouter.html.twig",array("formulaire"=>$form->createView()));
    }

    /**
     * @Route("/modifierReservation/{id}",name="modifierReservation")
     */
    public function modifierReservation(Request $request,$id)
    {
        $reservation = $this->getDoctrine()->getRepository(Reservation::class)->find($id);
        $form= $this->createForm(ReservationType::class,$reservation);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $em= $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute("list");
        }
        return $this->render("reservation/modifier.html.twig",array("formulaire"=>$form->createView()));
    }

    /**
     * @Route("/supprimerReservation/{id}",name="supprimerReservation")
     */
    public function supprimerReservation($id)
    {
        $reservation= $this->getDoctrine()->getRepository(Reservation::class)
            ->find($id);
        $em= $this->getDoctrine()->getManager();
        $em->remove($reservation);
        $em->flush();
        return $this->redirectToRoute("list");
    }
}