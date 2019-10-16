<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        DB::table('role_user')->truncate();
        $superRole = Role::where('nombre', 'super')->first();
        $adminRole = Role::where('nombre', 'administrador')->first();
        $direccionRole = Role::where('nombre', 'direccion')->first();
        $secretaria_dirRole = Role::where('nombre', 'secretaria_dir')->first();
        $sistemasRole = Role::where('nombre', 'sistemas')->first();
        $supervisorRole = Role::where('nombre', 'supervisor')->first();
        $personalRole = Role::where('nombre', 'personal')->first();
        $profesorRole = Role::where('nombre', 'profesor')->first();
        $recepcionRole = Role::where('nombre', 'recepcion')->first();

        $super = User::create([
            'nombre'=>'SuperSU',
            'ci' => '0',
            'email' => 'super@super.com',
            'password' => bcrypt('super')
        ]);

        $admin = User::create([
            'nombre'=>'admin',
            'ci' => '1111111',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin')
        ]);

        $direccion = User::create([
            'nombre'=>'Dir',
            'ci' => '2222222',
            'email' => 'dir@dir.com',
            'password' => bcrypt('dir')
        ]);

        $secretaria_dir = User::create([
            'nombre'=>'Secre',
            'ci' => '3333333',
            'email' => 'secre@secre.com',
            'password' => bcrypt('secre')
        ]);

        $sistemas = User::create([
            'nombre'=>'Sistemas',
            'email' => 'sis@sis.com',
            'ci' => '4444444',
            'password' => bcrypt('sis')
        ]);

        $supervisor = User::create([
            'nombre'=>'Supervisor',
            'ci' => '5555555',
            'email' => 'supervisor@supervisor.com',
            'password' => bcrypt('supervisor')
        ]);

        $personal = User::create([
            'nombre'=>'personal',
            'ci' => '6666666',
            'email' => 'personal@personal.com',
            'password' => bcrypt('personal')
        ]);

        $profesor = User::create([
            'nombre'=>'personal',
            'ci' => '88888888',
            'email' => 'profe@profe.com',
            'password' => bcrypt('profesor')
        ]);

        $recepcion = User::create([
            'nombre'=>'Recepcion',
            'ci' => '7777777',
            'email' => 'recep@recep.com',
            'password' => bcrypt('recep')
        ]);

        $super->roles()->attach($superRole);
        $admin->roles()->attach($adminRole);
        $direccion->roles()->attach($direccionRole);
        $secretaria_dir->roles()->attach($secretaria_dirRole);
        $sistemas->roles()->attach($sistemasRole);
        $supervisor->roles()->attach($supervisorRole);
        $personal->roles()->attach($personalRole);
        $profesor->roles()->attach($profesorRole);
        $recepcion->roles()->attach($recepcionRole);

        factory(User::class, 10)->create();
    }
}
