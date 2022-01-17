<!DOCTYPE html>
    <head>
        <title>Inicio</title>
        @include ('head')
    </head>
    <body>
            <div class="container-fluid">
                <div class="row min-vh-100 flex-column flex-md-row">

                    @include ('nav')
                        <!--//Aquí va el contenido del la app-->
                        <main class="col px-0 flex-grow-1">
                            <div class="container py-3">
                                <article> 

                    <!--//Nombre del ususario logeado-->
                    <h4 style="color:#000;botton:0px;display:inline-block;" class="float-end"><b><i>{{ auth()->user()->name }}</i></b></h4>

                                    <h1 style="text-align:center;">Inicio del sistema</h1>
                                    <!--//esto es para recibir y mostrar el mensaje de sesión-->
                                            @if(session('mensaje'))
                                                <p class="alert alert-success d-inline ">{{ session('mensaje') }}</p>
                                            @endif
<table class="table ">
    <thead style="background:#212529;color:#fff;">
        <th></th>
        <th>Ingresos</th>
        <th>Gastos</th>
        <th>Ganancia</th>
    </thead>
    <tbody>
        <tr>
            <th style="background:#212529;color:#fff;">Todos los registros</th>
            <td>
                Ingresos totales: <label>Q {{$total_ingreso}}</label>
            </td>
            <td>
                Gastos totales: <label>Q {{$total_gasto}}</label>
            </td>
            @if ($resta < 0)
            <td>
                Ingresos menos Gastos totales: <label style="color:red;">Q {{$resta}}</label>
            </td>
            @else
            <td>
                Ingresos menos Gastos totales: <label style="color:green">Q {{$resta}}</label>
            </td>
            @endif
        </tr>
        <tr>
            <th style="background:#212529;color:#fff;">Registros de este mes<br>
            ({{$mes_pasado2}} - {{$hoy2}})</th>
            <td>
                Ingresos de este mes: <label>Q {{$ingreso_mes}}</label>
            </td>
            <td>
                Gastos de este mes: <label>Q {{$gasto_mes}}</label>
            </td>
            @if ($resta_mes < 0)
            <td>
                Ingresos menos Gastos de este mes: <label style="color:red;">Q {{$resta_mes}}</label>
            </td>
            @else 
            <td>
                Ingresos menos Gastos de este mes: <label style="color:green">Q {{$resta_mes}}</label>
            </td>
            @endif
        </tr>
    </tbody>
</table>
                                        <img src="{{ asset('logolobo.png')}}" class="rounded mx-auto d-block" width="290" title="Kevh, lo mejor en software.">
                               
                                </article>            
                            </div>

                </div>
            </div>
        </main>
    </body>
</html>