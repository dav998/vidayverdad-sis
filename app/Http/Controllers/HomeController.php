<?php

namespace App\Http\Controllers;

use App\User;
use App\VacasUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
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
        return view('home');
    }

    public function perfil()
    {

        $id = Auth::user()->id;
        $user = User::find($id);

        return view('perfil', compact('user'));
    }
}
