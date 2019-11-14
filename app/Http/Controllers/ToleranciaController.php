<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Permiso;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ToleranciaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        return view('/pre_tolerancia');
    }
    public function buscar(){

        $ci = request('ci');
        $user = User::where('ci','=',$ci)->get()->first();
        $userv = User::where('ci','=',$ci)->get()->toArray();
       if(count($userv) === 0){
           return redirect()->action('ToleranciaController@index')->with('warning', 'Verifique el C.I. Usuario no encontrado');
           // return view('/pre_tolerancia')->with('success', 'Verifique el C.I. Usuario no encontrado');
        }else{
            return view('/crear_tolerancia', compact('user'));
        }


    }
    public function show($id)
    {

    }
    public function create(){

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
