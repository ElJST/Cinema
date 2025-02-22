<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\AdminMovieController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SeatController;

Route::get('/cartelera', [MovieController::class, 'index'])->name('movies.index');

Route::get('movies/location', [MovieController::class, 'showLocation'])->name('movies.location');

Route::get('movies/login', [MovieController::class, 'showLogin'])->name('movies.login');
Route::get('movies/register', [MovieController::class, 'showRegister'])->name('movies.register');

// Ruta para mostrar el formulario de contraseña
Route::get('admin/password', [AdminMovieController::class, 'showPasswordForm'])->name('admin.password');

// Ruta para verificar la contraseña y permitir el acceso al panel de administración
Route::post('admin/verify-password', [AdminMovieController::class, 'verifyPassword'])->name('admin.verify-password');

// Ruta para crear la película (protegida por la sesión de contraseña)
Route::get('admin/movies/create', [AdminMovieController::class, 'create'])->name('movies.create');

// Ruta para almacenar la película (protegida por la sesión de contraseña)
Route::post('admin/movies', [AdminMovieController::class, 'store'])->name('movies.store');

// Cierra la sesión
Route::post('logout', function () {
    auth()->logout(); 
    return redirect('/cartelera'); 
})->name('logout');

// Mostrar formularios
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

// Procesar registro e inicio de sesión
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Ruta para mostrar la página de compra de entradas
Route::get('comprar/{movie}', [MovieController::class, 'showComprar'])->name('movies.comprar');

Route::post('movies/reserve-seat', [SeatController::class, 'reserveSeat'])->name('seats.reserve');

Route::get('admin/movies/create/{movieId}', [MovieController::class, 'exportarReservas']);
Route::get('admin/movies/export', [MovieController::class, 'exportarPeliculas'])->name('movies.export');







