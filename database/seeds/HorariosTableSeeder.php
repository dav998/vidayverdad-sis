<?php

use App\Horario;
use Illuminate\Database\Seeder;
use App\Role;
class HorariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Horario::truncate();
        Horario::create(['nombre'=>'ADM-1',
            'dias'=>'Lunes Martes',
            'hora_ingreso'=>'08:00',
            'hora_salida'=>'13:00']);
    }
}
