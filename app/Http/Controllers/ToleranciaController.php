<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Permiso;

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
        return view('/crear_tolerancia');
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
        $permiso->suplente = request('suplente');
        $permiso->aprobado = 0;
        $permiso ->save();

        /*$image = $request->file('imagen');
        $image->move('uploads', $image->getClientOriginalName());
        $multimedia->uri = $image->getClientOriginalName();
        $multimedia->id_propiedad = $propiedad->id_propiedad;
        $multimedia->save();*/
       return redirect()->route('tolerancias.index')->with('success', 'Solicitud Enviada.');
    }
}
