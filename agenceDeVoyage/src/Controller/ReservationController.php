

<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Repository\ReservationRepositoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use App\Form\VehiculeType;



class ReservationControllerController extends AbstractController
{
    /**
     * @Route("/reservation", name="reservation")
     */
    public function index(ReservationRepository $calendar): Response
    {
        $resevations = $calendar->findAll();


        return $this->render('reservation/index.html.twig', [
            'reservation' => $resevations,
        ]);
    }

    /**
     * @Route("/addreservation", name="addreservation")
     */
    public function addreservation(Request $request): Response
    {
        $reservation = new reservation();
        $form = $this->createForm(reservationType::class,$reservation);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($reservation);
            $em->flush();
            return $this->redirectToRoute('reservation');
        }

        return $this->render('reservation/addreservation.html.twig', [
            'formreservation' => $form->createView(),
        ]);
    }
    /**
     * @Route("/reservation/{id}/editreservation", name="edit")
     */
    public function edit(Request $request,ReservationRepository $repo,$id): Response
    {
        $reservation = $repo->find($id);
        $form = $this->createForm(VehiculeType::class,$reservation);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($reservation);
            $em->flush();
            $this->addFlash('success', 'Edit avec sucess!');
            return $this->redirectToRoute('reservation');
        }
        return $this->render('reservation/addreservation.html.twig', [
            'formreservation' => $form->createView(),

        ]);
    }



}
