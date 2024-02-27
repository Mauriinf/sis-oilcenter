<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;

use App\Http\Requests\CategoriaFormRequest;
use Illuminate\Support\Facades\Auth;
class CategoriaController extends Controller
{
  public function index(){

    $categoria = Categoria::all();

    if (!empty($categoria)) {
        $user=Auth::user();
        $permisos=$user->getAllPermissions()->pluck('name')->toArray();
      return response()->json([
        'categoria' => $categoria,
        'permisos' =>$permisos
      ],201);
    }else{
      return response()->json([
        'status' => 'Ocurrio un error!',
        'message' =>  'Hubo un error al tratar de obtener las categorias'

      ],400);
    }
  }
  public function store(CategoriaFormRequest $request){

    $categoria = Categoria::create([
      'nombre' => $request->get('nombreC'),
      'descripcion' => $request->get('descripcionC'),
      'estado' => 1
    ]);

    if (!empty($categoria)) {
        $user=Auth::user();
        $permisos=$user->getAllPermissions()->pluck('name')->toArray();
      return response()->json([
        'categoria' => Categoria::all(),
        'permisos' =>$permisos,
        'success' => 'La categoria se creó correctamente'
      ],201);
    }else{
      return response()->json([
        'status' => 'Ocurrio un error!',
        'message' =>  'No se completó la tarea'

      ],400);
    }
  }
  public function update(CategoriaFormRequest $request, $id){

    $categoria = Categoria::findOrFail($id)->update([
      'nombre' => $request->get('nombreC'),
      'descripcion' => $request->get('descripcionC'),
      'estado' => 1
    ]);

    if (!empty($categoria)) {
      return response()->json([
        'categoria' => Categoria::all(),
        'success' => 'La categoria se modificó correctamente'
      ],201);
    }else{
      return response()->json([
        'status' => 'Ocurrio un error!',
        'message' =>  'Hubo un error al modificar el registro'

      ],400);
    }
  }
  public function enable($id){

    $categoria = Categoria::findOrFail($id)->update([
      'estado' => 1
    ]);

    if (!empty($categoria)) {
      return response()->json([
        'categoria' => Categoria::all(),
        'success' => 'La categoria fue habilitado correctamente'
      ],201);
    }else{
      return response()->json([
        'status' => 'Ocurrio un error!',
        'message' =>  'Hubo un error al habilitar el registro'

      ],400);
    }

  }
  public function disable($id){

    $categoria = Categoria::findOrFail($id)->update([
      'estado' => 0
    ]);

    if (!empty($categoria)) {
      return response()->json([
        'categoria' => Categoria::all(),
        'success' => 'La categoria ha sido desabilitado correctamente'
      ],201);
    }else{
      return response()->json([
        'status' => 'Ocurrio un error!',
        'message' =>  'Hubo un error al desabilitar el registro'

      ],400);
    }

  }
}
