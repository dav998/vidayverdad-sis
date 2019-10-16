<?php

use Illuminate\Database\Seeder;
use App\Role;
class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::truncate();
        Role::create(['nombre'=>'super']);
        Role::create(['nombre'=>'administrador']);
        Role::create(['nombre'=>'direccion']);
        Role::create(['nombre'=>'secretaria_dir']);
        Role::create(['nombre'=>'sistemas']);
        Role::create(['nombre'=>'supervisor']);
        Role::create(['nombre'=>'profesor']);
        Role::create(['nombre'=>'personal']);
        Role::create(['nombre'=>'recepcion']);
    }
}
