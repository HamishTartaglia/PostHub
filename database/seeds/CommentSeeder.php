<?php

use Illuminate\Database\Seeder;
use App\Comment;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $comment1 = new Comment();
        $comment1->body = "Welcome!";
        $comment1->profile_id=1;
        $comment1->post_id=1;
        $comment1->save();

    }
}
