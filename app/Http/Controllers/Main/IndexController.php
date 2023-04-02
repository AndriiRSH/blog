<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke()
    {
        $posts = Post::paginate(6);
        $randomPosts = Post::get()->random(4);
        return view('main.index', compact('posts', 'randomPosts'));
    }
}
