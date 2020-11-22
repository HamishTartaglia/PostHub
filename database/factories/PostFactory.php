<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) 
{
    return [
        'title' => $faker->sentence,
        'body' => $faker->paragraph,
        'profile_id' => App\Profile::get()->random()->id,
        'category_id' => App\Category::get()->random()->id,
    ];
});
