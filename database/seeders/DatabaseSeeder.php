<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(3)->create();
        Category::factory(5)->create();
        $tags = Tag::factory(10)->create();
        $posts = Post::factory(10)->create();

        foreach ($posts as $post){
            $tagsIds = $tags->random(5)->pluck('id');
            $post->tags()->attach($tagsIds);
        }


    }
}
