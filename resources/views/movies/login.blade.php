<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <script src="{{ asset('js/search.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Login</title>
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
                <a class="nav-link active" aria-current="page" href="{{ route('movies.index')}}">Cartelera</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('movies.location')}}">Cine</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Registro
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="#login">Iniciar Sesion</a></li>
                  <li><a class="dropdown-item" href="{{ route('movies.register')}}">Registrarse</a></li>
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

    <main class="container mt-5">
        <h2>Iniciar Sesión</h2>
        <form method="POST" action="{{ route('login') }}">
            @csrf
        
            <div class="form-group">
                <label for="email">Correo electrónico</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required class="form-control">
                
            </div>
        
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" required class="form-control">
                
            </div>
            @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        
            <button type="submit" class="btn btn-primary mt-2">Iniciar sesión</button>
        </form>
        
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