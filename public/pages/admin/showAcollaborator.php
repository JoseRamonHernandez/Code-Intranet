<?php

function exception_error_handler($errno, $errstr, $errfile, $errline)
{
    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
}

set_error_handler("exception_error_handler");

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link rel="icon" type="image/png" href="…">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css">
    <title>Show Collaborator</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    
  </head>
  <body>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" >Colaboradores</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="./home.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./createCollaborator.php">Registrar</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Área
          </a>
          <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="./showCollaborators.php?area=costuras">COSTURAS</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="./showCollaborators.php?area=ensamblado">ENSAMBLADO</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="./showCollaborators.php?area=espuma">ESPUMA</a></li>
              <li><hr class="dropdown-divider"></li>
          </ul>
        </li>
      </ul>
      <form class="d-flex" role="search" method="GET" action="showAcollaborator.php">
        <input class="form-control me-2" type="text" name="numberCollaborator"placeholder="Buscar por numero de empleado" aria-label="Search" required>
        <button class="btn btn-outline-success" name="buscar" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>


<?php


if(!empty($_GET['numberCollaborator']))
        {

          $numberCollaborator = $_GET['numberCollaborator'];
          try{
          $datos = json_decode(file_get_contents("https://REST-API.joseramonhernan.repl.co/collaborator/$numberCollaborator"), true);
          echo('
<center>
          <div class="card" style="width: 18rem;">
          <img src="'.$datos['photo'].'" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">'.$datos['name'].' '.$datos['lastname'].'</h5>
            <p class="card-text">Numero de teléfono: '.$datos['phone_number'].'</p>
            <p class="card-text">Numero de teléfono de Emergencias: '.$datos['emergency_phone_number'].'</p>
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">Área: '.$datos['area'].'</li>
            <li class="list-group-item">Proyecto: '.$datos['project'].'</li>
            <li class="list-group-item">Fecha de Ingreso: '.$datos['date_of_register'].'</li>
            <li class="list-group-item">Fecha de Cumpleaños: '.$datos['dateofbirthday'].'</li>
            <li class="list-group-item">Correo Electrónico: '.$datos['email'].'</li>
            <li class="list-group-item">Numero de Empleado: '.$datos['numero_empleado'].'</li>
          </ul>
          <div class="card-body">
            <a href="./editCollaborator.php?id='.$datos['_id'].'" class="card-link">EDITAR</a>
            <a href="./deleteCollaboratorAnswer.php?id='.$datos['_id'].'"class="card-link">ELIMINAR</a>
          </div>
        </div>
        </center>');
        } catch(Exception $e){
            echo("<h2>Sin Resultados</h2>");
    }
}else{
        ?>
<script>
  window.location="../err.html"
</script>
        <?php
    }


?>
<br>
</body>
</html>