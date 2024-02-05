<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ManyPostController extends Controller
{
    public function __invoke()
    {

        $posts = Cache::rememberForever('posts:all', function (){
            return Post::paginate(6);
        });

//        $posts = Post::paginate(6);
        $randomPosts = Post::get()->random(4);
        $likedPostes = Post::withCount('likedUsers')->orderBy('liked_users_count', 'DESC')->get()->take(4);
        $categories = Category::all();
        return view('post.index', compact('posts', 'randomPosts', 'likedPostes', 'categories'));
    }
}
