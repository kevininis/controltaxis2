<!DOCTYPE html>
    <head>
        <title>Login</title>
        @include('head')
    </head>  
    <body class="background-login">
        <div class="row justify-content-center">  
            <div class="col-md-4 col-sm-12">
                <div class="card mt-5">
                        <h1 class="text-center">Login</h1>
                        <form action="{{ url('login') }}" method="POST" style="text-align:center">
                            @CSRF
                            <div class="row justify-content-center">
                                <div class="col-md-10 col-sm-12">
                                    <label>Correo</label><br>
                                    <input type="email" placeholder="Correo" name="email" value="{{ old('email') }}" class="form-control myInput" autofocus required>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-md-10 col-sm-12">
                                    <label>Contraseña</label><br>
                                    <input type="password" placeholder="Contraseña" name="password" class="form-control myInput" required>        
                                </div>
                            </div>
                            
                            <div class="row justify-content-center">
                                <div class="col-md-10 col-sm-12">
                                    <input id="recordarSesion" type="checkbox" name="remember">
                                    <label for="recordarSesion">Mantener mi sesión</label>
                                </div>
                            </div>
                            
                            <input type="submit" class="btn btn-dark" value="Ingresar"><br>
                            <!--//aquí se muestran los mensajes-->
                            
                            @error('email') {{ $message }} @enderror<br>
                            @error('password') {{ $message }} @enderror<br>
                            
                            <div class="row justify-content-center">
                                <div class="col-md-10 col-sm-12">
                                    <label class="firts">Al utilizar nuestros Servicios aceptas nuestras <a href="{{ url('politicas') }}">Políticas de Privacidad, Términos de Servicio</a></label>
                                </div>
                            </div>
                                </form> {{--  END LOGIN-FORM  --}}          
                </div> {{-- END CARD --}}
            </div> {{--  END COL  --}}
        </div> {{--  END DIV ROW  --}}
    </body>
</html>