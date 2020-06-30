<?php

namespace App\Http\Controllers\Dir;

use App\Permiso;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;


class PermisosAdmController extends Controller
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
        $datas = DB::table('permisos as P')
            ->select('P.fecha_ausencia', 'P.tipo', 'P.created_at', 'P.cargo', 'P.aprobado', 'U.nombre', 'U.id','P.id as pid')
            ->where('aprobado', 0)
            ->join('users as U', 'U.id', '=', 'P.user_id')
            ->orderBy('P.created_at', 'DESC')
            ->paginate(10);
        return view('dir.permisos.index', compact('datas'));
    }

    public function aproved()
    {
        $datas = DB::table('permisos as P')
            ->select('P.fecha_ausencia', 'P.tipo', 'P.created_at', 'P.cargo', 'P.aprobado', 'U.nombre', 'U.id','P.id as pid')
            ->where('aprobado', 1)
            ->join('users as U', 'U.id', '=', 'P.user_id')
            ->orderBy('P.created_at', 'DESC')
            ->paginate(10);
        return view('dir.permisos.aproved', compact('datas'));
        //return 'tonto';

    }

    public  function pre_permisos(){

        return view('dir.permisos.pre_permisos');
    }

    public function reporte(){

        $year = request('year');
        $year2 = request('year2');

      /*  $datas = DB::table('permisos as P')
            ->select('U.nombre', 'U.cargo',
            DB::raw('sum((case when P.aprobado =  1  then 1 else 0 end)) as aprobado'),
            DB::raw('sum((case when P.aprobado =  2  then 1 else 0 end)) as rechazado'),
                DB::raw('sum((case when P.aprobado =  0  then 1 else 0 end)) as espera'),
                DB::raw('sum((case when P.tipo =  0  then 1 else 0 end)) as permiso'),
                DB::raw('sum((case when P.tipo =  1  then 1 else 0 end)) as tole'),
                DB::raw('sum((case when P.tipo =  2  then 1 else 0 end)) as sal'),
                DB::raw('count(P.user_id) as solicitudes_enviadas'))
            ->join('users as U', 'U.id', '=', 'P.user_id')
            ->groupBy('U.nombre', 'U.cargo')
            ->get();
       return view('dir.permisos.reporte', compact('datas'));*/
      if(is_null($year)){

          $datas = DB::table('permisos as P')
              ->select('U.nombre', 'U.cargo',
                  DB::raw('sum((case when P.aprobado =  1  then 1 else 0 end)) as aprobado'),
                  DB::raw('sum((case when P.aprobado =  2  then 1 else 0 end)) as rechazado'),
                  DB::raw('sum((case when P.aprobado =  0  then 1 else 0 end)) as espera'),
                  DB::raw('sum((case when P.tipo =  0  then 1 else 0 end)) as permiso'),
                  DB::raw('sum((case when P.tipo =  1  then 1 else 0 end)) as tole'),
                  DB::raw('sum((case when P.tipo =  2  then 1 else 0 end)) as sal'),
                  DB::raw('count(P.user_id) as solicitudes_enviadas'))
              ->join('users as U', 'U.id', '=', 'P.user_id')
              ->groupBy('U.nombre', 'U.cargo')
              ->get();
          return view('dir.permisos.reporte', compact('datas'));
      }else{
          $datas = DB::table('permisos as P')
              ->select('U.nombre', 'U.cargo',
                  DB::raw('sum((case when P.aprobado =  1  then 1 else 0 end)) as aprobado'),
                  DB::raw('sum((case when P.aprobado =  2  then 1 else 0 end)) as rechazado'),
                  DB::raw('sum((case when P.aprobado =  0  then 1 else 0 end)) as espera'),
                  DB::raw('sum((case when P.tipo =  0  then 1 else 0 end)) as permiso'),
                  DB::raw('sum((case when P.tipo =  1  then 1 else 0 end)) as tole'),
                  DB::raw('sum((case when P.tipo =  2  then 1 else 0 end)) as sal'),
                  DB::raw('count(P.user_id) as solicitudes_enviadas'))
              ->whereYear('P.created_at', '=', $year)
              ->join('users as U', 'U.id', '=', 'P.user_id')
              ->groupBy('U.nombre', 'U.cargo')
              ->get();
          return view('dir.permisos.reporte', compact('datas'));

      }


    }


    public function rejected()
    {
        $datas = DB::table('permisos as P')
            ->select('P.fecha_ausencia', 'P.tipo', 'P.created_at', 'P.cargo', 'P.aprobado', 'U.nombre', 'U.id','P.id as pid')
            ->where('aprobado', 2)
            ->join('users as U', 'U.id', '=', 'P.user_id')
            ->orderBy('P.created_at', 'DESC')
            ->paginate(10);
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


        $infos = DB::table('permisos')
            ->join('users', 'permisos.user_id', '=', 'users.id')
            ->where('permisos.id' , '=', $id)
            ->select('users.email','users.nombre', 'users.cargo', 'permisos.fecha_ausencia', 'permisos.motivo', 'permisos.tipo','permisos.aprobado', 'permisos.observaciones')
            ->get();


        $data = array('infos' => $infos);
        $to_name= 'Direccion';
        foreach ($infos as $info){
            $to_mail = $info->email;
        }


        Mail::send('emails.permiso_mail_user', $data, function ($message) use ($to_name, $to_mail){
            $message->to($to_mail, $to_name)
                ->subject('Solicitud de Permiso');
            $message->from('ue.vida.verdad@gmail.com', 'Vida y Verdad');
        });


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
