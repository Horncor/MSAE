<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
    return view('home');
})->name('home');


Route::get('/userInfo', function () {
    return view('userInfo');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('login.register');
});

Route::get('/bisection', function () {
    return view('methods.bisection');
});

Route::get('/fixed-point', function () {
    return view('methods.fixedPoint');
});

/// prueba de metodo de biseccion
Route::get('/bisection', 'App\Http\Controllers\BisectionController@index')->name('bisection.index');
Route::post('/bisection', 'App\Http\Controllers\BisectionController@calculate')->name('bisection.calculate');

// rutas para login , logout y post login
Route::post('user/register', [UserController::class, 'userStorage'])->name('user.register');

Route::post('/login/authenticate', [LoginController::class, 'authenticate']);

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/inicio', function () {
    // Solo los usuarios autenticados pueden acceder a esta ruta
    return view('home');
})->middleware('auth');
