<?php

namespace App\Service;

use http\Env\Response;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class WeatherService
{

    private  $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function getWeather() : array
    {
        $response = $this->client->request(
            'GET',
            'http://api.weatherapi.com/v1/forecast.json?key=553947b7b72f4193b9b134507212610%20&q=Tunisia&days=8&aqi=no&alerts=no'
        );
        return $response->toArray();
    }

}
