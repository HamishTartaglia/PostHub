<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Profile;
use Faker\Generator as Faker;

$factory->define(Profile::class, function (Faker $faker) 
{
    return [
        'username' => $faker->userName,
        'bio' =>$faker->sentence(3),
        'user_id' => factory(App\User::class)->create()->id,
    ];
});
