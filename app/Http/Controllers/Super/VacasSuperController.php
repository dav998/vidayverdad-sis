<?php

namespace App\Http\Controllers\Super;

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
use Illuminate\Support\Facades\DB;
use function MongoDB\Driver\Monitoring\addSubscriber;


class VacasSuperController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('super.vacas.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

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
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
       //
    }
    public function actualizar(){

       VacasUser::increment("anos_trabajados",1);
       VacasUser::where('anos_trabajados', '<=', 5)->update(['dias_totales' => 15]);
       VacasUser::whereBetween('anos_trabajados', [6,10])->update(['dias_totales' => 20]);
       VacasUser::where('anos_trabajados', '>', 10)->update(['dias_totales' => 30]);



        $vacas = VacasUser::all();
        foreach ($vacas as $vaca){

            DB::table('vacas_user')
                ->where('id', $vaca->id)
                ->update(['dias_cuenta' => $vaca->dias_disp,
                    'dias_tomados' => 0]);
        }

        $vacass = VacasUser::all();
        foreach ($vacass as $vacas){

            DB::table('vacas_user')
                ->where('id', $vacas->id)
                ->update(['dias_disp' => $vacas->dias_cuenta + $vacas->dias_totales]);
        }


        return 'amen';




        //return redirect()->route('super.vacas.index')->with('success', 'Vacas actualizado... creo');

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
                //$user->solvacas()->delete();
                $user->delete();
                return redirect()->route('super.usuarios.index')->with('success', 'El Usuario ha sido eliminado.');
            }
            return redirect()->route('super.usuarios.index')->with('Warning', 'Este Usuario no puede ser eliminado.');
        }


    }
}
