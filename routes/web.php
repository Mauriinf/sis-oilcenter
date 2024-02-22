<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PerfilController;

use App\Http\Controllers\CategoriaController as Categoria;
use App\Http\Controllers\ArticuloController as Articulo;
use App\Http\Controllers\IngresoController as Ingreso;
use App\Http\Controllers\VentaController as Venta;


use App\Http\Controllers\TipoServicioController as Tipos;
use App\Http\Controllers\ServicioController as Servicios;
use App\Http\Controllers\PublicacionController as Publicacion;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['middleware' => ['auth']], function() {
    Route::get('calendario', [App\Http\Controllers\HomeController::class, 'calendario'])->name('calen');
    Route::resource('roles', RoleController::class);
    Route::delete('roles_mass_destroy', 'Admin\RolesController@massDestroy')->name('roles.mass_destroy');
    Route::resource('users', UserController::class);
    Route::resource('permissions', PermissionController::class);
    Route::delete('permissions_mass_destroy', 'Admin\PermissionsController@massDestroy')->name('permissions.mass_destroy');

    // mi perfil
    Route::get('/perfil', [PerfilController::class, 'index'])->name('perfil.index');
    Route::put('/perfil', [PerfilController::class, 'actualizar'])->name('perfil.actualizar');
    Route::get('/password', [PerfilController::class, 'password'])->name('password');
    Route::put('/password', [PerfilController::class, 'password_actualizar'])->name('password.actualizar');

    Route::get('/categoria', [Categoria::class, 'index'])->name('categoria.index');
    Route::post('/categoria', [Categoria::class, 'store'])->name('categoria.store');
    Route::put('/categoria/{id}', [Categoria::class, 'update'])->name('categoria.update');
    Route::put('/categoria/enable/{id}', [Categoria::class, 'enable'])->name('categoria.enable');
    Route::put('/categoria/disable/{id}', [Categoria::class, 'disable'])->name('categoria.disable');

    Route::get('/articulo', [Articulo::class, 'index'])->name('articulo.index');
    Route::get('articulo/create', [Articulo::class, 'create'])->name('articulo.create');
    Route::post('/articulo', [Articulo::class, 'store'])->name('articulo.store');
    Route::get('articulo/edit/{id}', [Articulo::class, 'edit'])->name('articulo.edit');
    Route::put('/articulo/{id}', [Articulo::class, 'update'])->name('articulo.update');
    Route::get('/articulo/disable/{id}', [Articulo::class, 'disable'])->name('articulo.disable');
    Route::get('/articulo/enable/{id}', [Articulo::class, 'enable'])->name('articulo.enable');

    Route::get('/ingreso', [Ingreso::class, 'index'])->name('ingreso.index');
    Route::get('ingreso/create', [Ingreso::class, 'create'])->name('ingreso.create');
    Route::post('/ingreso', [Ingreso::class, 'store'])->name('ingreso.store');
    Route::get('ingreso/show/{id}', [Ingreso::class, 'show'])->name('ingreso.show');
    Route::get('ingreso/edit/{id}', [Ingreso::class, 'edit'])->name('ingreso.edit');
    Route::put('/ingreso/{id}', [Ingreso::class, 'update'])->name('ingreso.update');
    Route::put('/ingreso/show/payment/{id}', [Ingreso::class, 'payment'])->name('ingreso.show.payment');
    Route::get('/ingreso/cancel/{id}', [Ingreso::class, 'cancel'])->name('ingreso.cancel');

    Route::get('/venta', [Venta::class, 'index'])->name('venta.index');
    Route::get('venta/create', [Venta::class, 'create'])->name('venta.create');
    Route::post('/venta', [Venta::class, 'store'])->name('venta.store');
    Route::get('venta/show/{id}', [Venta::class, 'show'])->name('venta.show');
    Route::get('venta/edit/{id}', [Venta::class, 'edit'])->name('venta.edit');
    Route::put('/venta/{id}', [Venta::class, 'update'])->name('venta.update');
    Route::put('/venta/show/payment/{id}', [Venta::class, 'payment'])->name('venta.show.payment');
    Route::get('/venta/cancel/{id}', [Venta::class, 'cancel'])->name('venta.cancel');


    Route::get('tipos/servicios', [Tipos::class,'index'])->name('tiposervicio.index');
    Route::get('lista/tipos/servicios', [Tipos::class,'lista_tipos'])->name('lista.tiposervicio');
    Route::post('/guardar/tipo/servicio', [Tipos::class, 'store'])->name('tiposervicio.save');
    Route::post('/editar/tipo/servicio', [Tipos::class, 'update'])->name('tiposervicio.edit');
    //Servicios
    Route::get('servicios', [Servicios::class,'index'])->name('servicios.index');
    Route::get('servicio/create', [Servicios::class, 'create'])->name('servicio.create');
    Route::post('/servicio', [Servicios::class, 'store'])->name('servicio.store');
    Route::get('servicio/show/{id}', [Servicios::class, 'show'])->name('servicio.show');
    Route::get('/servicio/cancel/{id}', [Servicios::class, 'cancel'])->name('servicio.cancel');
    Route::delete('/servicio/{id}', [Servicios::class,'destroy']);

    //Publicaciones
    Route::get('/publicacion', [Publicacion::class, 'index'])->name('publicacion.index');
    Route::get('publicacion/create', [Publicacion::class, 'create'])->name('publicacion.create');
    Route::post('/publicacion', [Publicacion::class, 'store'])->name('publicacion.store');
    Route::get('publicacion/edit/{id}', [Publicacion::class, 'edit'])->name('publicacion.edit');
    Route::put('/publicacion/{id}', [Publicacion::class, 'update'])->name('publicacion.update');
    Route::get('/publicacion/disable/{id}', [Publicacion::class, 'disable'])->name('publicacion.disable');
    Route::get('/publicacion/enable/{id}', [Publicacion::class, 'enable'])->name('publicacion.enable');
});
