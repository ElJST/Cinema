<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Película - Admin</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body class="container">
    <h1 class="text-center my-4">Agregar Película</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <section class="shadow p-4 mb-4">
        <form action="{{ route('movies.store') }}" method="POST" enctype="multipart/form-data" id="form">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Título:</label>
                <input type="text" name="title" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Descripción:</label>
                <textarea name="description" class="form-control" required></textarea>
            </div>

            <div class="mb-3">
                <label for="duration" class="form-label">Duración (minutos):</label>
                <input type="number" name="duration" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="showtimes" class="form-label">Horarios (separados por comas):</label>
                <input type="text" name="showtimes" class="form-control" placeholder="Ejemplo: 14:00, 16:30, 19:00">
            </div>

            <div class="mb-3">
                <label for="slider_image" class="form-label">Imagen del Slider:</label>
                <input type="file" name="slider_image" class="form-control" accept="image/*" required>
            </div>

            <div class="mb-3">
                <label for="poster_image" class="form-label">Imagen de la Portada:</label>
                <input type="file" name="poster_image" class="form-control" accept="image/*" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Guardar Película</button>
        </form>

        <!-- Botón de Cerrar Sesión -->
        <form action="{{ route('logout') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-danger mt-3 w-100">Cerrar Sesión</button>
        </form>

        <!-- Botón de Exportar Películas -->
        <a href="{{ route('movies.export') }}" class="btn btn-success mt-3 w-100">Descargar lista de todas las películas (TXT)</a>
    </section>

    <!-- LISTA DE PELÍCULAS REGISTRADAS -->
    <section class="shadow p-4">
        <h2 class="text-center mb-3">Listado de Películas</h2>

        @if($movies->isEmpty())
            <p class="text-center">No hay películas registradas.</p>
        @else
            <ul class="list-group">
                @foreach ($movies as $movie)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span><strong>{{ ucfirst($movie->title) }}</strong> - {{ $movie->duration }} min</span>
                        <form action="{{ route('movies.destroy', $movie->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        @endif
    </section>
</body>
</html>
