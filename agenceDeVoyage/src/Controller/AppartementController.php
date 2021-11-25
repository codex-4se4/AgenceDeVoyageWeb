<?php

namespace App\Controller;

use App\Entity\Appartement;
use App\Form\AppartementType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
     * @Route("/listAppartement",name="listAppartement")
     */
    public function listAppartement()
    {
        $appartements= $this->getDoctrine()->getRepository(Appartement::class)->findAll();
        return $this->render("appartement/list.html.twig",array("tabAppartement"=>$appartements));
    }


    /**
     * @Route("/ajouterAppartement",name="ajouterAppartement")
     */
    public function ajouterAppartement(Request $request)
    {
        $appartement = new Appartement();
        $form= $this->createForm(AppartementType::class,$appartement);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $em= $this->getDoctrine()->getManager();
            $em->persist($appartement);
            $em->flush();
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute("listAppartement");
        }
        return $this->render("appartement/ajouter.html.twig",array("formulaire"=>$form->createView()));
    }

    /**
     * @Route("/modifierAppartement/{id}",name="modifierAppartement")
     */
    public function modifierAppartement(Request $request,$id)
    {
        $appartement = $this->getDoctrine()->getRepository(Appartement::class)->find($id);
        $form= $this->createForm(appartementType::class,$appartement);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $em= $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute("listAppartement");
        }
        return $this->render("appartement/modifier.html.twig",array("formulaire"=>$form->createView()));
    }

    /**
     * @Route("/supprimerAppartement/{id}",name="supprimerAppartement")
     */
    public function supprimerAppartement($id)
    {
        $appartement= $this->getDoctrine()->getRepository(Appartement::class)
            ->find($id);
        $em= $this->getDoctrine()->getManager();
        $em->remove($appartement);
        $em->flush();
        return $this->redirectToRoute("listAppartement");
    }
}


