<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MaisonHoteController extends AbstractController
{
    /**
     * @Route("/maison/hote", name="maison_hote")
     */
    public function index(): Response
    {
        return $this->render('maison_hote/index.html.twig', [
            'controller_name' => 'MaisonHoteController',
        ]);
    }
}
