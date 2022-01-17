<?php

namespace App\Http\Controllers;

use App\Models\chofer;
use App\Models\estado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ChoferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(request $request)
    {
        //
        $buscar_nombre   = $request->get('buscarnombre'); 
        $buscar_apellido = $request->get('buscarapellido');
        $buscar_dpi      = $request->get('buscardpi');
        $buscar_estado      = $request->get('buscarestado');

        $mensajes = Session::get('mensajes');
        $chofer['chofer'] = chofer::
        join('estados', 'chofers.id_estado', 'estados.id')
        ->where('nombre', 'like', "%$buscar_nombre%")
        ->where('apellido', 'like', "%$buscar_apellido%")
        ->where('dpi', 'like', "%$buscar_dpi%")
        ->where('estado', 'like', "%$buscar_estado%")
        ->paginate(50, 
        array('chofers.id', 'chofers.nombre', 'chofers.apellido', 'chofers.dpi', 'chofers.fecha_nacimiento', 'chofers.numero_documento', 'chofers.tipo_licencia', 'chofers.vencimiento_licencia', 'chofers.tipo_sangre', 'chofers.restricciones', 'estados.estado'));
        $estado['estado']=estado::paginate(10);

        return view('chofer.index', $chofer, $estado)->with('mensajes', $mensajes);
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
        //
        try {
        $datoschofer = request()->except('_token');
        chofer::insert($datoschofer);

        return redirect('chofer');
        } catch (\Exception $exception) {
            $mensajes = 'Existe algún registro invalido.';
            
            return redirect('chofer')->with('store', $mensajes);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\chofer  $chofer
     * @return \Illuminate\Http\Response
     */
    public function show(chofer $chofer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\chofer  $chofer
     * @return \Illuminate\Http\Response
     */
    public function edit(chofer $chofer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\chofer  $chofer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, chofer $chofer)
    {
        //
        try {
        $modify = request()->except('_token', '_method');
        $update_chofer = chofer::find($modify['id']);
        $update_chofer->nombre               = $modify['nombre'];
        $update_chofer->apellido             = $modify['apellido'];
        $update_chofer->dpi                  = $modify['dpi'];
        $update_chofer->fecha_nacimiento     = $modify['fecha_nacimiento'];
        $update_chofer->numero_documento     = $modify['numero_documento'];
        $update_chofer->tipo_licencia        = $modify['tipo_licencia'];
        $update_chofer->vencimiento_licencia = $modify['vencimiento_licencia'];
        $update_chofer->tipo_sangre          = $modify['tipo_sangre'];
        $update_chofer->restricciones        = $modify['restricciones'];
        $update_chofer->id_estado            = $modify['id_estado'];
        $update_chofer->timestamps           = false;
        $update_chofer->save();

        return redirect('chofer');
        } catch (\Exception $exception) {
            $mensaje = 'Error: Existe algún registro invalido.';
            return redirect('chofer')->with('update', $mensaje);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\chofer  $chofer
     * @return \Illuminate\Http\Response
     */
    public function destroy(chofer $chofer)
    {
        //
        try {
            $chofer->delete();
            return redirect('chofer');
        } catch (\Exception $exception){
            $mensaje = 'No se pudo eliminar el registro porque se está utilizando en otra tabla. ';
            
            //a su vez enviamos el mensaje personalizado al index por medio de session
            return redirect('chofer')->with('destroy', $mensaje);
        }
    }
}
