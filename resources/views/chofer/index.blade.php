<!DOCTYPE html>
    <head>
        <title>Choferes</title>
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
<p class="fs-1" style="display:inline-block">Choferes</p>

<!--//logotiposinletras-->
<img src="{{ asset('Logotiposinletras.png') }}" width="130" class="rounded float-end" title="Kevh, lo mejor en software."><br>

<!--//nombre del usuario logeado-->
<h4 class="float-end" style="color:#000;display: inline-block;"><b><i>{{ auth()->user()->name }}</i></b></h4>

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
<form action="{{ url('chofer')}}" method="post">
@csrf
    <label>Nombre: </label><br>
        <input type="text" name="nombre" placeholder="Nombre" maxlength="45"class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required><br>
    <label>Apellido: </label><br>
        <input type="text" name="apellido" placeholder="Apellido" maxlength="45" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
    <label>DPI: </label>
        <input type="text" name="dpi" placeholder="DPI" minlength="13" maxlength="13" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
    <label>Fecha de Nacimiento: </label>
        <input type="date" name="fecha_nacimiento" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
    <label>Número de documento de licencia: </label>
        <input type="number" name="numero_documento" minlength="9" maxlength="9" placeholder="Número de documento de licencia" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
    <label>Tipo de Licencia: </label>
        <input type="text" name="tipo_licencia" placeholder="Tipo de licencia" maxlength="1" style="text-transform:uppercase;" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
    <label>Fecha de Vencimiento de la Licencia: </label>
        <input type="date" name="vencimiento_licencia" min="today" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
    <label>Tipo de Sangre: </label>
        <input type="text" name="tipo_sangre" value="N/A" placeholder="Tipo de Sangre" maxlength="4" style="text-transform:uppercase;" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
    <label>Restricciones: </label>
        <input type="textbox" name="restricciones" placeholder="Restricciones" maxlength="500" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" value="Ninguna" required>
    <label>Estado</label>
        <select name="id_estado" id="id_estado" class="form-select form-select-sm" aria-label=".form-select-sm example" required>
            <option value="">Seleccione un Estado</option>
            @foreach ($estado as $estados)
                <option value="{{$estados->id}}">{{$estados->estado}}</option>
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
<button class="btn btn-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
    Filtros
</button>


<!--//esta es la paginación-->
<div class="rounded float-end" style="display: inline-block">
  {{$chofer->links('pagination::bootstrap-4')}}
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

        <input type="search" name="buscarnombre" placeholder="Filtrar por Nombre" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
        <input type="search" name="buscarapellido" placeholder="Filtrar por Apellido" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
        <input type="text" name="buscardpi" placeholder="DPI" value="" maxlength="13" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
      <select name="buscarestado" class="form-select form-select-sm" aria-label=".form-select-sm example">
            <option value="">Filtrar por Estado</option>
        @foreach($estado as $estados)
            <option>{{$estados->estado}}</option>
        @endforeach
      </select>
        <button class="btn btn-secondary" type="submit">Filtrar</button>
      </form>
  </div>
</div>


<!--//tabla para mostrar los datos-->
<br><br>
<div class="table-responsive">

  <table class="table shadow-lg p-3 mb-5 bg-body rounded">
    <thead class="thead-dark" style="background:#212529;color:#fff;display:;">
      <tr>
        <th scope="col" >#</th>
        <th scope="col" >Nombre</th>
        <th scope="col" >Apellido</th>
        <th scope="col" >DPI</th>
        <th scope="col" >Fecha de Nacimiento</th>
        <th scope="col" >No. Documento</th>
      <th scope="col" >Tipo de Licencia</th>
      <th scope="col" >Vencimiento de Licencia</th>
      <th scope="col" >Tipo de Sangre</th>
      <th scope="col" >Restricciones</th>
      <th scope="col" >Estado</th>
      <th scope="col" ></th>
    </tr>
  </thead>
  <tbody>
    @foreach($chofer as $cli)
    <tr>
      <th scope="row">{{ $loop->iteration }}</th>
      <td>{{ $cli->nombre}}</td>
      <td>{{ $cli->apellido}}</td>
      <td>{{ $cli->dpi}}</td>
      <td>{{ $cli->fecha_nacimiento}}</td>
      <td>{{ $cli->numero_documento}}</td>
      <td style="text-transform:uppercase;">{{ $cli->tipo_licencia}}</td>
      <td>{{ $cli->vencimiento_licencia}}</td>
      <td style="text-transform:uppercase;">{{ $cli->tipo_sangre}}</td>
      <td>{{ $cli->restricciones}}</td>
      <td>{{ $cli->estado}}</td>
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
        <form action="{{ url('chofer/'.$cli->id)}}" method="post">
          @csrf
          @method ('PUT')
          <input type="hidden" name="id" value="{{$cli->id}}" readonly>
          <label>Nombre: </label>
          <input type="text" name="nombre" value="{{$cli->nombre}}" placeholder="Nombre" maxlength="45" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
          <label>Apellido: </label>
          <input type="text" name="apellido" value="{{$cli->apellido}}" placeholder="Apellido" maxlength="45" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
          <label>DPI: </label>
          <input type="text" name="dpi" value="{{$cli->dpi}}" placeholder="DPI" minlength="13" maxlength="13" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
          <label>Fecha de Nacimiento: </label>
          <input type="date" name="fecha_nacimiento" value="{{$cli->fecha_nacimiento}}" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
          <label>Número de documento de licencia: </label>
          <input type="number" name="numero_documento" minlength="9" maxlength="9" value="{{$cli->numero_documento}}" placeholder="Número de documento de licencia" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
          <label>Tipo de Licencia: </label>
        <input type="text" name="tipo_licencia" value="{{$cli->tipo_licencia}}" placeholder="Tipo de licencia" maxlength="1" style="text-transform:uppercase;" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
        <label>Fecha de Vencimiento de la Licencia: </label>
        <input type="date" name="vencimiento_licencia" value="{{$cli->vencimiento_licencia}}" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
        <label>Tipo de Sangre: </label>
        <input type="text" name="tipo_sangre" value="{{$cli->tipo_sangre}}" placeholder="Tipo de Sangre" maxlength="4" style="text-transform:uppercase;" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
        <label>Restricciones: </label>
        <input type="textbox" name="restricciones" value="{{$cli->restricciones}}" placeholder="Restricciones" maxlength="500" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" value="Ninguna" required>
        <label>Estado</label>
        <select value="{{$cli->estado}}" name="id_estado" id="id_estado" class="form-select form-select-sm" aria-label=".form-select-sm example" required>
          <option value="">Seleccione un Estado</option>
          @foreach ($estado as $estados)
          <option value="{{$estados->id}}" {{$cli->estado == $estados->estado ? 'selected' : ''}}>{{$estados->estado}}</option>
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
<form action="{{ url('/chofer/'.$cli->id) }}" method="POST" style="diplay: inline-flex;">
  @csrf
  @method('DELETE')
  <button type="submit" onclick="return confirm('¿Está seguro que desea eliminar este registro?');" class="btn btn-danger"><i class="icon ion-md-trash"></i></button>
</form>





</td>
</tr>
@endforeach
</tbody>
</table>
</div>



</article>
</div>
</main>
</div>
</div>
</body>

</html>