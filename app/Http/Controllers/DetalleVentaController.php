<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Detalle_venta;
use App\Models\Articulo;

use App\Http\Controllers\ArticuloController;

use App\Http\Requests\DetalleVentaFormRequest;

class DetalleVentaController extends Controller
{
    public function store($request, $id_venta){

    $datosFilas = json_decode($request->input('datosFilas'));
    $articulo_error = [];

    $venta = null;

    foreach ($datosFilas as $data) {

      $existente = Articulo::findOrFail($data->id_articulo);

      if ($existente->stock >= $data->d_cantidad) {

        $venta = Detalle_venta::create([
          'id_articulo' => $data->id_articulo,
          'id_venta' => $id_venta,
          'cantidad' => $data->d_cantidad,
          'precio_venta' => $data->d_p_venta
        ]);

        $stock_art = new ArticuloController();
        $stock = $stock_art->discountStock($data->id_articulo, $data->d_cantidad);

      }else{
        
        $articulo_error[] = $existente->nombre;   
      }

    }

    if(!empty($articulo_error)){
      return response()->json([
        'success' =>false,
        'message' => $articulo_error,
        'title' => 'La siguiente lista de articulos tiene un stock menor al solicitado'
      ],400);
    }else{
      return response()->json([
        'status' => 'Ok'
      ],201);
    }
  }
}
