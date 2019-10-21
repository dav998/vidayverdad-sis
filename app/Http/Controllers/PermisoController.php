<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Permiso;

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
        $permiso->tipo = request('tipo');
        $permiso->suplente = request('suplente');
        $permiso->aprobado = 0;
        $permiso ->save();

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
