<!DOCTYPE html>
    <head>
        <title>Gastos</title>
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

<!--//título para saber en que tabla estamos-->
<p class="fs-1" style="display:inline-block">Gastos</p>

<!--//logotiposinletras-->
<img src="{{ asset('Logotiposinletras.png') }}" width="130" class="rounded float-end" title="Kevh, lo mejor en software."><br>

<!--//Nombre del ususario logeado-->
<h4 style="color:#000;botton:0px;display:inline-block;" class="float-end"><b><i>{{ auth()->user()->name }}</i></b></h4>


<!--//modal para el botón de agregar registros-->
<!-- Button trigger modal -->
<button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#staticBackdrop1">
    Añadir
</button>

<!-- //Modal -->
<div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Añadir Chofer</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">


<!--//Formulario para agragar registros-->
<form action="{{ url('gastos') }}" method="POST">
@csrf
    <label>Fecha: </label>
        <input type="date" name="fecha" placeholder="Fecha" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
    <label>Monto: </label>
        <input type="number" step="any" name="monto" placeholder="Monto" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
    <label>Observaciones: </label>
        <input type="text" name="observaciones" value="Ninguna" placeholder="Observaciones" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
    <label>Tipo de gasto: </label>
        <select name="id_tipo_gasto" class="form-select form-select-sm" aria-label=".form-select-sm example" required>
            <option value="">Seleccione un Tipo de Gasto</option>
                @foreach ($tipo_gasto as $gas)
                    <option value="{{$gas->id}}">{{$gas->tipo}}</option>
                @endforeach
        </select>
    <label>Taxi: </label>
        <select name="id_taxi" class="form-select form-select-sm" aria-label=".form-select-sm example" required>
            <option value="">Seleccione un Taxi</option>
                @foreach ($taxi as $tax)
                    <option value="{{$tax->id}}">{{$tax->numero}}</option>
                @endforeach
        </select>
    <label>Chofer: </label>
        <select name="id_chofer" class="form-select form-select-sm" aria-label=".form-select-sm example" required>
            <option value="">Seleccione un Chofer</option>
                @foreach ($chofer as $cho)
                    <option value="{{$cho->id}}">{{$cho->nombre}}</option>
                @endforeach
        </select>



      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-dark">Añadir</button>
    </form><br>
      </div>
    </div>
  </div>
</div>

<!--//botón para los filtros-->
<button class="btn btn-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" title="Utiliza los filtros para hacer reportes">
    Filtros
  </button>

<!--//esta es la paginación-->
<div class="rounded float-end" style="display: inline-block">
  {{$gasto->links('pagination::bootstrap-4')}}
</div>

<!--//esto es para recibir y mostrar el mensaje de sesión-->
@if(session('mensaje'))
    <p class="alert alert-success d-inline">{{ session('mensaje') }}</p>
@endif 

<!--//esto es para recibir y mostrar el mensaje del store en la creación de nuevos registros-->
@if(session('store'))
  <p class="alert alert-danger d-inline">{{ session('store') }}</p>
@endif

<!--//aquí recibimos el mensaje de error del update al modificar datos-->
@if(session('update'))
  <p class="alert alert-danger d-inline">{{session('update')}}</p>
@endif

<!--//aquí se reciben los mensajes del error del destroy cuando no se pueden borrar datos-->
@if(session('destroy'))
  <p class="alert alert-danger d-inline">{{session('destroy')}}</p>
@endif



<!--//lo que despliega el collapse (los filtros)-->
<div class="collapse" id="collapseExample">
  <div class="card card-body">
        <form>
        <input name="buscarfecha" type="date" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
      <select name="buscartaxi" name="id_taxi" class="form-select form-select-sm" aria-label=".form-select-sm example">
                <option value="">Filtrar por taxi</option>
              @foreach($taxi as $tax)
                <option>{{$tax->numero}}</option> 
              @endforeach
      </select> 
      <select name="buscarchofer" class="form-select form-select-sm" aria-label=".form-select-sm example">
            <option value="">Filtrar por Chofer</option>
        @foreach($chofer as $chofers)
            <option>{{$chofers->nombre}}</option>
        @endforeach
      </select>
      <button class="btn btn-secondary" type="submit">Filtrar</button>
    </form>
  </div>
