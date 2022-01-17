
        <aside class="col-12 col-md-3 col-xl-2 p-0 bg-dark flex-shrink-1">
            <nav class="navbar navbar-expand-md navbar-dark bd-dark flex-md-column flex-row aling-items-center py-2 text-center sticky-top" id="sidebar">

            <div>
                <!--Aquí iría el logo-->
                <a href="{{ url('/') }}" class="h1 navbar-brand mx-0 text-wrap"> Control Tuc Tuc</a>
            </div>

            <button class="navbar-toggler border-0 order-1" type="button" data-bs-toggle="collapse" data-bs-target="#nav" aria-controls="nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
                
            <div class="collapse navbar-collapse prder-last" id="nav">
                <ul class="navbar-nav flex-column w-100 justify-content-center">
                    @guest
                    <li class="nav-item">
                        <a href="{{ url('login') }}" class="nav-link"><!--//todos estos i son de los iconos--><i class="icon ion-md-apps"></i> Login</a>
                    </li>
                    <li class="nav-link">
                        <a href="#" class="nav-link" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBackdrop" aria-controls="offcanvasWithBackdrop"><i class="icon ion-md-construct"></i> Soporte</a>
                    </li>
                    @else
                    <li class="nav-item">
                      <a href="{{ url('/') }}" class="nav-link"><!--//todos estos i son de los iconos--><i class="icon ion-md-apps"></i> Inicio</a>
                    </li>
                    <!--<li class="nav-item">
                      <a href="{{ url('reportes') }}" class="nav-link"><i class="icon ion-md-"></i> Reportes</a>
                    </li>-->
                    <li class="nav-item">
                      <a href="{{ url('ingresos') }}" class="nav-link"><i class="icon ion-md-cash"></i> Ingresos</a>
                    </li>
                    <li class="nav-item">
                      <a href="{{ url('gastos') }}" class="nav-link"><i class="icon ion-md-calculator"></i> Gastos</a>
                    </li>
                    <li class="nav-item">
                      <a href="{{ url('chofer') }}" class="nav-link"><i class="icon ion-md-person"></i> Choferes</a>
                    </li>
                    <li class="nav-item">
                      <a href="{{ url('taxis') }}" class="nav-link"><i class="icon ion-md-car"></i> Taxis</a>
                    </li>
                    <li class="nav-item">
                      <a href="{{ url('estados') }}" class="nav-link"><i class="icon ion-md-reorder"></i> Estados</a>
                    </li>
                    <li class="nav-link">
                      <a href="{{ url('t-g') }}" class="nav-link"><i class="icon ion-md-pie"></i> Tipos de gasto</a>
                    </li>
                    <li class="nav-link">
                      <a href="#" class="nav-link" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBackdrop" aria-controls="offcanvasWithBackdrop"><i class="icon ion-md-construct"></i> Soporte</a>
                    </li>
                    <li class="nav-item">
                      <!--//form para cerrar sesion con js en el onclick-->
                      <form action="{{ url('logout')}}" method="POST" style="display:inline-block;">
                        @csrf
                        <a href="#" onclick="this.closest('form').submit()" class="nav-link"><ion-icon name="log-out"></ion-icon>Cerrar sesión</a>
                      </form>
                    </li>
                    <!--<h4 style="color:#fff;botton:0px;"><b><i>{{ auth()->user()->name }}</i></b></h4>-->
                      @endguest
                    </ul>
                </div>
              </nav>
            </aside>
            
            
            <!--//offcanvas para el formulario-->
            <div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
              <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Colored with scrolling</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
              </div>
              <div class="offcanvas-body">
                <p>Try scrolling the rest of the page to see this option in action.</p>
              </div>
            </div>
            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasWithBackdrop" aria-labelledby="offcanvasWithBackdropLabel">
              <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasWithBackdropLabel">Soporte</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">


<!--//datos de contacto-->
<p><i class="icon ion-logo-whatsapp"></i>  +502 5059 8482</p>
<p><i class="icon ion-md-mail"></i>  kevinalarcon642@gmail.com</p>

<!--//link a las políticas de privacidad, términos y condiciones-->
<label>Lee nuestras <a href="{{ url('politicas') }}">Políticas de Privacidad, Términos de Servicio</a></label>




  </div>
</div>
<div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">Backdroped with scrolling</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <p>Try scrolling the rest of the page to see this option in action.</p>
  </div>
</div>
