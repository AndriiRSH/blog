<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\UpdateRequest;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    public function __invoke(User $user)
    {
        $posts = Post::where('user_id', $user->id)->get();

        foreach ($posts as $post) {
            $post->delete();
        }

        $user->delete();
        return redirect()->route('admin.user.index');
    }
}
