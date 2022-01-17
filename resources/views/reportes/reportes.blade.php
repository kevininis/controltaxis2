<!DOCTYPE html>
    <head>
        <title>Reportes</title>
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
                                <h1>Reportes</h1>

<h3>Ingresos</h3>
@foreach($taxi as $tax)
{{$tax->numero}}-<br>
@endforeach
Ingresos de hoy: {{$total_ingresos_hoy}}
<br>
Gastos de hoy: {{$total_gastos_hoy}}




                                </article>
                            </div>
                        </main>
            </div>
        </div>
    </body>
</html>