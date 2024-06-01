<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use App\Models\TipoServicio;
use App\Models\Cita;
use App\Models\DetalleServicio;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\DetalleServicioControllerController;
use App\Http\Controllers\CitaController;
use App\Http\Requests\DetalleServicioFormRequest;
use App\Http\Requests\ServicioFormRequest;
class ServicioController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:lista-servicios|registrar-servicios|ver-detalle-servicio|eliminar-servicio', ['only' => ['index','store']]);
         $this->middleware('permission:registrar-servicios', ['only' => ['create','store']]);
         $this->middleware('permission:ver-detalle-servicio', ['only' => ['show','update']]);
         $this->middleware('permission:eliminar-servicio', ['only' => ['destroy']]);
    }
    public function index()
    {
        $servicios = Servicio::all();

        if (!empty($servicios)) {

        return view('servicios.index', compact('servicios'));

        } else {
        return view('servicios')->withErrors('No se pudo obtener el registro, vuelva a intentarlo.');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clientes = User::role(['Cliente','Proveedor'])->get();//proveedor puede ser un cliente mas
        $tipos = TipoServicio::where('estado', 'ACTIVO')->get();

        return view("servicios.form",["clientes" => $clientes, 'tiposervicio' => $tipos]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServicioFormRequest $request)
    {

        $servicio = new Servicio;
        $servicio->id_cliente = $request->cliente;
        $servicio->id_usuario = Auth::id();
        $servicio->fecha_hora = date('Y-m-d H:i:s');
        $servicio->precio = $request->precio;
        $servicio->km_actual = $request->km_actual;
        $servicio->descripcion = $request->descripcion;
        $servicio->save();


        //Crear detalles del servicio
        if (!empty($request->tipos)) {
            foreach ($request->tipos as $tipo_servicio_id) {
                // Crear detalles del servicio
                $detalle = new DetalleServicio;
                $detalle->id_servicio = $servicio->id;
                $detalle->id_tipo_servicio = $tipo_servicio_id;
                $detalle->save();
            }
        }

        // Agendar la cita
        $cita = new Cita;
        $cita->id_servicio = $servicio->id;
        $cita->fecha_hora = $request->fecha;
        $cita->km = $request->km;
        $cita->descripcion = $request->descripcion_prox;
        $cita->estado = 'PENDIENTE';
        $cita->save();
          if ($servicio->save()) {
            return Redirect::to('servicios')->with('success', 'El registro ha sido guardado correctamente.');
          }else{
            return view('/servicio')->withErrors('No se pudo guardar el servicio, vuelva a intentarlo.');
          }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Servicio  $servicio
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $servicio = Servicio::with('cliente', 'mecanico', 'detalleServicios', 'detalleServicios.tipoServicio')->findOrFail($id);
        if ($servicio) {
        return view('servicios.show', ['servicio' => $servicio]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Servicio  $servicio
     * @return \Illuminate\Http\Response
     */
    public function edit(Servicio $servicio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Servicio  $servicio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Servicio $servicio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Servicio  $servicio
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $servicio = Servicio::with('detalleServicios', 'citas')->findOrFail($id);
        foreach ($servicio->detalleServicios as $detalle) {//eliminar todos los detalles
            $detalle->delete();
        }
        if ($servicio->citas) {//eliminar citas
            $servicio->citas->delete();
        }
        $servicio->delete();
        return response()->json(['success' => 'El servicio y sus detalles asociados han sido eliminados correctamente.']);
        //return Redirect::to('servicios')->with('success', 'El servicio y sus detalles asociados han sido eliminados correctamente.');
    }
}
