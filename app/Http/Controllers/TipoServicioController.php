<?php

namespace App\Http\Controllers;

use App\Models\TipoServicio;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Validator;
class TipoServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipos=TipoServicio::all();
        $categoria = TipoServicio::all();
        return view('configuraciones.index',compact('tipos', 'categoria'));
    }
    public function lista_tipos(){
        $tipos=TipoServicio::all();
        return Datatables::of($tipos)->addColumn('botones', 'actions.config')->rawColumns(['botones'])->toJson();
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
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nombre_tipo'=> 'required'
            ],
            [
                'nombre_tipo.required'=>'El campo nombre es requerido'
            ]
        );
        if (!$validator->fails()) {
            $respuesta=Array();
            $tipo_servicio = TipoServicio::create([
                'nombre' => $request->get('nombre_tipo'),
                'estado' => 'ACTIVO'
              ]);
            array_push($respuesta,'OK');
            return ($respuesta);
        }else{
            return response()->json(['errors' => $validator->errors()->all()]);
            //return response()->json($validator->errors()->all());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TipoServicio  $tipoServicio
     * @return \Illuminate\Http\Response
     */
    public function show(TipoServicio $tipoServicio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TipoServicio  $tipoServicio
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoServicio $tipoServicio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TipoServicio  $tipoServicio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nombre'=> 'required',
                'estado'=> 'required'
            ],
            [
                'nombre.required'=>'El campo nombre es requerido',
                'estado.required'=>'El campo estado es requerido'
            ]
        );
        if (!$validator->fails()) {
            $respuesta=Array();
            $Tiposervicio = TipoServicio::findOrFail($request->id_edit)->update([
                'nombre' => $request->nombre,
                'estado' => $request->estado,
              ]);
            array_push($respuesta,'OK');
            return ($respuesta);
        }else{
            return response()->json(['errors' => $validator->errors()->all()]);
            //return response()->json($validator->errors()->all());
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TipoServicio  $tipoServicio
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoServicio $tipoServicio)
    {
        //
    }
}
