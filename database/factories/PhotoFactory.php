<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Photo;
use Faker\Generator as Faker;

$factory->define(Photo::class, function (Faker $faker) 
{
    $photoable = [
        App\Post::class,
        App\Profile::class,
    ];
    $photoableType = $faker->randomElement($photoable);
    if ($photoableType === App\Post::class) {
        $photoableId = App\Post::get()->random()->id;
    } else {
        $photoableId = App\Profile::get()->random()->id;
    }

    return [
        'filename' => $faker->image('public/images', 200, 200),
        'photoable_type' => $photoableType,
        'photoable_id' => $photoableId,
    ];
});
