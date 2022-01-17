<?php

namespace App\Http\Controllers;

use App\Models\tipo_gasto;
use Illuminate\Http\Request;


class TipoGastoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //aquí se está enviando el mensaje del destroy hacia el index

        $tipo_gasto['tipo_gasto'] = tipo_gasto::paginate(50);
        return view('tipo_gasto.index', $tipo_gasto);
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
        $datostipo=request()->except('_token');
        tipo_gasto::insert($datostipo);
        
        return redirect('t-g');
        } catch (\Exception $exception) {
            $mensajes = 'Error: Existe algún registro invalido.';
            
            return redirect('t-g')->with('store', $mensajes);
        }
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\tipo_gasto  $tipo_gasto
     * @return \Illuminate\Http\Response
     */
    public function show(tipo_gasto $tipo_gasto)
    {
        //
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\tipo_gasto  $tipo_gasto
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\tipo_gasto  $tipo_gasto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, tipo_gasto $tipo_gasto)
    {
        //
        try {
        //para editar los registros
        //acá se traen los datos por medio del request y se le quitan el token y el metodo
        $modificacion=request()->except('_token','_method');
        //luego en tipo_gasto se busca el id para realizar la modificacion
        $update_tipogasto=tipo_gasto::find($modificacion['id']);
        //se procede a buscar todos los datos que quieran ser modificados, tienen que coincidir con los del form del que se enviaron
        $update_tipogasto->tipo = $modificacion['tipo'];
        $update_tipogasto->descripcion = $modificacion['descripcion'];
        //sin esto no funciona este código
        $update_tipogasto->timestamps = false;
        //y por último se guarda todo
        $update_tipogasto->save();


        return redirect('t-g');
        } catch (\Exception $exception) {
            $mensaje = 'Error: Existe algún registro invalido.';

            return redirect('t-g')->with('update', $mensaje);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\tipo_gasto  $tipo_gasto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, tipo_gasto $tipo_gasto)
    {
        //primero impotamos session en las librerías
        //para elimnar intentamos eliminar, si no se puede eliminar enviamos un mensaje personalizado
        try {
            tipo_gasto::destroy($id);
            return redirect('t-g');
        } catch (\Exception $exception){
            $mensaje = 'No se pudo eliminar el registro porque se está utilizando en otra tabla.';
            
            //a su vez enviamos el mensaje personalizado al index por medio de session
            return redirect('t-g')->with('destroy', $mensaje);
        }
    }
}
