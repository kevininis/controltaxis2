<!DOCTYPE html>
    <head>
        <title>Ingresos</title>
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
<p class="fs-1" style="display:inline-block">Ingresos</p>

<!--//logotiposinletras-->
<img src="{{ asset('Logotiposinletras.png') }}" width="130" class="rounded float-end" title="Kevh, lo mejor en software."><br>

<!--//nombre del usuario logeado-->
<h4 class="float-end" style="color:#000;display: inline-block;"><b><i>{{ auth()->user()->name }}</i></b></h4>

<!--//modal para el botón de agregar registros-->
<!-- Button trigger modal -->
<button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#staticBackdrop1" >
    Añadir
</button>


<!-- //Modal -->
<div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Añadir Ingreso</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

<!--//Formulario para agragar registros-->
<form action="{{ url('ingresos') }}" method="POST">
@csrf
    <label>Fecha: </label>
        <input type="date" name="fecha" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
    <label>Recibido: </label>
        <input type="number" step="any" name="recibido" placeholder="Recibido" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
    <label>Taxi: </label>
        <select name="id_taxi" class="form-select form-select-sm" aria-label=".form-select-sm example" required>
            <option value="">Seleccione un Taxi: </option>
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


<!--//botón para los filtros y el collapse-->
<button class="btn btn-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" data-bs-toggle="tooltip" data-bs-placement="right" title="Utiliza los filtros para hacer reportes por fecha, taxi o chofer... ">
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
      
        <input type="date" name="buscarfecha" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
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
<label>Suma de la tabla: {{$suma_ingreso}}</label>
<label class="float-end ">Total: {{$total_ingreso}}</label>

 
<!--//tabla para mostrar los datos-->
<br><br>
<div class="table-responsive">

  <table class="table shadow-lg p-3 mb-5 bg-body rounded">
    <thead class="thead-dark" style="background:#212529;color:#fff;">
      <tr>
        <th scope="col">#</th>
        <th scope="col">Fecha</th>
        <th scope="col">Recibido</th>
        <th scope="col">Número</th>
      <th scope="col">Chofer</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    @foreach($ingreso as $cli)
    <tr>
      <th scope="row">{{ $loop->iteration }}</th>
      <td>{{ $cli->fecha}}</td>
      <td>{{ $cli->recibido}}</td>
      <td>{{ $cli->numero}}</td>
      <td>{{ $cli->nombre}}</td>
      <td>

<!--//modal para modificar-->
<!--// Button trigger modal -->

<button type="submit" onclick="myFunciton ('{{$cli->nombre}}','{{$cli->numero}}')" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop2{{$cli->id}}{{$cli->numero}}" style="display: inline-flex;">
<i class="icon ion-md-create"></i>
</button>

<!-- //Modal -->
<div class="modal fade" id="staticBackdrop2{{$cli->id}}{{$cli->numero}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Modificar Tipo de Gasto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        
<!--//formulario para editar-->
<form action="{{ url('ingresos/'.$cli->id) }}" method="POST">
  @csrf
@method ('PUT')
<input type="hidden" name="id" value="{{$cli->id}}">
<label>Fecha: </label>
<input type="date" name="fecha" value="{{$cli->fecha}}" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
<label>Recibido: </label>
        <input type="number" step="any" name="recibido"  placeholder="Recibido" value="{{$cli->recibido}}" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
    
    
    <label>Taxi: </label>
    <select value="{{$cli->numero}}" name="id_taxi" id="id_taxi" class="form-select form-select-sm" aria-label=".form-select-sm example" required>
            <option value="">Seleccione un Taxi </option>
                @foreach ($taxi as $tax)
                     <option value="{{$tax->id}}" {{$cli->numero == $tax->numero ? 'selected' : ''}}>{{$tax->numero}}</option>
                     @endforeach
        </select>


    <label>Chofer: </label>
    <select value="{{$cli->nombre}}" name="id_chofer" id="id_chofer" class="form-select form-select-sm" aria-label=".form-select-sm example" required>
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
<form action="{{ url('/ingresos/'.$cli->id) }}" method="POST" style="diplay: inline-flex;">
  @csrf
  @method('DELETE')
  <button type="submit" onclick="return confirm('¿Está seguro que desea eliminar este registro?');" class="btn btn-danger"><i class="icon ion-md-trash"></i></button>
</form>



</td>
</tr>
@endforeach
</tbody>
</table>
</div> {{--  TERMINA TABLE RESPONSIVE  --}}






</article>            
</div>
</div>
</div>
</body>
</html>

