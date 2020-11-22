<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) 
{
    return [
        'body'=> $faker->sentence,
        'profile_id'=> App\Profile::get()->random()->id,
        'post_id'=> App\Post::get()->random()->id,
    ];
});
