<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Detalle_venta;

use App\Http\Requests\DetalleVentaFormRequest;

class DetalleVentaController extends Controller
{
    public function store(DetalleVentaFormRequest $request, $id_venta){

    $datosFilas = json_decode($request->input('datosFilas'));

    foreach ($datosFilas as $data) {

      $venta = Detalle_venta::create([
        'id_articulo' => $data->id_articulo,
        'id_venta' => $id_venta,
        'cantidad' => $data->d_cantidad,
        'precio_venta' => $data->d_p_venta
      ]);

    }

    if (!$venta) {
      return response()->json([
        'status' => 'Ocurrio un error!',
        'message' => 'No se pudo guardar el detalle del venta',
      ],400);
    }else{
      return response()->json([
        'status' => 'Ok'
      ],201);
    }
  }
}
