<?php

namespace App\Controller;

use App\Entity\Vehicule;
use App\Repository\VehiculeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use App\Form\VehiculeType;



class VehiculeController extends AbstractController
{
    /**
     * @Route("/vehicule", name="vehicule")
     */
    public function index(VehiculeRepository $calendar): Response
    {
        $vehicules = $calendar->findAll();


        return $this->render('vehicule/index.html.twig', [
            'vehicules' => $vehicules,
        ]);
    }

    /**
     * @Route("/addVehicule", name="addVehicule")
     */
    public function addVehicule(Request $request): Response
    {
        $vehicule = new Vehicule();
        $form = $this->createForm(VehiculeType::class,$vehicule);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($vehicule);
            $em->flush();
            return $this->redirectToRoute('vehicule');
        }

        return $this->render('vehicule/addVehicule.html.twig', [
            'formVehicule' => $form->createView(),
        ]);
    }
    /**
     * @Route("/vehicule/{id}/editVehicule", name="edit")
     */
    public function edit(Request $request,VehiculeRepository $repo,$id): Response
    {
        $vehicule = $repo->find($id);
        $form = $this->createForm(VehiculeType::class,$vehicule);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($vehicule);
            $em->flush();
            $this->addFlash('success', 'Edit avec sucess!');
            return $this->redirectToRoute('vehicule');
        }
        return $this->render('vehicule/addVehicule.html.twig', [
            'formVehicule' => $form->createView(),

        ]);
    }
    /**
     * @Route("/vehicule/{id}/deleteVehicule", name="delete")
     */
    public function deleteEvent(Request $request,VehiculeRepository $repo,$id): Response
    {

        $entityManager = $this->getDoctrine()->getManager();
        $vehicule = $repo->find($id);
        $entityManager->remove($vehicule);
        $entityManager->flush();
        $this->addFlash('success', 'Delete avec sucess!');


        return $this->redirectToRoute('vehicule');
    }

}
