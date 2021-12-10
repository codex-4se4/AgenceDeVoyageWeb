<?php

namespace App\Controller;

use App\Entity\Hebergement;
use App\Form\HebergementType;;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class HebergementController extends AbstractController
{
    /**
     * @Route("/hebergement", name="hebergement")
     */
    public function index(): Response
    {
        return $this->render('hebergement/index.html.twig', [
            'controller_name' => 'HebergementController',
        ]);
    }
    /**
     * @Route("/listHerbergement",name="list")
     */
    public function listHebergement()
    {
        $hebergements= $this->getDoctrine()->getRepository(Hebergement::class)->findAll();
        return $this->render("hebergement/list.html.twig",array("tabHebergement"=>$hebergements));
    }


    /**
     * @Route("/ajouterHebergement",name="ajouterHebergement")
     */
    public function ajouterHebergement(Request $request)
    {
        $hebergement = new Hebergement();
        $form= $this->createForm(HebergementType::class,$hebergement);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $em= $this->getDoctrine()->getManager();
            $em->persist($hebergement);
            $em->flush();
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute("list");
        }
        return $this->render("hebergement/ajouter.html.twig",array("formulaire"=>$form->createView()));
    }

    /**
     * @Route("/modifierHebergement/{id}",name="modifierHebergement")
     */
    public function modifierHebergement(Request $request,$id)
    {
        $hebergement = $this->getDoctrine()->getRepository(Hebergement::class)->find($id);
        $form= $this->createForm(HebergementType::class,$hebergement);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $em= $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute("list");
        }
        return $this->render("hebergement/modifier.html.twig",array("formulaire"=>$form->createView()));
    }

    /**
     * @Route("/supprimerHebergement/{id}",name="supprimerHebergement")
     */
    public function supprimerHebergement($id)
    {
        $hebergement= $this->getDoctrine()->getRepository(Hebergement::class)
            ->find($id);
        $em= $this->getDoctrine()->getManager();
        $em->remove($hebergement);
        $em->flush();
        return $this->redirectToRoute("list");
    }
}