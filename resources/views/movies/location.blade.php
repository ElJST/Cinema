<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Donde estamos</title>
    
    <link rel="stylesheet" href="{{ asset('css/location.css') }}">
    <head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="{{ asset('js/search.js') }}"></script>
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
                <a class="nav-link" href="#cine">Cine</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Registro
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="{{ route('movies.login')}}">Iniciar Sesion</a></li>
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

    <div class="container-fluid d-flex flex-column align-items-center mt-4 justify-content-center ">
      <h2>Ubicación del Cine 'Cinema'</h2>
      <div class="img-location mt-2 mb-5" >
        <a href="https://www.google.es/maps/place/IES+Augusto+González+de+Linares/@43.447681,-3.8536691,1313m/data=!3m2!1e3!4b1!4m6!3m5!1s0xd4949bb2a323c29:0xcbc1863c74913b6d!8m2!3d43.447681!4d-3.8510942!16s%2Fg%2F11b6dfrvxp?entry=ttu&g_ep=EgoyMDI1MDIxOC4wIKXMDSoASAFQAw%3D%3D" target="_blank"><img src="{{ asset('maps.png') }}" alt="img de peñacastillo" class="rounded shadow" id="cine">
        </a>
      </div>
      <div class="container mb-4 p-5">
        <p>
          Bienvenidos a <strong>Cinema</strong> <br>
  
         Ubicado en el corazón de la ciudad, nuestro cine ofrece la mejor experiencia cinematográfica con tecnología de última generación. Contamos con salas equipadas con pantallas de alta definición, sonido envolvente y asientos reclinables para tu máxima comodidad.
  
         En nuestra cartelera encontrarás los últimos estrenos de Hollywood, cine independiente y proyecciones especiales para toda la familia. Además, disponemos de una zona de snacks con palomitas recién hechas, bebidas refrescantes y una variedad de dulces para disfrutar durante la función.
  
         Ven y vive la magia del cine con nosotros. ¡Te esperamos!
       </p>
      </div>
  </div>

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