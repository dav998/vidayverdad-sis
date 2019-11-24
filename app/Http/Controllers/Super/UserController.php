<?php

namespace App\Http\Controllers\Super;

use App\Asistencia;
use App\Permiso;
use App\Role;
use App\RoleUser;
use App\SolVacas;
use App\User;
use App\VacasUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('super.usuarios.index')->with('users', User::paginate(10));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('super.usuarios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User();

        $user ->nombre = request('nombre');
        $user ->ci = request('ci');
        $user ->cargo = request('cargo');
        $user ->ano_ingreso = request('ano_ingreso');
        $user->email = request('email');
        $password = request('password');
        $password2 = request('passwords');

        if( $password != $password2){
            return redirect()->route('super.usuarios.create')->withInput()->with('warning', 'Las contraseñas no coinciden');
        }else{
            $user->password = bcrypt(request('password'));
        }
        $user ->save();
        $dias_disp = request('dias_disp');
        $dias_disp1 = request('dias_disp');
        $newuser = User::where('ci', '=', request('ci'))->get()->first();
        $vacas = new VacasUser();
        $anoinsep = explode("-", $newuser->ano_ingreso);
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
        $vacas->user_id = $newuser->id;
        $vacas->dias_cuenta= $dias_disp1;
        $vacas->anos_trabajados = $anostrabajados;
        $vacas->dias_totales = $dias_totales;
        $vacas->dias_disp = $dias_disp;
        $vacas->dias_tomados = 0;
        $vacas->save();

        $role = new RoleUser();
        $role->user_id = $newuser->id;
        $role->role_id = request('rol');
        $role->save();

        return redirect()->route('super.usuarios.create')->with('success', 'Usuario Registrado');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()->id == $id){
            return redirect()->route('super.usuarios.index')->with('warning', 'No puede editarse a usted mismo.');
        }
        return view('super.usuarios.edit')->with(['user' => User::find($id), 'roles' => Role::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(is_null($request->roles)){
            return redirect()->route('super.usuarios.index')->with('warning', 'Los usuarios no pueden estar sin un rol asignado.');
        }
        if(Auth::user()->id == $id){
            return redirect()->route('super.usuarios.index')->with('warning', 'No puede editarse a usted mismo.');
        }

        $user = User::find($id);
        $user->roles()->sync($request->roles);

        return redirect()->route('super.usuarios.index')->with('success', 'Rol de usuario actualizado.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if($user->id == 1){
            return redirect()->route('super.usuarios.index')->with('danger', 'No puede eliminar al super usuario.');
        }else{
            if(Auth::user()->id == $id){
                return redirect()->route('super.usuarios.index')->with('warning', 'No puede eliminarse a usted mismo.');
            }

            if($user){
                $user->roles()->detach();
                Permiso::where('user_id', $id)->delete();
                VacasUser::where('user_id', $id)->delete();
                //$user->permisos()->detach();
                //$user->vacas()->detach();
                SolVacas::where('user_id', $id)->delete();
                Asistencia::where('user_id', $id)->delete();
                //$user->solvacas()->delete();
                $user->delete();
                return redirect()->route('super.usuarios.index')->with('success', 'El Usuario ha sido eliminado.');
            }
            return redirect()->route('super.usuarios.index')->with('Warning', 'Este Usuario no puede ser eliminado.');
        }


    }
}
