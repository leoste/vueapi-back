<?php

use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Post::all()->each(function ($post){
            factory(\App\Image::class, 1)->create(['post_id' => $post->id]);
        });
    }
}
