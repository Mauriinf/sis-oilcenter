<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Articulo;
use App\Models\Detalle_venta;
use App\Models\Detalle_ingreso;
use Illuminate\Support\Facades\View;
use DB;
use PDF;

class ReporteController extends Controller
{
  public function general(){

    $articulo = Articulo::all();
    return view("reporte.general", compact('articulo'));

  }
  public function venta(Request $request){

    $dato_i = $request->get('dato_i');
    $dato_f = $request->get('dato_f');
    $articulo = json_decode($request->get('articulo'));

    if (isset($articulo) && !empty($articulo)) {
      $reporte_ingreso = Detalle_ingreso::with('ingreso', 'ingreso.proveedor', 'ingreso.almacenero', 'articulo')
      ->whereIn('id_articulo', $articulo)
      ->whereHas('ingreso', function($q) use($dato_i, $dato_f){
        $q->whereBetween(DB::raw('DATE(fecha_hora)'), array($dato_i, $dato_f));     
      })
      ->orderBy('id', 'asc')
      ->get();
    }else{

      $reporte_venta = Detalle_venta::with('venta', 'venta.cliente', 'venta.vendedorV', 'articulo')
      ->whereHas('venta', function($q) use($dato_i, $dato_f){
        $q->whereBetween(DB::raw('DATE(fecha_hora)'), array($dato_i, $dato_f));     
      })
      ->orderBy('id', 'asc')
      ->get();

    }


    $pdf = [
      'venta' => $reporte_venta,
      'fecha_i' => $dato_i,
      'fecha_f' => $dato_f
    ];


    return PDF::loadView('pdf.venta', $pdf)->setPaper('a4', 'landscape')->stream('archivo.pdf');
  }
  public function ingreso(Request $request){

    $dato_i = $request->get('dato_i');
    $dato_f = $request->get('dato_f');
    $articulo = json_decode($request->get('articulo'));

    if (!empty($articulo)) {
      $reporte_ingreso = Detalle_ingreso::with('ingreso', 'ingreso.proveedor', 'ingreso.almacenero', 'articulo')
      ->whereIn('id_articulo', $articulo)
      ->whereHas('ingreso', function($q) use($dato_i, $dato_f){
        $q->whereBetween(DB::raw('DATE(fecha_hora)'), array($dato_i, $dato_f));     
      })
      ->orderBy('id', 'asc')
      ->get();
    }else{
      $reporte_ingreso = Detalle_ingreso::with('ingreso', 'ingreso.proveedor', 'ingreso.almacenero', 'articulo')
      ->whereHas('ingreso', function($q) use($dato_i, $dato_f){
        $q->whereBetween(DB::raw('DATE(fecha_hora)'), array($dato_i, $dato_f));     
      })
      ->orderBy('id', 'asc')
      ->get();
    }

    $pdf = [
      'ingreso' => $reporte_ingreso,
      'fecha_i' => $dato_i,
      'fecha_f' => $dato_f
    ];


    return PDF::loadView('pdf.ingreso', $pdf)->setPaper('a4', 'landscape')->stream('archivo.pdf');
  }
  public function cliente(){

    $cliente = User::select('nombres', 'paterno', 'materno')
    ->withCount('cliente')
    ->having('cliente_count', '>', 0)
    ->get();

    $pdf = [
      'cliente' => $cliente
    ];

    return PDF::loadView('pdf.cliente', $pdf)->stream('archivo.pdf');

  }
  public function usuario(){
    
    $usuario = User::with('roles')->get();

    $pdf = [
      'usuario' => $usuario
    ];

    return PDF::loadView('pdf.usuario', $pdf)->setPaper('a4', 'landscape')->stream('archivo.pdf');

  }
}
