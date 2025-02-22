<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller {
    public function showRegister() {
        return view('movies.register');
    }
    
    public function showLogin() {
        return view('movies.login');
    }
    
    // Registro de usuario
    public function register(Request $request) {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'credit_card' => 'required|string|min:16|max:16|unique:users',
        ]);
    
        // Crear usuario
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'credit_card' => $request->credit_card,
        ]);
    
        // Iniciar sesión automáticamente
        Auth::login($user);
    
        // Redirigir a /cartelera con un mensaje de éxito
        return redirect('movies/cartelera')->with('welcome', 'Hola, ' . ucfirst($user->first_name) . ' el registro se completo perfectamente');
    }

    // Inicio de sesión
    public function login(Request $request) {
        // Validación de las credenciales
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        // Intentamos autenticar al usuario con las credenciales proporcionadas
        if (Auth::attempt($credentials)) {
            // Si la autenticación es exitosa, regeneramos la sesión para mayor seguridad
            $request->session()->regenerate();
            
            // Redirigimos a la cartelera y mostramos un mensaje de éxito
            return redirect('movies/cartelera')->with('success', 'Inicio de sesión exitoso, hola de nuevo ' . ucfirst(auth()->user()->first_name));
        }
    
        // Si las credenciales no coinciden, regresamos con un mensaje de error
        return back()->withErrors(['email' => 'Las credenciales no coinciden']);
    }
    

    // Cierre de sesión
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        return redirect()->route('login');
    }
}

