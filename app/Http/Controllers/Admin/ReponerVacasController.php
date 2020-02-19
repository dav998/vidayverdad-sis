<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\VacasUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Permiso;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ReponerVacasController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        return view('/admin.reponer_vacas');
    }
    public function buscar(){

        $ci = request('ci');
        $user = User::where('ci','=',$ci)->get()->first();
        $userv = User::where('ci','=',$ci)->get()->toArray();


       if(count($userv) === 0){
           return redirect()->action('Admin\ReponerVacasController@index')->with('warning', 'Verifique el C.I. Usuario no encontrado');
           // return view('/pre_tolerancia')->with('success', 'Verifique el C.I. Usuario no encontrado');
        }else{
           $vacas = VacasUser::where('user_id','=',$user->id)->get()->first();
           if($vacas->dias_tomados == 0){
               return redirect()->action('Admin\ReponerVacasController@index')->with('warning', 'El usuario '.$user->nombre.' no tomó vacaciones para poder reponer o restarle dias');
           }else{
               return view('admin.reponer_restar', compact('user'));
           }

        }


    }
    public function show($id)
    {

    }
    public function create(){

    }
    public function reponer($id){

        $dias = request('dias');
        $vacas = VacasUser::where('user_id','=',$id)->get()->first();
        $dias_tomados = $vacas->dias_tomados;
        $dias_disp = $vacas->dias_disp;

        $re_dias_tom = $dias_tomados - $dias;
        $re_dias_disp =   $dias_disp + $dias;

        if($re_dias_tom < 0){
            return redirect()->action('Admin\ReponerVacasController@index')->withInput()->with('danger', 'No puede reponer más días de los que el usuario tomó.');
        }else{
            DB::table('vacas_user')
                ->where('user_id', $id)
                ->update(['dias_tomados' => $re_dias_tom,
                    'dias_disp' => $re_dias_disp]);

            DB::table('solicitud_vacas')
                ->where('user_id', $id)
                ->update(['dias' => $re_dias_tom]);


            return redirect()->action('Admin\ReponerVacasController@index')->with('success', 'Datos actualizados');
        }





    }
    public function store()
    {
        //dd($request->all());
        $id = request('ci');
        $user = User::where('ci','=',$id)->get()->first();
        
        $permiso = new Permiso();

        $permiso ->fecha_ausencia = request('fecha_ausente');
        $permiso ->motivo = request('motivo');
        $permiso ->cargo = request('cargo');
        $permiso ->user_id = $user->id;
        $permiso ->tipo = request('tipo');
        $permiso->suplente = request('suplente');
        $permiso->aprobado = 0;
        $permiso ->save();

        /*$image = $request->file('imagen');
        $image->move('uploads', $image->getClientOriginalName());
        $multimedia->uri = $image->getClientOriginalName();
        $multimedia->id_propiedad = $propiedad->id_propiedad;
        $multimedia->save();*/

        $infos = DB::table('permisos')
            ->join('users', 'permisos.user_id', '=', 'users.id')
            ->where('permisos.id' , '=', $permiso->id)
            ->select('users.nombre', 'users.cargo', 'permisos.fecha_ausencia', 'permisos.motivo', 'permisos.tipo')
            ->get();


        $data = array('infos' => $infos);
        $to_name= 'Direccion';
        $to_mail = 'daalfaro96@gmail.com';

        Mail::send('emails.permiso_mail', $data, function ($message) use ($to_name, $to_mail){
            $message->to($to_mail, $to_name)
                ->subject('Solicitud de Permiso');
            $message->from('ue.vida.verdad@gmail.com', 'Vida y Verdad');
        });


        return redirect()->route('tolerancias.index')->with('success', 'Solicitud Enviada.');
    }
}
