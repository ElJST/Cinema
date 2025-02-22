<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso de Administrador</title>
    <link rel="stylesheet" href="{{ asset('css/password.css') }}"> 
</head>
<body>
    <div class="container">
        <h1>Ingreso de Contraseña</h1>

        @if(session('error'))
            <p class="error-message">{{ session('error') }}</p>
        @endif

        <form action="{{ route('admin.verify-password') }}" method="POST">
            @csrf
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Acceder</button>
        </form>
    </div>
</body>
</html>
