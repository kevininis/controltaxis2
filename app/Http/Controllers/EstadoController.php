<?php

namespace App\Http\Controllers;

use App\Models\estado;
use Illuminate\Http\Request;

class EstadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //

        $estado['estado'] = estado::paginate(50);

        return view('estados.index', $estado);
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
        $estado=request()->except('_token');
        estado::insert($estado);

        return redirect('estados');
        } catch (\Exception $exception) {
            $mensaje = 'Error: Existe algún registro invalido.';
            return redirect('estados')-with('store', $mensaje);
        }
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function show(estado $estado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function edit(estado $estado)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, estado $estado)
    {
        //
        try {
        //para editar los registros
        //acá se traen los datos por medio del request y se le quitan el token y el metodo
        $modificacion=request()->except('_token','_method');
        //luego en estado se busca el id para realizar la modificacion
        $update_estados=estado::find($modificacion['id']);
        //se procede a buscar todos los datos que quieran ser modificados, tienen que coincidir con los del form del que se enviaron
        $update_estados->estado = $modificacion['estado'];
        $update_estados->descripcion = $modificacion['descripcion'];
        //sin esto no funciona este código
        $update_estados->timestamps = false;
        //y por último se guarda todo
        $update_estados->save();

        return redirect('estados');
        } catch(\Exception $exception) {
            $mensaje = 'Error: Existe algún registro invalido';

            return redirect('estados')->with('update', $mensaje);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function destroy(estado $estado)
    {
        //
        try {
            $estado->delete();
            return redirect('estados');
        } catch (\Exception $exception) {
            $mensaje = 'No se pudo eliminar el registro porque se está utilizando en otra tabla. ';

            return redirect('estados')->with('destroy', $mensaje);
        }
    }
}
