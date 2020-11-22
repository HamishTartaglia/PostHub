<?php

use Illuminate\Database\Seeder;
use App\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $post1 = new Post();
        $post1->title = "My First Post";
        $post1->body = "OMG! This is my first post, cant wait to post more";
        $post1->profile_id = 1;
        $post1->category_id = 1;
        $post1->save();

        $post1->tags()->attach(1);
        $post1->tags()->attach(2);

    }
}
