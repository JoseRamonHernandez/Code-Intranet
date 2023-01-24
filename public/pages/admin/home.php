<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    <title>Intranet-Admin</title>
</head>
<body>
<div class="">
<nav class="navbar sticky-top navbar-light" style="background-color: #e3f2fd;">
<ul class="nav nav-pills" style="padding: 10px;">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Acciones</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="./createCollaborator.php">Registrar nuevo Colaborador</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="./createAdmin.php">Registrar nuevo Administrador</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Avisos</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Eventos </a></li>
          </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="">Cursos</a>
          </li>
        <li class="nav-item">
          <a class="nav-link" href="">Vacantes</a>
        </li></ul>
        <form class="form-inline" action="../../login.php">
          
          <button class="btn btn-outline-danger my-2 my-sm-0" type="submit">Cerrar sesión</button>
         
        </form>
        
      
</nav>
</div>

<?php
/*
$datos = json_decode(file_get_contents("https://REST-API.joseramonhernan.repl.co/collaborators"), true);
print_r ($datos);
*/
?>
</body>
</html>