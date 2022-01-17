<?php

namespace App\Http\Controllers;

use App\Models\taxi;
use App\Models\estado;
use Illuminate\Http\Request;

class TaxiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $filtro_estado = $request->get('filtro_estado');



        $taxi['taxi'] = taxi::
        join('estados', 'taxis.id_estado', 'estados.id')
        ->where('estado', 'like', "$filtro_estado%")
        ->paginate(50, 
        array('taxis.id', 'taxis.numero', 'taxis.placa', 'taxis.marca', 'taxis.modelo', 'taxis.color', 'estados.estado'));
        $estado['estado'] = estado::paginate(10);
  
        return view('taxis.index', $taxi, $estado);
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
        $datostaxi = request()->except('_token');
        taxi::insert($datostaxi);
        
        return redirect('taxis');
        } catch (\Exception $exception) {
            $mensaje = 'Error: Existe algún registro invalido.';
            
            return redirect('taxis')->with('store', $mensaje);
        }
     
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\taxi  $taxi
     * @return \Illuminate\Http\Response
     */
    public function show(taxi $taxi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\taxi  $taxi
     * @return \Illuminate\Http\Response
     */
    public function edit(taxi $taxi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\taxi  $taxi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, taxi $taxi)
    {
        //
        try {
        $modify      = request()->except('_token', '_method');
        $update_taxi = taxi::find($modify['id']);
        $update_taxi->numero     = $modify['numero'];
        $update_taxi->placa      = $modify['placa'];
        $update_taxi->marca      = $modify['marca'];
        $update_taxi->modelo     = $modify['modelo'];
        $update_taxi->color      = $modify['color'];
        $update_taxi->id_estado  = $modify['id_estado'];
        $update_taxi->timestamps = false;
        $update_taxi->save();

        return redirect('taxis');
        } catch (\Exception $exception) {
            $mensaje = 'Error: Existe algún registro invalido.';
            return redirect('taxis')->with('update', $mensaje);
        }
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\taxi  $taxi
     * @return \Illuminate\Http\Response
     */
    public function destroy(taxi $taxi)
    {
        //
        try {
            $taxi->delete();
            return redirect('taxis');
        } catch (\Exception $exception){
            $mensaje = 'No se pudo eliminar el registro porque se está utilizando en otra tabla. ';
            
            return redirect('taxis')->with('destroy', $mensaje);
        }
    }
}
