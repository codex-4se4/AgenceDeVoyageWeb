<?php

namespace App\Controller;

use App\Entity\Appartement;
use App\Entity\Hotel;
use App\Entity\Utilisateur;
use App\Form\AppartementFormType;
use App\Form\HotelFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HotelController extends AbstractController
{
    /**
     * @Route("/hotel", name="hotel")
     */
    public function index(): Response
    {
        return $this->render('hotel/index.html.twig', [
            'controller_name' => 'HotelController',
        ]);
    }

    /**
     * @Route("/ajouterHotel", name="ajouter_hotel")
     */
    public function ajouterHotel(Request $request): Response
    {
        $hotel = new Hotel();
        $form = $this->createForm(HotelFormType::class, $hotel);
        $form->handleRequest($request);
        $currentUser = $this->getDoctrine()->getRepository(Utilisateur::class)->findOneBy(array('login' => $this->getUser()->getUsername()));

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($hotel);
            $entityManager->flush();
            $hotels = $this->getDoctrine()->getRepository(Hotel::class)->findAll();


            return $this->render('hotel/hotels.html.twig', [
                "hotels" => $hotels,
                "current_user" => $currentUser
            ]);

        }


        return $this->render('hotel/hotel-form.html.twig', [
            'form_hotel' => $form->createView(),
            "current_user" => $currentUser
        ]);


    }

    /**
     * @Route("/modifier-hotel/{id}", name="modifier_hotel")
     */
    public function modifierHotel(Request $request, int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $hotel = $entityManager->getRepository(Hotel::class)->find($id);
        $form = $this->createForm(HotelFormType::class, $hotel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            return $this->redirectToRoute("hotels");
        }
        $currentUser = $this->getDoctrine()->getRepository(Utilisateur::class)->findOneBy(array('login' => $this->getUser()->getUsername()));
        return $this->render("hotel/hotel-form.html.twig", [
            "form_title" => "Modifier un hotel",
            "form_hotel" => $form->createView(),
            "current_user" => $currentUser
        ]);
    }


    /**
     * @Route("/supprimer-hotel/{id}", name="supprimer_hotel")
     */
    public function supprimerHotel(int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $hotel = $entityManager->getRepository(Hotel::class)->find($id);
        $entityManager->remove($hotel);
        $entityManager->flush();

        return $this->redirectToRoute("hotels");
    }

    /**
     * @Route("/hotels", name="hotels")
     */
    public function hotels()
    {
        $hotels = $this->getDoctrine()->getRepository(Hotel::class)->findAll();
        $currentUser = $this->getDoctrine()->getRepository(Utilisateur::class)->findOneBy(array('login' => $this->getUser()->getUsername()));

        return $this->render('hotel/hotels.html.twig', [
            "hotels" => $hotels,
            "current_user" => $currentUser
        ]);
    }
}
