<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Película - Admin</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <h1>Agregar Película</h1>

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <section class="shadow">
        <form action="{{ route('movies.store') }}" method="POST" enctype="multipart/form-data" id="form">
            @csrf
            <label for="title">Título:</label>
            <input type="text" name="title" required><br>
        
            <label for="description">Descripción:</label>
            <textarea name="description" required></textarea><br>
        
            <label for="duration">Duración:</label>
            <input type="number" name="duration" required><br>
    
            <label for="showtimes">Horarios (separados por comas):</label>
            <input type="text" name="showtimes" placeholder="Ejemplo: 14:00, 16:30, 19:00"><br>
        
            <label for="slider_image">Imagen del Slider:</label>
            <input type="file" name="slider_image" accept="image/*" required><br>
        
            <label for="poster_image">Imagen de la Portada:</label>
            <input type="file" name="poster_image" accept="image/*" required><br>
        
            <button type="submit" class="btn btn-primary">Guardar Película</button>
        </form>
        <!-- Formulario de Cerrar Sesión -->
        <form action="{{ route('logout') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-danger mt-2">Cerrar Sesión</button>
        </form><br>
        <!-- Vista create.blade.php -->
        <a href="{{ route('movies.export') }}" class="btn btn-success mt-2" >
            Descargar lista de todas las películas (TXT)
        </a>
    </section>
    


</body>
</html>
