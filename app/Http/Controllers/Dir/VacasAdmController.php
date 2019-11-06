<?php

namespace App\Http\Controllers\Dir;

use App\Permiso;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class VacasAdmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       /* $permisos = Permiso::where('user_id', $user->id)->orderBy('created_at', 'ASC')->paginate(10);
        return view('/permisos', compact('permisos', 'user'));
        $permiso [] = DB::table('permisos')->pluck('user_id');
        $user= User::where('id', $permiso);
        return view('dir.permisos.index', compact('user'))->with('permisos', Permiso::paginate(10));
        //return $permiso;*/
        $datas = DB::table('vacas_user as P')
            ->select('P.anos_trabajados', 'P.dias_totales', 'P.dias_cuenta', 'P.dias_disp', 'U.nombre', 'U.cargo', 'U.ano_ingreso')
            ->whereNotNull('U.ano_ingreso')
            ->join('users as U', 'U.id', '=', 'P.user_id')
            ->orderBy('U.ano_ingreso', 'asc')
            ->get();
        return view('dir.vacaciones.index', compact('datas'));
    }

    public function aproved()
    {
        $datas = DB::table('permisos as P')
            ->select('P.fecha_ausencia', 'P.tipo', 'P.created_at', 'P.cargo', 'P.aprobado', 'U.nombre', 'U.id','P.id as pid')
            ->where('aprobado', 1)
            ->join('users as U', 'U.id', '=', 'P.user_id')
            ->get();
        return view('dir.permisos.aproved', compact('datas'));
        //return 'tonto';

    }

    public function rejected()
    {
        $datas = DB::table('permisos as P')
            ->select('P.fecha_ausencia', 'P.tipo', 'P.created_at', 'P.cargo', 'P.aprobado', 'U.nombre', 'U.id','P.id as pid')
            ->where('aprobado', 2)
            ->join('users as U', 'U.id', '=', 'P.user_id')
            ->get();
        return view('dir.permisos.rejected', compact('datas'));
        //return 'tonto';

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
        $data = Permiso::find($id);
        $user = User::where('id','=',$data->user_id)->get()->first();

        return view('dir.permisos.show', compact('data', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

       /* $data = DB::table('permisos as P')
            ->select('P.id')
            ->join('users as U', 'U.id', '=', 'P.user_id')
            ->get();*/
        //$data = Permiso::select('fecha_ausencia', 'motivo', 'created_at', 'cargo', 'suplente', 'id')->where('user_id', $id)->get();
        //$user = User::select('nombre')->where('id', $id)->get();
        $data = Permiso::find($id);
        $user = User::where('id','=',$data->user_id)->get()->first();

        return view('dir.permisos.edit', compact('data', 'user'));
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


        DB::table('permisos')
            ->where('id', $id)
            ->update(['aprobado' => request('aproved'),
                'observaciones' => request('observacion') ]);
        return redirect()->route('dir.permisos.index')->with('success', 'Solicitud Registrada.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {



    }
}
