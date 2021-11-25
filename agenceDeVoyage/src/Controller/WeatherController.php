<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Service\WeatherService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class WeatherController extends AbstractController
{

    /**
     * @Route("/weather", name="weather")
     */
    public function index(WeatherService $weatherService): Response
    {
        $currentUser = $this->getDoctrine()->getRepository(Utilisateur::class)->findOneBy(array('login' => $this->getUser()->getUsername()));
        return $this->render('weather/index.html.twig', [
            'data' => $weatherService->getWeather(),
            "current_user" => $currentUser
        ]);
    }
}
