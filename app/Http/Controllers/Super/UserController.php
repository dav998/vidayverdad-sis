<?php

namespace App\Http\Controllers\Super;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('super.usuarios.index')->with('users', User::paginate(10));
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
        $user = User::find($id);
        if($user->id == 1){
            return redirect()->route('super.usuarios.index')->with('danger', 'No puede eliminar al super usuario.');
        }else{
            if(Auth::user()->id == $id){
                return redirect()->route('super.usuarios.index')->with('warning', 'No puede eliminarse a usted mismo.');
            }

            if($user){
                $user->roles()->detach();
                $user->delete();
                return redirect()->route('super.usuarios.index')->with('success', 'El Usuario ha sido eliminado.');
            }
            return redirect()->route('super.usuarios.index')->with('Warning', 'Este Usuario no puede ser eliminado.');
        }


    }
}
