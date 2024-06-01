<?php

namespace App\Http\Controllers;
use App\Models\publicacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
class PublicacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:lista-publicaciones|registrar-publicaciones|editar-publicaciones|eliminar-publicaciones', ['only' => ['index','store']]);
         $this->middleware('permission:registrar-publicaciones', ['only' => ['create','store']]);
         $this->middleware('permission:editar-publicaciones', ['only' => ['edit','update']]);
         $this->middleware('permission:eliminar-publicaciones', ['only' => ['destroy']]);
    }
    public function index()
    {
        $publicaciones = publicacion::all();

        if (!empty($publicaciones)) {

        return view('publicacion.index', ['publicacion' => $publicaciones]);

        } else {
        return view('publicacion')->withErrors('No se pudo obtener el registro, vuelva a intentarlo.');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("publicacion.form");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nombreImagen = '';


        $validator = Validator::make(
            $request->all(),
            [
                'titulo'=> 'required',
                'estado'=> 'required',
                'avatar' => 'required|image',
            ],
            [
                'avatar.required' => 'Por favor, selecciona una imagen.',
                'avatar.image' => 'El archivo seleccionado no es una imagen válida.',
                'titulo.required'=>'El campo titulo es requerido',
                'estado.required'=>'El campo estado es requerido'
            ]
        );
        if (!$validator->fails()) {
            if ($request->hasFile('avatar')) {

                $imagen = $request->file('avatar');
                $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
                $imagen->move(public_path('imagenes/publicacion'), $nombreImagen);

            }
            $publicacion = publicacion::create([
            'id_usuario' => Auth::id(),
            'titulo' => $request->get('titulo'),
            'fecha' => date('Y-m-d H:i:s'),
            'imagen' => $nombreImagen,
            'estado' => $request->get('estado')
            ]);
            return Redirect::to('publicacion')->with('success', 'La publicacion ha sido guardado correctamente.');
        }else{
            return back()->withErrors($validator)->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $publicacion = publicacion::findOrFail($id);
        return view('publicacion.form', compact('publicacion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $nombreImagen = '';


        $validator = Validator::make(
            $request->all(),
            [
                'titulo'=> 'required',
                'estado'=> 'required',
                'avatar' => 'required|image|mimes:jpeg,png,jpg',
            ],
            [
                'titulo.required'=>'El campo titulo es requerido',
                'estado.required'=>'El campo estado es requerido'
            ]
        );
        if (!$validator->fails()) {
            if ($request->hasFile('avatar')) {

                $imagen = $request->file('avatar');
                $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
                $imagen->move(public_path('imagenes/publicacion'), $nombreImagen);

            }
            $publi = publicacion::findOrFail($id)->update([
                'id_usuario' => Auth::id(),
                'titulo' => $request->get('titulo'),
                'fecha' => date('Y-m-d H:i:s'),
                'imagen' => $nombreImagen,
                'estado' => $request->get('estado')
              ]);

            return Redirect::to('publicacion')->with('success', 'La publicacion ha sido modificado correctamente.');
        }else{
            return view('/publicacion')->withErrors('No se pudo actualizar el registro, vuelva a intentarlo.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $publicacion = publicacion::find($id);
        $publicacion->delete();
        return response()->json(['success' => 'La publicación ha sido eliminado correctamente.']);
    }
}
