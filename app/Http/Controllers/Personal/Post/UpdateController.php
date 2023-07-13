<?php

namespace App\Http\Controllers\Personal\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Post\UpdateRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UpdateController extends BaseController
{
    public function __invoke(UpdateRequest $request, Post $post)
    {

        $data = $request->validated();
        $post = $this->service->update($data, $post);


        return view('personal.post.show', compact('post'));
    }
}
