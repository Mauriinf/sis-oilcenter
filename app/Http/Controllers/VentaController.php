<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Articulo;
use App\Models\Venta;

use App\Http\Controllers\DetalleVentaController;
use App\Http\Controllers\ArticuloController;
use App\Http\Controllers\DetalleIngresoController;

use App\Http\Requests\VentaFormRequest;
use App\Http\Requests\DetalleVentaFormRequest;

class VentaController extends Controller
{
  public function index(){

    $venta = Venta::all();

    if (!empty($venta)) {

      return view('venta.index', ['venta' => $venta]);

    } else {
      return view('venta')->withErrors('No se pudo obtener los registro, vuelva a intentarlo.');
    }
  }
  public function create() {

    $cliente = User::with('cliente')->get();
    $articulo = Articulo::where('estado', 1)->get();

    return view("venta.form",["cliente" => $cliente, 'articulo' => $articulo]);
  }
  public function store(VentaFormRequest $request){

    $venta = Venta::create([
      'id_cliente' => explode(',', $request->get('cliente'))[0],
      'id_vendedor' => Auth::id(),
      'fecha_hora' => date('Y-m-d H:i:s'),
      'total_venta' => $request->get('total'),
      'estado' => 1,
      'monto_cancelado' => $request->get('cancelado'),
      'monto_deuda' => $request->get('saldo')
    ]);

    if (!$venta) {
      return redirect()->back()->withErrors('No se pudo realizar la venta, vuelva a intentarlo.');
    }

    $form_request = new DetalleVentaFormRequest($request->all());
    $det_ven = new DetalleVentaController();
    $detalle = $det_ven->store($form_request, $venta->id);

    if ($detalle->getStatusCode() == 400 || $detalle->getStatusCode() == 422) {

      return redirect()->back()->with([
        'title' => $detalle->getData()->title,
      ])->withErrors(['errors' => $detalle->getData()->message]);

    }

    return Redirect::to('venta')->with('success', 'La venta ha sido realizado correctamente.');
  }
  public function show($id){

    $venta = Venta::with('cliente', 'vendedorV', 'detalle_venta', 'detalle_venta.articulo')->findOrFail($id);

    if ($venta) {
      return view('venta.show', ['venta' => $venta]);
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
  public function cancel($id){

    $cancel = Venta::findOrFail($id)->update([
      'estado' => 0,
    ]);

    if (!empty($cancel)) {
      return Redirect::to('venta')->with('success', 'El registro ha sido anulado correctamente.');
    }else{
      return view('/venta')->withErrors('No se pudo anular el registro, vuelva a intentarlo.');
    }
  }
  public function payment(Request $request, $id){

    $venta = Venta::findOrFail($id);
    $venta->monto_cancelado += $request->m_amortizar;
    $venta->monto_deuda = $request->b_saldo;
    $venta->save();

    if (!empty($venta)) {
      return Redirect::to(route('venta.show', $venta))->with('success', 'El saldo ha sido amortizado correctamente.');
    }else{
      return view('/venta')->withErrors('No se pudo modificar el registro, vuelva a intentarlo.');
    }

  }
  public function precio($id){

    $ingreso = new DetalleIngresoController();
    $precio = $ingreso->precio($id);

    if ($precio->getStatusCode() == 400) {

      return response()->json([
        'status' => 'Ocurrio un error!',
        'message' => 'No se pudo obtener el ingreso para este producto, vuelva a consultar más tarde',
      ],400);

    }

    return response()->json([
      'precio' => $precio->getData()->precio
    ],201);


  }
}
