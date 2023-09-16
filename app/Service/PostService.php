<?php

namespace App\Service;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PostService
{
    public function store($data){
        try {
            DB::beginTransaction();
            if (isset($data['tag_ids'])) {
                $tagIds = $data['tag_ids'];
                unset($data['tag_ids']);
            } else {
                $tagIds = [];
            }

            $data['preview_image'] = Storage::disk('public')->put('/images', $data['preview_image']);
            $data['main_image'] = Storage::disk('public')->put('/images', $data['main_image']);
            $data['user_id'] = Auth::id();
            $post = Post::firstOrCreate($data);
            if (isset($tagIds)) {
                $post->tags()->attach($tagIds);
            }
            DB::commit();
        } catch (\Exception $exception){
            DB::rollBack();
            abort(500);
        }
    }

    public function update($data, $post){
        try {
            DB::beginTransaction();
            if (isset($data['tag_ids'])) {
                $tagIds = $data['tag_ids'];
                unset($data['tag_ids']);
            } else {
                $tagIds = [];
            }

            if (array_key_exists('preview_image', $data)) {
                $data['preview_image'] = Storage::disk('public')->put('/images', $data['preview_image']);
            }
            if (array_key_exists('main_image', $data)) {
                $data['main_image'] = Storage::disk('public')->put('/images', $data['main_image']);
            }
            $post->update($data);
            if (isset($tagIds)) {
                $post->tags()->sync($tagIds);
            }
            DB::commit();
        } catch (\Exception $exception){
            DB::rollBack();
            abort(500);
        }
        return $post;
    }

}
