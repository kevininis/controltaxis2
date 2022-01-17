<?php

namespace App\Http\Controllers;

use App\Models\ingreso;
use App\Models\taxi;
use App\Models\chofer;
use Illuminate\Http\Request;

class IngresoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    { 
        //aquí estan las variables de las busquedas
        $buscar_fecha  = $request->get('buscarfecha');
        $buscar_taxi   = $request->get('buscartaxi');
        $buscar_chofer = $request->get('buscarchofer');
 
        //variable principal 
        $ingreso = ingreso::join('taxis', 'ingresos.id_taxi', 'taxis.id')
        ->join('chofers', 'ingresos.id_chofer', 'chofers.id')
        ->orderby('fecha', 'desc')
        
        //se emplean las busquedas con el método where
        ->where('fecha', 'like', "%$buscar_fecha%")
        ->where('numero','like',"%$buscar_taxi%")
        ->where('nombre','like',"%$buscar_chofer%")

        //el número de registros que queremos que pagine nuestra app
        ->paginate(50,
        array('ingresos.id', 'ingresos.fecha', 'ingresos.recibido', 'taxis.numero', 'chofers.nombre'));
        $taxi = taxi::paginate(50);
        $chofer = chofer::paginate(50);

        //operaciones aritmeticas
        //suma del total de los registros
        $total_ingreso = ingreso::sum('recibido');

        //suma de lo que se muestra en la tabla
        $suma_ingreso = $ingreso->sum('recibido');

        return view('ingresos.index', compact('ingreso', 'taxi', 'chofer', 'suma_ingreso', 'total_ingreso'));
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
            $datosingresos = request()->except('_token');
            ingreso::insert($datosingresos);

            return redirect('ingresos');
        } catch (\Exception $exception) {
            $mensaje = 'Error: Existe algún registro invalido.';

            return redirect('ingresos')->with('store', $mensaje);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ingreso  $ingreso
     * @return \Illuminate\Http\Response
     */
    public function show(ingreso $ingreso)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ingreso  $ingreso
     * @return \Illuminate\Http\Response
     */
    public function edit(ingreso $ingreso)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ingreso  $ingreso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ingreso $ingreso)
    {
        //
        try {
            $modify = request()->except('_token', '_method');
            $update_ingreso = ingreso::find($modify['id']);
            $update_ingreso->fecha = $modify['fecha'];
            $update_ingreso->recibido = $modify['recibido'];
            $update_ingreso->id_taxi = $modify['id_taxi'];
            $update_ingreso->id_chofer = $modify['id_chofer'];
            $update_ingreso->timestamps = false;
            $update_ingreso->save();

            return redirect('ingresos');
        } catch (\Exception $exception) {
            $mensaje = 'Error: Existe algún registro invalido.';

            return redirect('ingresos')->with('update', $mensaje);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ingreso  $ingreso
     * @return \Illuminate\Http\Response
     */
    public function destroy(ingreso $ingreso)
    {
        //
        try {
            $ingreso->delete();
            return redirect('ingresos');
        } catch (\Exception $e) {
            $mensaje = 'No se pudo eliminar el registro porque se está utilizado en otra tabla.';

            return redirect('ingresos')->with('destroy', $mensaje);
        }
    }
}
