<?php

namespace App\DTO;

class ApiWeatherDTO
{
    public $lat;
    public $lon;
    public $weatherData;

//    public function __construct($lat, $lon, $weatherData)
//    {
//        $this->lat = $lat;
//        $this->lon = $lon;
//        $this->weatherData = $weatherData;
//    }
//
    public function __construct($weatherData)
    {
        $this->weatherData = $weatherData;
    }
}
