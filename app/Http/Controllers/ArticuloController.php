<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Articulo;
use App\Models\Categoria;
use App\Http\Requests\ArticuloFormRequest;
use Illuminate\Support\Str;

class ArticuloController extends Controller
{
  public function index(){

    $articulo = Articulo::with('categoria')->get();

    if (!empty($articulo)) {

      return view('articulo.index', ['articulo' => $articulo]);

    } else {
      return view('articulo')->withErrors('No se pudo obtener el registro, vuelva a intentarlo.');
    }
  }
  public function create() {

    $categoria = Categoria::All();
    return view("articulo.form",["categoria"=>$categoria]);
  }
  public function store(ArticuloFormRequest $request){

    $nombreImagen = '';
    if ($request->hasFile('avatar')) {

      $imagen = $request->file('avatar');
      $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
      $imagen->move(public_path('imagenes/articulo'), $nombreImagen);

    }

    $articulo = Articulo::create([
      'id_categoria' => $request->get('categoria'),
      'nombre' => $request->get('nombre'),
      'stock' => 0,
      'descripcion' => $request->get('descripcion'),
      'imagen' => $nombreImagen,
      'estado' => 1,
      'codigo' => $request->get('codigo')
    ]);

    if (!empty($articulo)) {
      return Redirect::to('articulo')->with('success', 'El artículo ha sido guardado correctamente.');
    }else{
      return view('/articulo')->withErrors('No se pudo guardar el registro, vuelva a intentarlo.');
    }
  }
  public function edit($id){

    $articulo = Articulo::findOrFail($id);
    $categoria = Categoria::All();
    return view('articulo.form', compact('articulo', 'categoria'));
  }
  public function update(ArticuloFormRequest $request, $id){

    $nombreImagen = '';
    if ($request->hasFile('avatar')) {

      $imagen = $request->file('avatar');
      $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
      $imagen->move(public_path('imagenes/articulo'), $nombreImagen);

    }

    $articulo = Articulo::findOrFail($id)->update([
      'id_categoria' => $request->get('categoria'),
      'nombre' => $request->get('nombre'),
      'stock' => $request->get('stock'),
      'descripcion' => $request->get('descripcion'),
      'imagen' => $nombreImagen,
      'estado' => 1,
      'codigo' => $request->get('codigo')
    ]);

    if (!empty($articulo)) {
      return Redirect::to('articulo')->with('success', 'El artículo ha sido modificado correctamente.');
    }else{
      return view('/articulo')->withErrors('No se pudo modificar el registro, vuelva a intentarlo.');
    }
  }
  public function addStock($id, $stock){
    $articulo = Articulo::findOrFail($id);
    $articulo->stock += $stock;
    $articulo->save();
  }
  public function discountStock($id, $stock){
    $articulo = Articulo::findOrFail($id);
    $articulo->stock -= $stock;
    $articulo->save();
  }
  public function enable($id){

    $articulo = Articulo::findOrFail($id)->update([
      'estado' => 1,
    ]);

    if (!empty($articulo)) {
      return Redirect::to('articulo')->with('success', 'El articulo fue habilitado correctamente');
    }else{
      return view('articulo')->withErrors('No se pudo habilitar el registro, vuelva a intentarlo.');
    }
  }
  public function disable($id){

    $articulo = Articulo::findOrFail($id)->update([
      'estado' => 0,
    ]);

    if (!empty($articulo)) {
      return Redirect::to('articulo')->with('success', 'El articulo fue inhabilitado correctamente');
    }else{
      return view('articulo')->withErrors('No se pudo inhabilitar el registro, vuelva a intentarlo.');
    }
  }
  public function destroy($id){

    $articulo = Articulo::findOrFail($id);
    $articulo->delete();   

    if (!empty($articulo)) {
      return Redirect::to('articulo')->with('success', 'El artículo ha sido eliminado correctamente.');
    }else{
      return view('articulo')->withErrors('No se pudo inhabilitar el registro, vuelva a intentarlo.');
    }
  }
  public function cancel($data){

    foreach ($data->detalle_ingreso as $art) {

      $articulo = Articulo::findOrFail($art->id_articulo);
      $articulo->stock -= $art->cantidad;
      $articulo->save();

    }

  }
}
