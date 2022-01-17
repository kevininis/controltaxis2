<?php

namespace App\Http\Controllers;

use App\Models\reporte;
use App\Models\ingreso;
use App\Models\gasto;
use App\Models\chofer;
use App\Models\taxi;
use Illuminate\Http\Request;
use Carbon\Carbon;
 
class ReporteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(request $request)
    {
        
        //definimos que queremos los datos y que vamos a sumar para enviarlo
        $fecha_ingreso  = ingreso::whereDate('fecha', carbon::today())->get();
        $total_ingresos_hoy = $fecha_ingreso->sum('recibido');
        $fecha_gastos   = gasto::whereDate('fecha', carbon::today())->get();
        $total_gastos_hoy   = $fecha_gastos->sum('monto');

        $taxi = taxi::paginate();

        return view('reportes.reportes', compact('total_ingresos_hoy', 'total_gastos_hoy', 'taxi'));




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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\reporte  $reporte
     * @return \Illuminate\Http\Response
     */
    public function show(reporte $reporte)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\reporte  $reporte
     * @return \Illuminate\Http\Response
     */
    public function edit(reporte $reporte)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\reporte  $reporte
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, reporte $reporte)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\reporte  $reporte
     * @return \Illuminate\Http\Response
     */
    public function destroy(reporte $reporte)
    {
        //
    }
}
