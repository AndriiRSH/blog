<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use GuzzleHttp\Client;
//use Torann\GeoIP\GeoIP;

class ManyPostController extends Controller
{
    public function __invoke(Client $client)
    {
        $apiKey = '82590f4bb49d5532653645de67620739'; // env value config

        $responseGeo = $client->get("http://api.openweathermap.org/geo/1.0/direct?q=London&limit=5&appid={$apiKey}");
        $geoData = json_decode($responseGeo->getBody(), true);
        $lat = $geoData[0]['lat'];
        $lon = $geoData[0]['lon'];
        $response = $client->get("https://api.openweathermap.org/data/2.5/weather?lat={$lat}&lon={$lon}&appid={$apiKey}");
        $weatherData = json_decode($response->getBody(), true);

        $posts = Cache::rememberForever('posts:all', function (){
            return Post::paginate(6);
        });

//        $posts = Post::paginate(6);
        $randomPosts = Post::get()->random(4);
        $likedPostes = Post::withCount('likedUsers')->orderBy('liked_users_count', 'DESC')->get()->take(4);
        $categories = Category::all();
        return view('post.index', compact('posts', 'randomPosts', 'likedPostes', 'categories', 'weatherData'));
    }
}
