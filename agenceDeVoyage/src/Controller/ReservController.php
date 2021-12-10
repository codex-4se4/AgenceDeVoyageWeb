<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Entity\Utilisateur;
use App\Form\Reservation1Type;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\User;

/**
 * @Route("/reserv")
 */
class ReservController extends AbstractController
{

    /**
     * @Route("/calendar", name="calendar")
     */
    public function calendar() {
        return $this->render('reserv/OurCalendre.html.twig');
    }
    /**
     * @Route("/affichereserv", name="affichereserv")
     */
    public function listeReservationClient()
    {
        $m = $this->getDoctrine()->getManager();
        $reservation = $m->getRepository(Reservation::class);
        $events= $reservation->createQueryBuilder('c')
            ->getQuery()
            ->getArrayResult();
        $ev = [];
        $tab = [];
        foreach ($events as $event) {

            //$ev['title'] = $event['titre'];
            $ev['start'] = $event['contratdebut']->format('Y-m-d H:i:s');
            $ev['end'] = $event['contratfin']->format('Y-m-d H:i:s');
            $tab[] = $ev;
        }
        return $response = new JsonResponse($tab);

    }
    /**
     * @Route("/client", name="reserv_client", methods={"GET"})
     */
    public function clientindex(): Response
    {
        $user = $this->getDoctrine()
            ->getRepository(Utilisateur::class)
            ->find(1);

        $reservations = $this->getDoctrine()
            ->getRepository(Reservation::class)
            ->findBy(array('user'=>$user));

        return $this->render('reserv/reservationClient.html.twig', [
            'reservations' => $reservations,
        ]);
    }

    /**
     * @Route("/", name="reserv_index", methods={"GET"})
     */
    public function index(): Response
    {
        $reservations = $this->getDoctrine()
            ->getRepository(Reservation::class)
            ->findAll();

        return $this->render('reserv/index.html.twig', [
            'reservations' => $reservations,
        ]);
    }

    /**
     * @Route("/new", name="reserv_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $reservation = new Reservation();
        $form = $this->createForm(Reservation1Type::class, $reservation);
        $form->handleRequest($request);

        $user = $this->getDoctrine()
            ->getRepository(Utilisateur::class)
            ->find(1);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $reservation->setUser($user);
            $entityManager->persist($reservation);
            $entityManager->flush();

            return $this->redirectToRoute('reserv_client', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('reserv/new.html.twig', [
            'reservation' => $reservation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="reserv_show", methods={"GET"})
     */
    public function show(Reservation $reservation): Response
    {
        return $this->render('reserv/show.html.twig', [
            'reservation' => $reservation,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="reserv_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Reservation $reservation): Response
    {
        $form = $this->createForm(Reservation1Type::class, $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('reserv_client', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('reserv/edit.html.twig', [
            'reservation' => $reservation,
            'form' => $form->createView(),
        ]);
    }



    /**
     * @Route("/delete/{id}", name="reservation_delete")
     */
    public function delete($id)
    {
        $em = $this->getDoctrine()->getManager();
        $reservation = $em->getRepository(Reservation::class)->find($id);
        $em->remove($reservation);
        $em->flush();
        return $this->redirectToRoute('reserv_client');
    }

}
