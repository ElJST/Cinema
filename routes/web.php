<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\AdminMovieController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SeatController;

// Rutas de Cartelera y Usuarios
Route::prefix('movies')->group(function () {
    Route::get('/cartelera', [MovieController::class, 'index'])->name('movies.index');
    Route::get('/location', [MovieController::class, 'showLocation'])->name('movies.location');
    Route::get('/login', [MovieController::class, 'showLogin'])->name('movies.login');
    Route::get('/register', [MovieController::class, 'showRegister'])->name('movies.register');
    Route::get('/comprar/{movie}', [MovieController::class, 'showComprar'])->name('movies.comprar');
    Route::post('/reserve-seat', [SeatController::class, 'reserveSeat'])->name('seats.reserve');
});

// Rutas de Autenticación
Route::prefix('auth')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', function () {
        auth()->logout();
        return redirect('/movies/cartelera');
    })->name('logout');
});

// Rutas de Administración 
Route::prefix('admin')->group(function () {
    Route::get('/password', [AdminMovieController::class, 'showPasswordForm'])->name('admin.password');
    Route::post('/verify-password', [AdminMovieController::class, 'verifyPassword'])->name('admin.verify-password');
    Route::delete('/movies/{id}', [AdminMovieController::class, 'destroy'])->name('movies.destroy');

    Route::get('/movies/create', function () {
        if (!session()->has('admin_verified') || session('admin_verified') !== true) {
            return redirect()->route('admin.password');
        }
        return app(AdminMovieController::class)->create();
    })->name('movies.create');

    Route::post('/movies', function () {
        if (!session()->has('admin_verified') || session('admin_verified') !== true) {
            return redirect()->route('admin.password');
        }
        return app(AdminMovieController::class)->store(request());
    })->name('movies.store');

    Route::get('/movies/create/{movieId}', [AdminMovieController::class, 'exportarReservas'])->name('movies.exportarReservas');
    Route::get('/movies/export', [MovieController::class, 'exportarPeliculas'])->name('movies.export');
});






