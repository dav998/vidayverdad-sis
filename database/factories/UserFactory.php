<?php

use App\Role;
use App\User;
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
    return [
        'nombre' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'ci' => $faker->unique()->randomNumber($nbDigits = 7),
        'cargo'=>$faker->randomElement(['Profesor Biologia', 'Profesor Matematica', 'Profesor Literatura']),
        'password' => bcrypt('personal'), // secret
        'ano_ingreso' => $faker->date(),
        'remember_token' => str_random(10),
    ];
});

$factory->afterCreating(User::class, function ($user, $faker){
    $roles = Role::where('nombre','profesor')->get();
    $user->roles()->sync($roles->pluck('id')->toArray());

});
