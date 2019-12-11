<?php

namespace App\Http\Controllers\Super;

use App\Asistencia;
use App\Horario;
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


class UserHoraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('super.userhora.index')->with('users', User::paginate(10));
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
        return view('super.userhora.edit')->with(['user' => User::find($id), 'horarios' => Horario::all()]);
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
        if(is_null($request->horarios)){
            return redirect()->route('super.userhora.index')->with('warning', 'Los usuarios no pueden estar sin un horario asignado.');
        }
        if(Auth::user()->id == $id){
            return redirect()->route('super.userhora.index')->with('warning', 'No puede editarse a usted mismo.');
        }

        $user = User::find($id);
        $user->horarios()->sync($request->horarios);

        return redirect()->route('super.userhora.index')->with('success', 'Horarios de usuario actualizados.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

//

    }
}
