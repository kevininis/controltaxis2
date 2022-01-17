<!DOCTYPE html>
    <head>
        <title>Taxis</title>
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
<p class="fs-1" style="display:inline-block;">Taxis</p>

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
        <h5 class="modal-title" id="staticBackdropLabel">Añadir Taxi</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

<!--//Formulario para agragar registros-->
<form action="{{ url('taxis') }}" method="POST">
@csrf
    <label>Número: </label>
        <input type="number" name="numero" placeholder="Número" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-deafult" required>
    <label>Placa: </label>
        <input type="text" name="placa" placeholder="Placa" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-deafult" style="text-transform:uppercase;" required>
    <label>Marca: </label>
        <input type="text" name="marca" placeholder="Marca" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-deafult" required>
    <label>Modelo: </label>
        <input type="text" name="modelo" placeholder="Modelo" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-deafult" required>
    <label>Color: </label>
        <input type="text" name="color" placeholder="Color" class="form-control" aria-label="Sizing example input" 
        aria-describedby="inputGroup-sizing-deafult" required>
    <label>Estado: </label>
        <select name="id_estado" class="form-select form-select-sm" aria-label=".form-select-sm example" required>
            <option value="">Seleccione un estado</option>
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
<div class="rounded float-end btn" style="display: inline-block;">
  {{$taxi->links('pagination::bootstrap-4')}}
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

      <select name="filtro_estado" class="form-select form-select-sm" aria-label=".form-select-sm example">
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
<table class="table shadow-lg p-3 mb-5 bg-body rounded">
  <thead class="thead-dark" style="background:#212529;color:#fff;">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Número</th>
      <th scope="col">Placa</th>
      <th scope="col">Marca</th>
      <th scope="col">Modelo</th>
      <th scope="col">Color</th>
      <th scope="col">Estado</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    @foreach($taxi as $cli)
    <tr>
      <th scope="row">{{ $loop->iteration }}</th>
      <td>{{ $cli->numero}}</td>
      <td style="text-transform:uppercase;">{{ $cli->placa}}</td>
      <td>{{ $cli->marca}}</td>
      <td>{{ $cli->modelo}}</td>
      <td>{{ $cli->color}}</td>
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
        <h5 class="modal-title" id="staticBackdropLabel">Modificar Taxi</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

<!--//formulario para editar-->
<form action="{{ url('taxis/'.$cli->id) }}" method="POST">
@csrf
@method ('PUT')
        <input type="hidden" name="id" value="{{$cli->id}}"  readonly>
    <label>Número: </label>
        <input type="number" name="numero" value="{{$cli->numero}}" placeholder="Número" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-deafult" required>
    <label>Placa: </label>
        <input type="text" name="placa" value="{{$cli->placa}}" placeholder="Placa" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-deafult" style="text-transform:uppercase;" required>
    <label>Marca: </label>
        <input type="text" name="marca" value="{{$cli->marca}}" placeholder="Marca" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-deafult" required>
    <label>Modelo: </label>
        <input type="text" name="modelo" value="{{$cli->modelo}}" placeholder="Modelo" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-deafult" required>
    <label>Color: </label>
        <input type="text" name="color" value="{{$cli->color}}" placeholder="Color" class="form-control" aria-label="Sizing example input" 
        aria-describedby="inputGroup-sizing-deafult" required>
        
    <label>Estado: </label>
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
<form action="{{ url('/taxis/'.$cli->id) }}" method="POST" style="diplay: inline-flex;">
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