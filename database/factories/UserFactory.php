<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    $data_time = $faker->date . ' ' . $faker->time;
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$qGWXwtn7r7ogO6A5OJKzoud2FCaNG.yJN9i0kyIaXZ7ToV34Gf/Sy', // password 12345678
        'remember_token' => Str::random(10),
        'introduction' => $faker->sentence(),
        'created_at' => $data_time,
        'updated_at' => $data_time,
    ];
});
