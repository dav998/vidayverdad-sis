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
        $recepcionRole = Role::where('nombre', 'recepcion')->first();

        $super = User::create([
            'nombre'=>'SuperSU',
            'email' => 'super@super.com',
            'password' => bcrypt('super')
        ]);

        $admin = User::create([
            'nombre'=>'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin')
        ]);

        $direccion = User::create([
            'nombre'=>'Dir',
            'email' => 'dir@dir.com',
            'password' => bcrypt('dir')
        ]);

        $secretaria_dir = User::create([
            'nombre'=>'Secre',
            'email' => 'secre@secre.com',
            'password' => bcrypt('secre')
        ]);

        $sistemas = User::create([
            'nombre'=>'Sistemas',
            'email' => 'sis@sis.com',
            'password' => bcrypt('sis')
        ]);

        $supervisor = User::create([
            'nombre'=>'Supervisor',
            'email' => 'supervisor@supervisor.com',
            'password' => bcrypt('supervisor')
        ]);

        $personal = User::create([
            'nombre'=>'personal',
            'email' => 'personal@profe.com',
            'password' => bcrypt('personal')
        ]);

        $recepcion = User::create([
            'nombre'=>'Recepcion',
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
        $recepcion->roles()->attach($recepcionRole);

        factory(User::class, 10)->create();
    }
}
