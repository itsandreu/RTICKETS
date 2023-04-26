<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\TicketsController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


//AUTH
Route::prefix('auth')->group(function(){
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('login', [AuthController::class, 'loginVerify'])->name('login.verify');
    Route::get('signout',[AuthController::class,'signout'])->name('signout');
    
});

//PROTEGIDOS

Route::middleware('auth')->group(function(){
    //dashboard
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    //usuarios
    
    //Route::get('register',[AuthController::class,'register'])->name('register');
    //Route::post('register',[AuthController::class,'registerverify'])->name('register.verify');

    Route::get('users', [UsersController::class, 'verusers'])->name('users');
    Route::get('editarusers/{id}', [UsersController::class, 'editarusers'])->name('editarusers');
    Route::post('guardarcambiosuser', [UsersController::class, 'guardarcambiosuser'])->name('guardarcambiosuser');
    Route::get('deshabilitarusers/{id}', [UsersController::class, 'deshabilitarusers'])->name('deshabilitarusers');
    Route::get('disabledusers', [UsersController::class, 'disabledusers'])->name('disabledusers');
    Route::get('activarusers/{id}', [UsersController::class, 'activarusers'])->name('activarusers');
    route::get('eliminarusers/{id}',[UsersController::class, 'eliminarusers'])->name('eliminarusers');

    //tickets 

    Route::get('tickets', [TicketsController::class, 'vertickets'])->name('tickets');
    Route::get('crearticket', [TicketsController::class, 'crearticket'])->name('crearticket');
    Route::post('guardarticket', [TicketsController::class, 'guardarticket'])->name('guardarticket');
    Route::get('eliminarticket/{id}', [TicketsController::class, 'eliminarticket'])->name('eliminarticket');
    Route::get('editarticket/{id}', [TicketsController::class, 'editarticket'])->name('editarticket');
    Route::get('eliminararchivo/{id}', [TicketsController::class, 'eliminararchivo'])->name('eliminararchivo');
    Route::post('guardarcambiosticket', [TicketsController::class, 'guardarcambiosticket'])->name('guardarcambiosticket');
    
});

Route::middleware(['auth', 'can:admin-only'])->group(function () {
    // rutas protegidas para el usuario Administrador con el id 1
    Route::get('register', [AuthController::class, 'register'])->name('register');
    Route::post('register', [AuthController::class, 'registerverify'])->name('register.verify');
});