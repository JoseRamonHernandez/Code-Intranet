

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    <title>Intranet-Admin</title>

    <link href="./style.css" rel="stylesheet" type="text/css" />

    <style>
      body {
        background-image: url('../../subidas/fondo1.png');
        background-repeat: no-repeat;
        background-size: cover;
        background-attachment: fixed;
      }
    </style>

</head>
<body>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" ></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Acciones
          </a>
          <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="./showCollaborators.php">Funciones para Colaborador</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="./showAdministrators.php">Funciones para Administrador</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="./alert.php">Avisos</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="./events.php">Eventos </a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="./vacantes.php">Vacantes </a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="./createProject.php">Proyectos </a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="./clersHome.php">Cler´s </a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="./courses.php">Cursos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-curret="page" href="./operations.php">Operaciones</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-curret="page" href="./aplicatorsPage.php">Solicitudes de ACCESO</a>
        </li>
        <!--
        <li class="nav-item">
          <a class="nav-link active" aria-curret="page" href="./downloadMatriz.php">Descargar matriz de hábilidades</a>
        </li>
    -->
       
      </ul>
      <form class="d-flex" role="search" method="GET" action="../../login.php">
        <button class="btn btn-outline-danger" type="submit">Cerrar Sesión</button>
      </form>
    </div>
  </div>
</nav>



<?php
/*
$datos = json_decode(file_get_contents("https://REST-API.joseramonhernan.repl.co/collaborators"), true);
print_r ($datos);
*/
?>
<br>
<div id="carrusel-contenido">
            <div id="carrusel-caja">
              <center>
                <div class="carrusel-elemento">
                    <img class="imagenes" src="../../img/logo_clerprem.png" >
                </div>
                <div class="carrusel-elemento">   
                    <img class="imagenes" src="../../img/clerprem_mexico.jpg" >
                </div>
                <div class="carrusel-elemento">   
                    <img class="imagenes" src="../../img/clerprem_mexico_2.jpg" >                        
                </div>
                <div class="carrusel-elemento">   
                    <img class="imagenes" src="../../img/clerprem_mexico_3.jpg" >                        
                </div>
</center>
            </div>
        </div>
        <h1> Clerprem México </h1>
</body>
</html>