</div>

<!--//Aquí se reciben las operaciones aritmeticas-->
<br>
<br>
<!--//recibe la suma de los registros que se reciben en la tabla-->
<label class="">Suma de la tabla: {{$suma_gasto}}</label>
<!--//recibe el total de gastos-->
<label class="float-end">Total: {{$total_gasto}}</label>



<!--//tabla para mostrar los datos-->
<br><br>
<table class="table shadow-lg p-3 mb-5 bg-body rounded">
  <thead class="thead-dark" style="background:#212529;color:#fff;">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Fecha</th>
      <th scope="col">Monto</th>
      <th scope="col">Observaciones</th>
      <th scope="col">Tipo de Gasto</th>
      <th scope="col">Taxi</th>
      <th scope="col">Chofer</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    @foreach($gasto as $cli)
    <tr>
      <th scope="row">{{ $loop->iteration }}</th>
      <td>{{ $cli->fecha}}</td>
      <td>{{ $cli->monto}}</td>
      <td>{{ $cli->observaciones}}</td>
      <td>{{ $cli->tipo}}</td>
      <td>{{ $cli->numero}}</td>
      <td>{{ $cli->nombre}}</td> 
      <td>

<!--//modal para modificar-->
<!-- Button trigger modal -->

<button type="submit" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop2{{$cli->id}}" style="display: inline-flex;">
<i class="icon ion-md-create"></i>
</button>

<!-- //Modal -->
<div class="modal fade" id="staticBackdrop2{{$cli->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Modificar Tipo de Gasto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

<!--//formulario para editar-->
<form action="{{ url('gastos/'.$cli->id) }}" method="post">
@csrf
@method ('PUT')
        <input type="hidden" name="id" value="{{$cli->id}}" required>
    <label>Fecha: </label>
        <input type="date" name="fecha" value="{{$cli->fecha}}" placeholder="Fecha" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
    <label>Monto: </label>
        <input type="number" step="any" name="monto" value="{{$cli->monto}}" placeholder="Monto" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
    <label>Observaciones: </label>
        <input type="text" name="observaciones" value="{{$cli->observaciones}}" placeholder="Observaciones" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
    <label>Tipo de gasto: </label>
        <select value="{{$cli->tipo}}" name="id_tipo_gasto"  class="form-select form-select-sm" aria-label=".form-select-sm example" required>
            <option value="">Seleccione un Tipo de Gasto</option>
                @foreach ($tipo_gasto as $gas)
                    <option value="{{$gas->id}}" {{$cli->tipo == $gas->tipo ? 'selected' : ''}}>{{$gas->tipo}}</option>
                @endforeach
        </select>
    <label>Taxi: </label>
        <select value="{{$cli->numero}}" name="id_taxi" class="form-select form-select-sm" aria-label=".form-select-sm example" required>
            <option value="">Seleccione un Taxi</option>
                @foreach ($taxi as $tax)
                    <option value="{{$tax->id}}" {{$cli->numero == $tax->numero ? 'selected' : ''}}>{{$tax->numero}}</option>
                @endforeach
        </select>
    <label>Chofer: </label>
        <select value="{{$cli->nombre}}" name="id_chofer" class="form-select form-select-sm" aria-label=".form-select-sm example" required>
            <option value="">Seleccione un Chofer</option>
                @foreach ($chofer as $cho)
                    <option value="{{$cho->id}}" {{$cli->nombre == $cho->nombre ? 'selected' : ''}}>{{$cho->nombre}}</option>
                @endforeach
        </select>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-dark">Modificar</button>
</form>
      </div>
    </div>
  </div>
</div>


<!--//formulario para eliminar-->
<form action="{{ url('/gastos/'.$cli->id) }}" method="POST" style="diplay: inline-flex;">
@csrf
@method('DELETE')
<button type="submit" onclick="return confirm('¿Está seguro que desea eliminar este registro?');" class="btn btn-danger"><i class="icon ion-md-trash"></i></button>
</form>


      </td>
    </tr>
    @endforeach
  </tbody>
</table>

                                </article>
                            </div>
                        </main>
            </div>
        </div>
    </body>
</html>