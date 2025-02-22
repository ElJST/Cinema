<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Seat;
use Illuminate\Support\Facades\Storage;


class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::all();
        return view('movies.index', compact('movies'));
    }

    public function showLocation()
    {
        return view('movies.location');
    }

    public function showLogin()
    {
        return view('movies.login');
    }

    public function showRegister()
    {
        return view('movies.register');
    }

    public function showComprar($movieId) {
        if (!Auth::check()) {
            return redirect()->route('register')->with('error', 'Necesitas iniciar sesión para comprar entradas.');
        }

        $movie = Movie::findOrFail($movieId);
        $seats = Seat::where('movie_id', $movieId)->get(); // Obtener las butacas reservadas

        return view('movies.comprar', compact('movie', 'seats'));
    }

    public function exportarReservas($movieId) {
        $movie = Movie::with('seats.user')->findOrFail($movieId);

        $contenido = "Película: " . $movie->title . "\n\n";
        $contenido .= "Reservas:\n";

        foreach ($movie->seats as $seat) {
            $contenido .= "Usuario: " . $seat->user->first_name . " " . $seat->user->last_name;
            $contenido .= " - Butaca: " . $seat->seat_number . "\n";
        }

        // Guardar el archivo en storage/app/public/
        $filePath = 'reservas_peliculas_' . now()->format('Ymd_His') . '.txt';
        Storage::put($filePath, $contenido);

        // Verificar si el archivo se creó
        if (!Storage::exists($filePath)) {
            return "Error: El archivo no se creó correctamente.";
        }

        // Descargar el archivo
        return response()->download(storage_path("app/public/" . basename($filePath)));
    }

    public function exportarPeliculas() {
        // Obtener todas las películas con sus asientos y usuarios asociados
        $movies = Movie::with('seats.user')->get();

        // Crear el contenido del archivo de texto
        $contenido = "";

        // Recorrer todas las películas
        foreach ($movies as $movie) {
            $contenido .= "Película: " . $movie->title . "\n";
            $contenido .= "-----------------------------\n";

            // Verificar si la película tiene asientos reservados
            if ($movie->seats->isEmpty()) {
                $contenido .= "No hay reservas para esta película.\n\n";
                continue;
            }

            // Recorrer los asientos reservados
            foreach ($movie->seats as $seat) {
                // Verificar si el asiento tiene un usuario asociado
                if ($seat->user) {
                    $contenido .= "Usuario: " . $seat->user->first_name . " " . $seat->user->last_name . "\n";
                    $contenido .= "Butaca reservada: " . $seat->seat_number . "\n"; // Aquí asumimos que `seat_number` es el número del asiento
                    $contenido .= "Estado de reserva: " . ($seat->is_reserved ? "Reservado" : "Disponible") . "\n\n";
                }
            }

            $contenido .= "=============================\n\n";
        }

        // Generar el archivo .txt con el contenido
        $filename = 'reservas_peliculas_' . now()->format('Ymd_His') . '.txt';
        Storage::put("$filename", $contenido); // Guardar el archivo en la carpeta public

        // Descargar el archivo generado
        return response()->download(storage_path("app/public/$filename"));
    }
    
    
}

