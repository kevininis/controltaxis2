<?php

namespace App\Http\Controllers;

use App\Models\gasto;
use App\Models\tipo_gasto;
use App\Models\taxi;
use App\Models\chofer;
use Illuminate\Http\Request;

class GastoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //esta variable nos permite hacer la busqueda
        $buscar_fecha = $request->get('buscarfecha');
        $buscar_taxi  = $request->get('buscartaxi');
        $buscar_chofer  = $request->get('buscarchofer');

        //es la variable principal para enviar los datos, esta contiene join, orderby, where
        $gasto = gasto::
        join('tipo_gastos', 'gastos.id_tipo_gasto', 'tipo_gastos.id')
        ->join('taxis', 'gastos.id_taxi', 'taxis.id')
        ->join('chofers', 'gastos.id_chofer', 'chofers.id')
        ->orderby('fecha', 'desc')

        //en el where se hace la busqueda entre los campos 
        ->where('fecha','like',"%$buscar_fecha%")
        ->where('numero','like',"%$buscar_taxi%")
        ->where('nombre','like',"%$buscar_chofer%")
        
        //el número de registros que queremos que pagine nuestra app
        ->paginate(50,
        array('gastos.id', 'gastos.fecha', 'gastos.monto', 'gastos.observaciones', 'tipo_gastos.tipo', 'taxis.numero', 'chofers.nombre'));
        $tipo_gasto = tipo_gasto::paginate(50);
        $taxi = taxi::paginate(50);
        $chofer = chofer::paginate(50);

        //operaciones aritmeticas
        //aqui se suma todos los registros de la db
        $total_gasto = gasto::sum('monto');
        //suma el contenido de la tabla
        $suma_gasto = $gasto->sum('monto');

        return view('gastos.index', compact('gasto', 'tipo_gasto', 'taxi', 'chofer', 'total_gasto', 'suma_gasto'));
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
            $datosgasto = request()->except('_token');
            gasto::insert($datosgasto);

            return redirect('gastos');
        } catch (\Exception $exception) {
            $mensaje ="Error: Existe algún registro invalido.";

            return redirect('gastos')->with('store', $mensaje);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\gasto  $gasto
     * @return \Illuminate\Http\Response
     */
    public function show(gasto $gasto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\gasto  $gasto
     * @return \Illuminate\Http\Response
     */
    public function edit(gasto $gasto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\gasto  $gasto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, gasto $gasto)
    {
        //
        try {
            $modify       = request()->except('_token', '_method');
            $update_gasto = gasto::find($modify['id']);
            $update_gasto->fecha         = $modify['fecha'];
            $update_gasto->monto         = $modify['monto'];
            $update_gasto->observaciones = $modify['observaciones'];
            $update_gasto->id_tipo_gasto = $modify['id_tipo_gasto'];
            $update_gasto->id_taxi       = $modify['id_taxi'];
            $update_gasto->id_chofer     = $modify['id_chofer'];
            $update_gasto->timestamps     = false;
            $update_gasto->save();
            
            //el json es para verificar que si se están enviando los datos
            //return response()->json($modify);
            return redirect('gastos');
        } catch (\Exception $exception) {
            $mensaje = 'Error: Existe algún registro invalido.';

            return redirect('gastos')->with('update', $mensaje);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\gasto  $gasto
     * @return \Illuminate\Http\Response
     */
    public function destroy(gasto $gasto)
    {
        //
        try {
            $gasto->delete();
            return redirect('gastos');
        } catch (\Exception $exception) {
            $mensaje = 'No se pudo eliminar el registro porque se está utilizando en otra tabla.';

            return redirect('gastos')->with('destroy', $mensaje);
        }
    }
}
