<?php

use App\Horario;
use App\Role;
use App\User;
use App\VacasUser;
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
        'ano_ingreso' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'remember_token' => str_random(10),
    ];
});

$factory->afterCreating(User::class, function ($user, $faker){
    $roles = Role::where('nombre','profesor')->get();
    $user->roles()->sync($roles->pluck('id')->toArray());

    $horarios = Horario::where('nombre','ADM-1')->get();
    $user->horarios()->sync($horarios->pluck('id')->toArray());


    $vacas = new VacasUser();
    $dias_disp = 2;
    $dias_disp1 = 2;
    $anoinsep = explode("-", $user->ano_ingreso);
    $mytime = date('Y-m-d');
    $anoactsep = explode("-", $mytime);
    $anoactual = $anoactsep[0];
    $anoingreso = $anoinsep[0];
    $anostrabajados = $anoactual - $anoingreso;

    if($anostrabajados > 0 and $anostrabajados <= 5){
        $dias_disp = $dias_disp + 15;
        $dias_totales=15;
    }else{
        if($anostrabajados > 5 and $anostrabajados <= 10){
            $dias_disp = $dias_disp + 20;
            $dias_totales=20;
        }else
        {
            if($anostrabajados > 10){

                $dias_disp = $dias_disp + 30;
                $dias_totales=30;

            }else{
                $dias_disp = 0;
                $dias_totales=0;
            }
        }


    }
    $vacas->user_id = $user->id;
    $vacas->dias_cuenta= $dias_disp1;
    $vacas->anos_trabajados = $anostrabajados;
    $vacas->dias_totales = $dias_totales;
    $vacas->dias_disp = $dias_disp;
    $vacas->dias_tomados = 0;
    $vacas->save();


});
