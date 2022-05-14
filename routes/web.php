<?php

use App\Http\Controllers\AppointmentController;
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
    return view('welcome');
});

Route::get('/statistics', [AppointmentController::class,'statistics']);

Route::middleware('auth:web')->group(function(){

    Route::get('/make-appointment/{doctor}', [AppointmentController::class, 'makeAppointment']);
    Route::get('/make-appointment/', [AppointmentController::class, 'doctorsList']);
    Route::post('/make-appointment/', [AppointmentController::class, 'createAppointment']);
    Route::get('/revoke-appointment/', [AppointmentController::class, 'revokeAppointment']);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
