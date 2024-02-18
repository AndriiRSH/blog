<?php

namespace App\Service;

use App\DTO\ApiWeatherDTO;
use GuzzleHttp\Client;

class WeatherService
{
    const OPEN_WEATHER_MAP_URL = 'https://api.openweathermap.org';

    private $client;
    private $apiKey;

    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->apiKey = config('weather.weather_api_key');;
    }

    public function getWeatherDataByCity($city)
    {
        $geoData = $this->getGeoData($city);
        $lat = $geoData[0]['lat'];
        $lon = $geoData[0]['lon'];
        $weatherData = $this->getWeatherData($lat, $lon);

        return new ApiWeatherDTO($weatherData);
    }

    private function getGeoData($city)
    {
        $responseGeo = $this->client->get(self::OPEN_WEATHER_MAP_URL . "/geo/1.0/direct?q={$city}&limit=5&appid={$this->apiKey}");
        return json_decode($responseGeo->getBody(), true);
    }

    private function getWeatherData($lat, $lon)
    {
        $response = $this->client->get(self::OPEN_WEATHER_MAP_URL . "/data/2.5/weather?lat={$lat}&lon={$lon}&appid={$this->apiKey}");
        return json_decode($response->getBody(), true);
    }
}

