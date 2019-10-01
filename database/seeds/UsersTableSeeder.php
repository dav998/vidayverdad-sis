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
        $adminRole = Role::where('nombre', 'admin')->first();
        $subadminRole = Role::where('nombre', 'subadmin')->first();
        $direccionRole = Role::where('nombre', 'direccion')->first();
        $secretaria_dirRole = Role::where('nombre', 'secretaria_dir')->first();
        $sistemasRole = Role::where('nombre', 'sistemas')->first();
        $supervisorRole = Role::where('nombre', 'supervisor')->first();
        $profesorRole = Role::where('nombre', 'profesor')->first();
        $recepcionRole = Role::where('nombre', 'recepcion')->first();

        $admin = User::create([
            'nombre'=>'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin')
        ]);

        $subadmin = User::create([
            'nombre'=>'Subadmin',
            'email' => 'subadmin@subadmin.com',
            'password' => bcrypt('subadmin')
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
            'nombre'=>'Super',
            'email' => 'super@super.com',
            'password' => bcrypt('super')
        ]);

        $profesor = User::create([
            'nombre'=>'Profe',
            'email' => 'profe@profe.com',
            'password' => bcrypt('profe')
        ]);

        $recepcion = User::create([
            'nombre'=>'Recepcion',
            'email' => 'recep@recep.com',
            'password' => bcrypt('recep')
        ]);

        $admin->roles()->attach($adminRole);
        $subadmin->roles()->attach($subadminRole);
        $direccion->roles()->attach($direccionRole);
        $secretaria_dir->roles()->attach($secretaria_dirRole);
        $sistemas->roles()->attach($sistemasRole);
        $supervisor->roles()->attach($supervisorRole);
        $profesor->roles()->attach($profesorRole);
        $recepcion->roles()->attach($recepcionRole);

        factory(User::class, 10)->create();
    }
}
