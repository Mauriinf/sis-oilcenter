<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Articulo;
use App\Models\Ingreso;

use App\Http\Controllers\DetalleIngresoController;
use App\Http\Controllers\ArticuloController;

use App\Http\Requests\DetalleIngresoFormRequest;

use App\Http\Requests\IngresoFormRequest;

class IngresoController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:lista-ingresos|registrar-ingresos|ver-ingresos|elimminar-ingresos|cancelar-saldo-ingresos', ['only' => ['index','store']]);
         $this->middleware('permission:registrar-ingresos', ['only' => ['create','store']]);
         $this->middleware('permission:ver-ingresos', ['only' => ['show','update']]);
         $this->middleware('permission:elimminar-ingresos', ['only' => ['destroy','cancel','payment']]);
         $this->middleware('permission:cancelar-saldo-ingreso', ['only' => ['destroy','cancel','payment']]);
    }
  public function index(){

    $ingreso = Ingreso::all();

    if (!empty($ingreso)) {

      return view('ingreso.index', ['ingreso' => $ingreso]);

    } else {
      return view('ingreso')->withErrors('No se pudo obtener el registro, vuelva a intentarlo.');
    }
  }
  public function create() {

    $proveedor = User::role(['Proveedor'])->get();
    $articulo = Articulo::where('estado', 1)->get();

    return view("ingreso.form",["proveedor" => $proveedor, 'articulo' => $articulo]);
  }
  public function store(IngresoFormRequest $request){

    $ingreso = Ingreso::create([
      'id_proveedor' => explode(',', $request->get('proveedor'))[0],
      'id_almacenero' => Auth::id(),
      'monto_total' => $request->get('total'),
      'fecha_hora' => date('Y-m-d H:i:s'),
      'estado' => 1,
      'monto_cancelado' => $request->get('cancelado'),
      'monto_deuda' => $request->get('saldo')
    ]);

    $form_request = new DetalleIngresoFormRequest($request->all());
    $det_ing = new DetalleIngresoController();
    $detalle = $det_ing->store($form_request, $ingreso->id);

    if ($detalle->getStatusCode() == 400) {

      return view('ingreso')->withErrors($detalle->getData()->message);

    }


    if (!empty($ingreso)) {
      return Redirect::to('ingreso')->with('success', 'El registro ha sido guardado correctamente.');
    }else{
      return view('/ingreso')->withErrors('No se pudo guardar el ingreso, vuelva a intentarlo.');
    }
  }
  public function show($id){

    $ingreso = Ingreso::with('proveedor', 'almacenero', 'detalle_ingreso', 'detalle_ingreso.articulo')->findOrFail($id);

    if ($ingreso) {
      return view('ingreso.show', ['ingreso' => $ingreso]);
    }
  }
  /*public function edit($id){

    $ingreso = Ingreso::findOrFail($id);
    $proveedor = User::with('proveedor')->get();
    $articulo = Articulo::where('estado', 1)->get();

    return view('ingreso.form', compact('ingreso', 'proveedor', 'articulo'));
  }*/
  public function update(ArticuloFormRequest $request, $id){

    $articulo = Articulo::findOrFail($id)->update([
      'id_categoria' => $request->get('categoria'),
      'nombre' => $request->get('nombre'),
      'stock' => $request->get('stock'),
      'descripcion' => $request->get('descripcion'),
      'imagen' => 'asd.jpg',
      'estado' => 1,
      'codigo' => $request->get('codigo')
    ]);

    if (!empty($articulo)) {
      return Redirect::to('articulo')->with('success', 'El registro ha sido modificado correctamente.');
    }else{
      return view('/articulo')->withErrors('No se pudo modificar el registro, vuelva a intentarlo.');
    }
  }
  public function enable($id){

    $articulo = Articulo::findOrFail($id)->update([
      'estado' => 1,
    ]);

    if (!empty($articulo)) {
      return Redirect::to('articulo');
    }else{
      return view('articulo')->withErrors('No se pudo habilitar el registro, vuelva a intentarlo.');
    }
  }
  public function disable($id){

    $articulo = Articulo::findOrFail($id)->update([
      'estado' => 0,
    ]);

    if (!empty($articulo)) {
      return Redirect::to('articulo')->with('success', 'El registro ha sido anulado correctamente.');;
    }else{
      return view('articulo')->withErrors('No se pudo inhabilitar el registro, vuelva a intentarlo.');
    }
  }
  public function destroy($id){

    $ingreso = Ingreso::findOrFail($id);
    $ingreso->delete();

    if (!empty($ingreso)) {
      return Redirect::to('ingreso')->with('success', 'El registro ha sido eliminado correctamente.');
    }else{
      return view('ingreso')->withErrors('No se pudo inhabilitar el registro, vuelva a intentarlo.');
    }
  }
  public function cancel($id){

    $ingreso = Ingreso::with('detalle_ingreso')->findOrFail($id);
    $cancel = Ingreso::with('detalle_ingreso')->findOrFail($id)->update([
      'estado' => 0,
    ]);

    $articulo = new ArticuloController();
    $stock = $articulo->cancel($ingreso);

    if (!empty($cancel)) {
      return Redirect::to('ingreso')->with('success', 'El registro ha sido anulado correctamente.');
    }else{
      return view('/ingreso')->withErrors('No se pudo anular el registro, vuelva a intentarlo.');
    }
  }
  public function payment(Request $request, $id){

    $ingreso = Ingreso::findOrFail($id);
    $ingreso->monto_cancelado += $request->m_amortizar;
    $ingreso->monto_deuda = $request->b_saldo;
    $ingreso->save();

    if (!empty($ingreso)) {
      return Redirect::to(route('ingreso.show', $ingreso))->with('success', 'El saldo ha sido amortizado correctamente.');
    }else{
      return view('/articulo')->withErrors('No se pudo modificar el registro, vuelva a intentarlo.');
    }

  }
}
