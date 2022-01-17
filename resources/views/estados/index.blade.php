<!DOCTYPE html>
    <head>
        <title>Estados</title>
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
<p class="fs-1" style="display:inline-block;">Estados</p>

<!--//logotiposinletras-->
<img src="{{ asset('Logotiposinletras.png') }}" width="130" class="rounded float-end" title="Kevh, lo mejor en software."><br

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
        <h5 class="modal-title" id="staticBackdropLabel">Añadir Estado</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

<!--//Formulario para agragar registros-->
<form action="{{ url('estados') }}" method="POST">
@csrf
        <label>Estado: </label><br>
            <input type="text" name="estado" placeholder="Estado" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required><br>
        <label>Descripción: </label><br>
            <input type="text" name="descripcion" placeholder="Descripción" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required><br>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-dark">Añadir</button>
    </form><br>
      </div>
    </div>
  </div>
</div> 


<!--//esta es la paginación-->
<div class="rounded float-end" style="display: inline-block">
  {{$estado->links('pagination::bootstrap-4')}}
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


<!--//tabla para mostrar los datos-->
<br><br>
<table class="table shadow-lg p-3 mb-5 bg-body rounded">
  <thead class="thead-dark" style="background:#212529;color:#fff;">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Estado</th>
      <th scope="col">Descripción</th>
      <th scope="col"></th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    @foreach($estado as $cli)
    <tr>
      <th scope="row">{{ $loop->iteration }}</th>
      <td>{{ $cli->estado}}</td>
      <td>{{ $cli->descripcion}}</td>
      <td>

<!--//modal para modificar
<!-- Button trigger modal -->
<button type="submit" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop2{{$cli->id}}" style="display: inline-flex;">
<i class="icon ion-md-create"></i>
</button>

<!-- //Modal -->
<div class="modal fade" id="staticBackdrop2{{$cli->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Modificar Estado</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

<!--//formulario para editar-->
<form action="{{ url('estados/'.$cli->id)}}" method="POST">
@csrf
@method('PUT')

        <input type="hidden" name="id" value="{{$cli->id}}" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
    <label>Estado: </label><br>
        <input type="text" name="estado" value="{{$cli->estado}}"  class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required><br>
    <label>Descripción: </label><br>
        <input type="text" name="descripcion" value="{{$cli->descripcion}}" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required><br>


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
<form action="{{ url('estados/'.$cli->id) }}" method="POST">
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
<!--//esto es para recibir y mostrar el mensaje del destroy-->
@isset($mensaje)
<script type="text/javascript">
  alert("No se pudo eliminar el registro porque se está utilizando en otra tabla.");
</script>
@endisset
</html>