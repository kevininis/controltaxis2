<?php

namespace App\Http\Controllers;
use Dotenv\Exception\ValidationException;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException as ValidationValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\ingreso;
use App\Models\gasto;
use Carbon\Carbon;

class LoginController extends Controller
{
    public function login(Request $request) 
    {
        $credentials = $request->validate(
        [
            'email'     => ['required', 'email', 'string'],
            'password'  => ['required', 'string']
        ]);
        // el dump nos deja ver los datos como un json
        //dump($credentials);
    
        //este es el del checkbox para poder recordar sesion
        $remember = $request->filled('remember');
    
    
        //si los credenciales se cumplen inicia sesion sino pues no
        if (Auth::attempt($credentials, $remember)) {
            
            // este es para quitar el fallo de seguridad session fixation, regenera un nuevo token de sesion cada vez que ingresa
            $request->session()->regenerate();
            $mensaje = 'Iniciaste Sesión.';

            return redirect()
            ->intended('/')
            /*el with es para enviar un mensaje una vez logeado, 
            parametros'nombre', 'mensaje'*/
            
            ->with('mensaje', $mensaje);
        };

        //esto es para que salga en el login que no coinciden los credenciales, se puede ponder un mensaje o dejar por defecto
        throw ValidationValidationException::withMessages([
            'password' => 'El correo o la contraseña no son correctos.'
        ]);

    }
    //
    public function logout(Request $request)
    {
        //aqui cerramos sesión
        Auth::logout();

        //invalidamo el token de sesion
        $request->session()->invalidate();

        //regeneramos un nuevo token
        $request->session()->regenerateToken();

        //redireccionamos a la raiz que por defecto si no hay sesion manda al login
        return redirect('/');
    }

    public function index() { 
        //se suma el total de los ingresos y gastos
    $total_ingreso       = ingreso::sum('recibido');
    $total_gasto         = gasto::sum('monto');
    //se hace la resta para obtener un total
    $resta               = $total_ingreso - $total_gasto;

    //fechas
    $hoy                 = Carbon::now()->format('Y-m-d');
    $mes_pasado          = Carbon::now()->sub('1 month')->format('Y-m-d');
    
    //suma del ultimo mes de ingresos y gastos
    $ingreso_mes         = ingreso::whereBetween('fecha', [$mes_pasado, $hoy])->get()->sum('recibido');
    $gasto_mes           = gasto::whereBetween('fecha', [$mes_pasado, $hoy])->get()->sum('monto');
    $resta_mes           = $ingreso_mes - $gasto_mes;
    
    //fechas estéticamente ordinadas
    $hoy2                = Carbon::now()->format('d/m/Y');
    $mes_pasado2         = Carbon::now()->sub('1 month')->format('d/m/Y');


    return view('index.index', 
    compact('total_ingreso', 'total_gasto', 'resta', 'hoy', 'mes_pasado', 'ingreso_mes', 'gasto_mes', 'resta_mes', 'hoy2', 'mes_pasado2'));  
    }
}
