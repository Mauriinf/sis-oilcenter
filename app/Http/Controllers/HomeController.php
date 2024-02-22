<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\publicacion;
use App\Http\Controllers\Controller;
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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::all();

        return view('home', compact('users'));
    }
    public function inicio(){
        $publicaciones = publicacion::where('estado', '=', 'Activo')->get();

        return view('welcome', compact('publicaciones'));
    }
    public function  calendario(){
        return view('calendario');
    }
}
