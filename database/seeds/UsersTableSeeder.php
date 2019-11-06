<?php

use App\VacasUser;
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
            'cargo' => 'Super Usuario',
            'password' => bcrypt('super')
        ]);

        $admin = User::create([
            'nombre'=>'admin',
            'ci' => '1111111',
            'cargo' => 'Administracion',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin')
        ]);

        $direccion = User::create([
            'nombre'=>'Dir',
            'ci' => '2222222',
            'cargo' => 'Direccion',
            'email' => 'dir@dir.com',
            'password' => bcrypt('dir')
        ]);

        $secretaria_dir = User::create([
            'nombre'=>'Secre',
            'ci' => '3333333',
            'cargo'=>'Secretaria',
            'email' => 'secre@secre.com',
            'password' => bcrypt('secre')
        ]);

        $sistemas = User::create([
            'nombre'=>'Sistemas',
            'email' => 'sis@sis.com',
            'ci' => '4444444',
            'cargo'=>'Sistemas',
            'password' => bcrypt('sis')
        ]);

        $supervisor = User::create([
            'nombre'=>'Supervisor',
            'ci' => '5555555',
            'cargo'=>'Supervisor',
            'email' => 'supervisor@supervisor.com',
            'password' => bcrypt('supervisor')
        ]);

        $personal = User::create([
            'nombre'=>'personal',
            'ci' => '6666666',
            'cargo'=>'Limpieza',
            'email' => 'personal@personal.com',
            'password' => bcrypt('personal')
        ]);

        $profesor = User::create([
            'nombre'=>'profesor',
            'ci' => '88888888',
            'cargo' => 'Profesor Matematicas',
            'email' => 'profe@profe.com',
            'password' => bcrypt('profesor')
        ]);

        $recepcion = User::create([
            'nombre'=>'Aleida',
            'ci' => '7777777',
            'cargo'=>'Recepcion',
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

       /* $vacas = new VacasUser();
        $dias_disp = 2;
        $anoinsep = explode("-", $admin->ano_ingreso);
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
        $vacas->user_id = $admin->id;
        $vacas->anos_trabajados = $anostrabajados;
        $vacas->dias_totales = $dias_totales;
        $vacas->dias_disp = $dias_disp;
        $vacas->save();*/

        factory(User::class, 10)->create();
    }
}
