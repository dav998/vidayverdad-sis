<?php

namespace App\Http\Controllers;

use App\SolVacas;
use App\VacasUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Permiso;
use DateTime;

class VacasController extends Controller
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
        $vacas = VacasUser::where('user_id', $user->id)->get()->first();
        return view('/vacas', compact('vacas', 'user'));
        //return $vacas;
    }
    public function show($id)
    {
        //
    }
    public function create(){
        //
    }
    public function dias(Request $request){
        //

        }

    public function store()
    {
       //
    }

    public function destroy($id)
    {

    }
}
