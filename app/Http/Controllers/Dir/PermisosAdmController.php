<?php

namespace App\Http\Controllers\Dir;

use App\Permiso;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


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
        //$users= DB::table('users')->get();
        $user= User::where('id', $permiso);
        return view('dir.permisos.index', compact('user'))->with('permisos', Permiso::paginate(10));
        //return $permiso;*/
        $datas = DB::table('permisos as P')
            ->select('P.fecha_ausencia', 'P.created_at', 'P.cargo', 'P.aprobado', 'U.nombre')
            ->join('users as U', 'U.id', '=', 'P.user_id')
            ->get();
        return view('dir.permisos.index', compact('datas'));
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



    }
}
