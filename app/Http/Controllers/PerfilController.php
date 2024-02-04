<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PerfilController extends Controller
{
    public function index(){
        return view('perfil.index');
    }

    public function actualizar(Request $request){
        $validated = $request->validate([
            'email'     => 'required',
            'telefono'  => 'required',
            'direccion' => 'required'
        ]);
        
        $nombre_imagen = time().'.'.$request->avatar->extension();

        // Public Folder
        $request->avatar->move(public_path('avatar'), $nombre_imagen);
        
        $usuario = User::find(Auth::user()->id);
        $usuario->email = $request->email;
        $usuario->telefono = $request->telefono;
        $usuario->direccion = $request->direccion;
        $usuario->avatar = $nombre_imagen;
        $usuario->save();
        return redirect()->route('perfil.index');
    }

    public function password(){
        return view('perfil.password');
    }

    public function password_actualizar(Request $request){
        $validated = $request->validate([
            'password'              => 'required',
            'password_nuevo'        => 'required',
            'password_nuevo_verif'  => 'required|same:password_nuevo'
        ]);

        $usuario = User::find(Auth::user()->id);
        if (Hash::check($request->password, $usuario->password)) {
            $usuario->password = Hash::make($request->password_nuevo);
            $usuario->save();
            Auth::logout();
        }
        return redirect()->route('password');
    }

}
