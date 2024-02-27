<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Detalle_ingreso;

use App\Http\Controllers\ArticuloController;

use App\Http\Requests\DetalleIngresoFormRequest;

class DetalleIngresoController extends Controller
{
  public function store(DetalleIngresoFormRequest $request, $id_ingreso){

    $datosFilas = json_decode($request->input('datosFilas'));

    foreach ($datosFilas as $data) {

      $ingreso = Detalle_ingreso::create([
        'id_articulo' => $data->id_articulo,
        'id_ingreso' => $id_ingreso,
        'cantidad' => $data->d_cantidad,
        'precio_compra' => $data->d_p_compra,
        'precio_venta_normal' => $data->d_p_venta_normal,
        'precio_venta_factura' => $data->d_p_venta_factura
      ]);

      $stock_art = new ArticuloController();
      $stock = $stock_art->addStock($data->id_articulo, $data->d_cantidad);

    }

    if (!$ingreso) {
      return response()->json([
        'status' => 'Ocurrio un error!',
        'message' => 'No se pudo guardar el detalle del ingreso',
      ],400);
    }else{
      return response()->json([
        'status' => 'Ok'
      ],201);
    }
  }
  public function precio($id){

    $precio = Detalle_ingreso::select('id', 'id_articulo', 'precio_venta_factura', 'precio_venta_normal')
    ->with('articulo:id,stock')
    ->where('id_articulo', $id)
    ->orderBy('id', 'desc')
    ->first();

    if (!empty($precio)) {
      return response()->json([
        'precio' => $precio
      ],201);
    }else{
      return response()->json([
        'status' => 'Ocurrio un error!',
        'message' => 'No se pudo obtener un ingreso, vuelva a consultar más tarde',
      ],400);
    }

  }
}
