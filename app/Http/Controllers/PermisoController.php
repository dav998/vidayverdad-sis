<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Permiso;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class PermisoController extends Controller
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
        $permisos = Permiso::where('user_id', $user->id)->orderBy('created_at', 'DES')->paginate(10);
        return view('/permisos', compact('permisos', 'user'));
    }
    public function show($id)
    {
        $data=Permiso::find($id);
        return view('permisosver',compact('data'));
    }
    public function create(){
        $user = Auth::user();
        return view('crear_permiso', compact('user'));
    }

    public function store()
    {
        //dd($request->all());

        $permiso = new Permiso();

        $permiso ->fecha_ausencia = request('fecha_ausente');
        $permiso ->motivo = request('motivo');
        $permiso ->cargo = request('cargo');
        $permiso ->user_id = request('id');
        $permiso->tipo = 0;
        $permiso->suplente = request('suplente');
        $permiso->aprobado = 0;
        $image = request('imagen');
        if($image != null){
            $image->move('uploads', $image->getClientOriginalName());
            $permiso->url = $image->getClientOriginalName();
        }
        $permiso ->save();

        $infos = DB::table('permisos')
            ->join('users', 'permisos.user_id', '=', 'users.id')
            ->where('permisos.id' , '=', $permiso->id)
            ->select('users.nombre', 'users.cargo', 'permisos.fecha_ausencia', 'permisos.motivo', 'permisos.tipo')
            ->get();

        $mailadm = DB::table('users')
            ->select('users.email')
            ->join('role_user', 'role_user.user_id', '=', 'users.id')
            ->join('roles', 'roles.id', '=', 'role_user.role_id')
            ->where('roles.nombre', '=', 'administrador')
            ->get()->first();

        $maildir = DB::table('users')
            ->select('users.email')
            ->join('role_user', 'role_user.user_id', '=', 'users.id')
            ->join('roles', 'roles.id', '=', 'role_user.role_id')
            ->where('roles.nombre', '=', 'direccion')
            ->get()->first();


        $data = array('infos' => $infos);
        $to_name= 'Direccion';
        $to_mailadm = $mailadm->email;
        $to_maildir = $maildir->email;

        Mail::send('emails.permiso_mail', $data, function ($message) use ($to_name, $to_mailadm){
        $message->to($to_mailadm, $to_name)
            ->subject('Solicitud de Permiso');
        $message->from('ue.vida.verdad@gmail.com', 'Vida y Verdad');
    });

        Mail::send('emails.permiso_mail', $data, function ($message) use ($to_name, $to_maildir){
            $message->to($to_maildir, $to_name)
                ->subject('Solicitud de Permiso');
            $message->from('ue.vida.verdad@gmail.com', 'Vida y Verdad');
        });


        /*$image = $request->file('imagen');
        $image->move('uploads', $image->getClientOriginalName());
        $multimedia->uri = $image->getClientOriginalName();
        $multimedia->id_propiedad = $propiedad->id_propiedad;
        $multimedia->save();*/

       return redirect()->route('permisos.index')->with('success', 'Solicitud Enviada.');
    }

    public function destroy($id)
    {
        $permiso = Permiso::find($id);

                $permiso->delete();
                return redirect()->route('permisos.index')->with('danger', 'La Solicitud ha sido eliminada.');
    }
}
