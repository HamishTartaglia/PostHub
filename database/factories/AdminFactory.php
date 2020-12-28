<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Admin;
use Faker\Generator as Faker;

$factory->define(Admin::class, function (Faker $faker) 
{
    return [
        'profile_id'=> App\Profile::get()->random()->id,
    ];
});
