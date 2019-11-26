<?php

use App\Vacas;
use App\VacasUser;
use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class VacasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Vacas::truncate();
        Vacas::create([
            'tipo'=>'Invierno',

        ]);
        Vacas::create([
            'tipo'=>'Fin de Año',

        ]);

    }
}
