<?php

namespace App\Http\Controllers\Personal\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends BaseController
{
    public function __invoke()
    {
//        $posts = Post::all();
        $posts = Post::where('user_id', Auth::id())->get();
        return view('personal.post.index', compact('posts'));
    }
}
