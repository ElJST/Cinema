<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class AdminMovieController extends Controller
{
    // Mostrar formulario para ingresar la contraseña
    public function showPasswordForm()
    {
        return view('admin.password');
    }

    // Verificar la contraseña y establecer la sesión
    public function verifyPassword(Request $request)
    {
        // Contraseña almacenada 
        $correctPassword = env('ADMIN_PASSWORD');

        // Verificar si la contraseña ingresada es correcta
        if ($request->password === $correctPassword) {
            // Establecer una variable de sesión para indicar que el admin está verificado
            session(['admin_verified' => true]);

            return redirect()->route('movies.create'); // Redirige a la vista para crear la película
        }

        // Si la contraseña es incorrecta, redirige con un mensaje de error
        return back()->with('error', 'Contraseña incorrecta.');
    }

    // Mostrar el listado de películas
    public function index()
    {
        $movies = Movie::all(); // Obtiene todas las películas
        return view('movies.index', compact('movies'));
    }

    // Mostrar formulario para agregar película
    public function create()
    {
        // Verificar si la sesión contiene la variable admin_verified
        if (!session()->has('admin_verified') || session()->get('admin_verified') !== true) {
            // Si no, redirigir a la página de contraseña
            return redirect()->route('admin.password');
        }

        // Obtener todas las películas
        $movies = Movie::all();

        // Pasar las películas a la vista
        return view('admin.movies.create', compact('movies'));
    }

    // Guardar la película en la base de datos
    public function store(Request $request)
    {
        // Verificar si la sesión contiene la variable admin_verified
        if (!session()->has('admin_verified') || session()->get('admin_verified') !== true) {
            // Si no, redirigir a la página de contraseña
            return redirect()->route('admin.password');
        }

        // Validación de los datos del formulario
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'duration' => 'required',
            'slider_image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'poster_image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'showtimes' => 'nullable|string', // Recibe los horarios como texto
        ]);

        // Guardar imágenes en storage
        $sliderPath = $request->file('slider_image')->store('slider');
        $posterPath = $request->file('poster_image')->store('posters');

        // Crear la película
        Movie::create([
            'title' => $request->title,
            'description' => $request->description,
            'duration' => $request->duration,
            'slider_image' => basename($sliderPath),
            'poster_image' => basename($posterPath),
            'showtimes' => $request->showtimes ? explode(',', $request->showtimes) : [],
        ]);

        // Redirigir a la página de creación con un mensaje de éxito
        return redirect()->route('movies.create')->with('success', 'Película añadida correctamente');
    }

    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);
        $movie->delete();

        return back()->with('success', 'Película eliminada correctamente.');
    }

}




