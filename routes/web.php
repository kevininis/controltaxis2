<?php

use App\Models\User;
use App\Http\Controllers\ChoferController;
use App\Http\Controllers\EstadoController;
use App\Http\Controllers\GastoController;
use App\Http\Controllers\IngresoController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\TaxiController;
use App\Http\Controllers\TipoGastoController;
use Dotenv\Exception\ValidationException;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException as ValidationValidationException;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/*ruta de inicio dirigida hacia el index 
el middleware es para que sino está autenticado lo redirija hacia el login
sino te funciona el login tienes que cambiar el archivo de la ruta app/http/middleware/autenticate en la funcion redirecTo
hacia donde quieres que te redirija

o ponerle nombre a la ruta del login, ejemplo ->name('login')

el middelware guest es para que si ya está autenticado lo redirija hacia el inicio de la aplicacion, pero hay que cambiar
el codigo del archivo en la ruta app/providers/RouteServiseProviders y cambiar la constante home hacia el
inicio de tu aplicacion
*/

//dd(User::first()->toArray());

Route::get('/', [LoginController::class, 'index'])->middleware('auth');
 
//ruta para el login de tipo get
route::get('/login', function() {
    return view('login.login');
})->middleware('guest');


//ruta de login de tipo post
route::post('/login', [LoginController::class, 'login']);
//ruta para el logout tipo post
route::post('/logout', [LoginController::class, 'logout']);



//ruta hacia los terminos y condiciones, politacas de privacidad
route::get('/politicas', function() {
    return view('politicas');
});



//ruta hacia los reportes
//route::resource('/reportes', ReporteController::class)->middleware('auth');



//rutas para las demás áreas
Route::resource('/t-g',      TipoGastoController::class)->middleware('auth');
Route::resource('/estados',  EstadoController::class)->middleware('auth');
Route::resource('/taxis',    TaxiController::class)->middleware('auth');
Route::resource('/chofer',   ChoferController::class)->middleware('auth');
Route::resource('/gastos',   GastoController::class)->middleware('auth');
Route::resource('/ingresos', IngresoController::class)->middleware('auth');