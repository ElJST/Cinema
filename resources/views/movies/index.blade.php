<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cartelera</title>
    <link rel="stylesheet" href="{{ asset('css/cartelera.css') }}">
    <script src="{{ asset('js/search.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark " id="home">
        <div class="container-fluid">
          <a class="navbar-brand" href="#home" title="arriba"><h2>Cinema</h2></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#cartelera">Cartelera</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('movies.location') }}">Cine</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Registro
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="{{ route('movies.login')}}">Iniciar Sesion</a></li>
                  <li><a class="dropdown-item" href="{{ route('movies.register') }}">Registrarse</a></li>
                </ul>
              </li>
            </ul>
            <form class="d-flex">
              <input class="form-control me-2" type="search" placeholder="¿Que deseas?" aria-label="Search" id="searchInput">
              <button class="btn btn-outline-primary" type="submit" onclick="searchText()">Buscar</button>
            </form>
          </div>
        </div>
    </nav>
    <section class="section-slider">
        <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach ($movies as $index => $movie)
                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                        <img src="{{ asset('storage/slider/'.$movie->slider_image) }}" class="d-block w-100" alt="{{ $movie->title }}">
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
    </section>
    <!-- Si hay un mensaje de bienvenida, lo mostramos -->
    @if(session('welcome'))
      <div class="container-fluid f-flex align-items-center justify-content-center bg-dark text-white register">
          {{ session('welcome') }}
      </div>
    @endif
    @if(session('success'))
        <div class="container-fluid f-flex align-items-center justify-content-center bg-dark text-white register">
            {{ session('success') }}
        </div>
    @endif

    <main class="container-fluid row" id="cartelera">
          @foreach ($movies as $movie)
              <div class="movie col-sm-12 col-md-6 col-lg-4 ">
                  <h2 class="d-flex justify-content-center mt-4">{{ ucfirst($movie->title) }}</h2>
                  <div class="movie-image-container">
                      <img src="{{ asset('storage/posters/' . $movie->poster_image) }}" alt="{{ $movie->title }}" class="shadow-lg">
                      <div class="overlay">
                          <div class="text">
                              <p><strong>Duración:</strong> {{ $movie->duration }} minutos</p>
                              <p><strong>Descripción:</strong> {{ $movie->description }}</p>
                              <p><strong>Horarios:</strong> {{ implode(', ', $movie->showtimes ?? ['no hay horarios']) }}</p>
                              <!-- Botón para comprar entradas, redirige a la página de compra de la película -->
                              @if (session('success') || session('welcome'))
                                <a href="{{ route('movies.comprar', $movie->id) }}" class="btn btn-primary mt-2 size-btn">Comprar Entradas</a>
                              @else
                                <a href="{{ route('movies.login') }}" class="btn btn-primary mt-2 size-btn">Iniciar Sesion</a>
                              @endif
                          </div>
                      </div>
                  </div>
              </div>
          @endforeach
  </main>

  <footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <h5>Sobre Nosotros</h5>
                <p>Cartelera de Películas es la plataforma ideal para ver los últimos estrenos de cine, consultar horarios, y comprar tus boletos desde la comodidad de tu hogar.</p>
            </div>
            <div class="col-sm-12 col-md-6">
                <h5>Enlaces</h5>
                <ul>
                    <li><a href="#">Inicio</a></li>
                    <li><a href="#">Películas</a></li>
                    <li><a href="#">Cartelera</a></li>
                    <li><a href="#">Contacto</a></li>
                </ul>
            </div>
        </div>
        <div class="social-icons text-center">
            <a href="#home" class="social-icon"><i class="fab fa-facebook"></i></a>
            <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
            <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
        </div>
    </div>
    <div class="text-center mt-3">
        <p>&copy; 2025 Cartelera de Películas. Todos los derechos reservados.</p>
    </div>
</footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
