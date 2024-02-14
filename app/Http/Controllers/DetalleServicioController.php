<?php

namespace App\Http\Controllers;

use App\Models\DetalleServicio;
use Illuminate\Http\Request;
use App\Http\Requests\DetalleServicioFormRequest;
class DetalleServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DetalleServicioFormRequest $request, $id_servicio)
    {
        $datosFilas = $request->input('tipos');

        foreach ($datosFilas as $data) {
            $servicio = DetalleServicio::create([
                'id_servicio' => $id_servicio,
                'id_tipo_servicio' => $data
            ]);
        }

        if (!$servicio) {
        return response()->json([
            'status' => 'Ocurrio un error!',
            'message' => 'No se pudo guardar el detalle del servicio',
        ],400);
        }else{
        return response()->json([
            'status' => 'Ok'
        ],201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DetalleServicio  $detalleServicio
     * @return \Illuminate\Http\Response
     */
    public function show(DetalleServicio $detalleServicio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DetalleServicio  $detalleServicio
     * @return \Illuminate\Http\Response
     */
    public function edit(DetalleServicio $detalleServicio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DetalleServicio  $detalleServicio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DetalleServicio $detalleServicio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DetalleServicio  $detalleServicio
     * @return \Illuminate\Http\Response
     */
    public function destroy(DetalleServicio $detalleServicio)
    {
        //
    }
}
