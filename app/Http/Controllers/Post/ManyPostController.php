<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Service\WeatherService;
use GuzzleHttp\Client;
//use Torann\GeoIP\GeoIP;

class ManyPostController extends Controller
{

    private $weatherService;

    public function __construct(WeatherService $weatherService)
    {
        $this->weatherService =  $weatherService;
    }

    public function __invoke()
    {

//        $apiKey = config('weather.weather_api_key');

//        $responseGeo = $client->get("http://api.openweathermap.org/geo/1.0/direct?q=London&limit=5&appid={$apiKey}");
//        $geoData = json_decode($responseGeo->getBody(), true);
//        $lat = $geoData[0]['lat'];
//        $lon = $geoData[0]['lon'];
//        $response = $client->get("https://api.openweathermap.org/data/2.5/weather?lat={$lat}&lon={$lon}&appid={$apiKey}");
//        $weatherData = json_decode($response->getBody(), true);
//
        $city = 'London';
        $weatherData = $this->weatherService->getWeatherDataByCity($city);


        $posts = Cache::rememberForever('posts:all', function (){
            return Post::paginate(6);
        });

//        $posts = Post::paginate(6);
//        $randomPosts = Post::get()->random(4);
        $randomPosts = Post::inRandomOrder()->limit(min(4, Post::count()))->get();
        $likedPostes = Post::withCount('likedUsers')->orderBy('liked_users_count', 'DESC')->get()->take(4);
        $categories = Category::all();
        return view('post.index', compact('posts', 'randomPosts', 'likedPostes', 'categories', 'weatherData'));
    }
}
