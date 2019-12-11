<?php

namespace App\Http\Controllers\Super;

use App\Asistencia;
use App\Horario;
use App\HorarioUser;
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


class HorarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('super.horarios.index')->with('horarios', Horario::paginate(10));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('super.horarios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $hora1 = request('hora_ini');
        $hora2 = request('hora_fin');

        if(is_null(request('dias'))){
            return redirect()->route('super.horarios.create')->withInput()->with('warning', 'El horario no pueden estar sin un dia asignado.');
        }
        if($hora1 > $hora2){
            return redirect()->route('super.horarios.create')->withInput()->with('warning', 'La hora de entrada no puede ser después de la hora de salida.');
        }
       $horario = new Horario();
       $horario->nombre = request('nombre');
        $weekday_string = implode(" ", $request->input('dias'));
        $request->merge(array('weekday', $weekday_string));
        $horario->dias = $weekday_string;
        $horario->hora_ingreso = request('hora_ini');
        $horario->hora_salida = request('hora_fin');

        $horario->save();

        return redirect()->route('super.horarios.create')->with('success', 'Horario Registrado');

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
       return view('super.horarios.edit')->with(['horario' => Horario::find($id)]);
       // return 'editar';
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
        /*$this->validate($request,[ 'hora_ini'=>'required|date_format:H:i',
            'hora_fin'=>'required|date_format:H:i|after:hora_ini',]);*/
        $hora1 = request('hora_ini');
        $hora2 = request('hora_fin');

        if(is_null(request('dias'))){
            return redirect()->route('super.horarios.edit', $id)->with('warning', 'El horario no pueden estar sin un dia asignado.');
        }
        if($hora1 > $hora2){
            return redirect()->route('super.horarios.edit', $id)->with('warning', 'La hora de entrada no puede ser después de la hora de salida.');
        }
        $weekday_string = implode(" ", $request->input('dias'));
        $request->merge(array('weekday', $weekday_string));

        DB::table('horarios')
            ->where('id', $id)
            ->update(['nombre' => request('nombre'),
                'hora_ingreso' => request('hora_ini'),
                'hora_salida' => request('hora_fin'),
                'dias' => $weekday_string]);
        /*$user = User::find($id);
        $user->roles()->sync($request->roles);*/

        return redirect()->route('super.horarios.index')->with('success', 'Horario actualizado.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $horario = Horario::find($id);

               /* $user->roles()->detach();
                HorarioUser::where('horario_id', $id)->delete();
                $horario->delete();
                return redirect()->route('super.usuarios.index')->with('success', 'El Usuario ha sido eliminado.');*/
            return 'eliminado';



    }
}
