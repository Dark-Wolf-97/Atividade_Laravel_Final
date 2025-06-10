<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UrnaController;
use App\Http\Controllers\FinadoController;
use App\Http\Controllers\VelorioController;

Route::get('/', function () {
    return redirect('/login');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'mostraLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    Route::get('/home', function () {
        return view('home'); 
    })->name('home');
    
    Route::resource('urna', UrnaController::class);
    Route::resource('finado', FinadoController::class);
    Route::resource('velorio', VelorioController::class);
});