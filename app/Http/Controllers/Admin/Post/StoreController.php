<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Post\StoreRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        try {
            $data = $request->validated();
            $tagIds = $data['tag_ids'];
            unset($data['tag_ids']);
            //шлях до картинок в бд зі збереженням клучів
            $data['preview_image'] = Storage::put('/images', $data['preview_image']);
            $data['main_image'] = Storage::put('/images', $data['main_image']);

            // якщо хочемо, дати можливість додання поста без тегів
            //$post->tags()->sync((isset($data['tag_ids']))? $data['tag_ids'] : []);
            $post = Post::firstOrCreate($data);
            $post->tags()->attach($tagIds);
        } catch (\Exception $exception){
            abort(404);
        }
        return redirect()->route('admin.post.index');
    }
}
