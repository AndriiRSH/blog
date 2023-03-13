<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Post\UpdateRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, Post $post)
    {
        // якщо хочемо, дати можливість додання поста без тегів
        //$post->tags()->sync((isset($data['tag_ids']))? $data['tag_ids'] : []);
        $data = $request->validated();
        $post->update($data);
        return view('admin.post.show', compact('post'));
    }
}
