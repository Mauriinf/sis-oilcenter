<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Especialidad;
use Spatie\Permission\Models\Role;
use Hash;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
class UserController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:lista-usuarios|registrar-usuarios|editar-usuarios|eliminar-usuarios', ['only' => ['index','store']]);
         $this->middleware('permission:registrar-usuarios', ['only' => ['create','store']]);
         $this->middleware('permission:editar-usuarios', ['only' => ['edit','update']]);
         $this->middleware('permission:eliminar-usuarios', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {

       $user= Auth::user();
       $data = User::all();
        return view('admin.users.index',compact(['data']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('admin.users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|unique:users,username',
            'email' => 'required|email',
            'nombres' => 'required|regex:/^[\pL\s]+$/u',
            'paterno'=> 'nullable|regex:/^[\pL\s]+$/u',
            'materno'=> 'nullable|regex:/^[\pL\s]+$/u',
            'ci' => 'required|unique:users,ci',
            'password' => 'required|same:confirm-password',
            'roles' => 'required',
            'sexo' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
                        ->with('success','Usuario creado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('admin.users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();

        return view('admin.users.edit',compact('user','roles','userRole'));
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
        $this->validate($request, [
            'username' => 'required|unique:users,username,'.$id,
            'email' => 'required|email',
            'nombres' => 'required|regex:/^[\pL\s]+$/u',
            'paterno'=> 'nullable|regex:/^[\pL\s]+$/u',
            'materno'=> 'nullable|regex:/^[\pL\s]+$/u',
            'ci' => 'required|unique:users,ci,'.$id,
            'password' => 'required|same:confirm-password',
            'roles' => 'required',
            'sexo' => 'required'
        ]);

        $input = $request->all();
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));
        }

        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();

        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
                        ->with('success','Usuario actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
                        ->with('success','Uusario eliminado con éxito');
    }
    public function doctores( $especialidad){
        $id_especialidad = $especialidad;
        $doctores = DB::table('users')
        ->join('model_has_roles','users.id','=','model_has_roles.model_id')
        ->join('roles','model_has_roles.role_id','=','roles.id')
        ->join('especialidad_user','users.id','=','especialidad_user.user_id')
        ->join('especialidades','especialidad_user.especialidad_id','=','especialidades.id')
        ->select(
            'users.id',
            'users.nombres',
            'users.paterno',
            'users.materno',
            'users.ci',
            'users.username',
            'users.email',
            'users.telefono',
            'users.direccion',
            'users.fec_nac',
            'users.estado'
            )
        ->where('roles.name','=','Doctor')
        ->where('users.estado','=','1')
        ->where('especialidades.id','=',$id_especialidad)
        ->get();
        $html='';
        foreach($doctores as $row)
        {
            $html.= "<option value='". $row->id."'>".$row->nombres." ".$row->paterno." ".$row->materno."</option>";
        }
        echo $html;
    }
}
