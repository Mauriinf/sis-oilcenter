<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;

use App\Http\Requests\CategoriaFormRequest;
class CategoriaController extends Controller
{
  public function index(){

    $categoria = Categoria::all();

    if (!empty($categoria)) {
      return response()->json([
        'categoria' => $categoria
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
      'descripcion' => $request->get('descripcionC')
    ]);

    if (!empty($categoria)) {
      return response()->json([
        'categoria' => Categoria::all(),
        'success' => 'La categoria se creó correctamente'
      ],201);
    }else{
      return response()->json([
        'status' => 'Ocurrio un error!',
        'message' =>  'asd'

      ],400);
    }
  }
  public function update(CategoriaFormRequest $request, $id){

    $categoria = Categoria::findOrFail($id)->update([
      'nombre' => $request->get('nombreC'),
      'descripcion' => $request->get('descripcionC')
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
}
