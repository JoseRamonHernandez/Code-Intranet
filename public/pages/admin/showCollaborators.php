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


    <title>Show Collaborators</title>
    
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
              <li><a class="dropdown-item" href="./showCollaborators.php?area=almacen">ALMACEN</a></li>
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
        if(empty($_GET['area']))

        {
          ?>
          <br>
          <center>
          <div class="container">
          <ul style="">
          <li>
            <h4>Aquí se mostrarán a todos los usuarios registrados por área o a través de la busqueda por numero de empleado.</h4>
          </li>
        </ul>
        </div>
        </center>
        <br>
          <?php
        }
        elseif(!empty($_GET['area']))
        {
          $area = $_GET['area'];
        //  echo $area;
        try {
        $datos = json_decode(file_get_contents("https://REST-API.joseramonhernan.repl.co/collaboratorArea/$area"), true);
          /*print_r ($datos);*/
         echo ('<h2>Se muestran todos los Colaboradores del area '.$area.'</h2>'); 
         

         
         ?>
         <div class="table-responsive">
         <table class="table">
<thead>
  <tr>
    <th scope="col">Numero de Empleado</th>
    <th scope="col">Nombre</th>
    <th scope="col">Apellido</th>
    <th scope="col">Proyecto</th>
    <th scope="col">Correo</th>
    <th scope="col">Numero de teléfono</th>
    <th scope="col">Numero de teléfono para Emeregencias</th>
  </tr>
</thead>
<tbody>
<?php
          for($x=0; $x<count($datos); $x++)
          {   
            $status = $datos[$x]['status'];
            if($status == 'activo'){
echo('

  <tr>
    <th scope="row">'.$datos[$x]['numero_empleado'].'</th>
    <td>'.$datos[$x]['name'].'</td>
    <td>'.$datos[$x]['lastname'].'</td>
    <td>'.$datos[$x]['project'].'</td>
    <td>'.$datos[$x]['email'].'</td>
    <td>'.$datos[$x]['phone_number'].'</td>
    <td>'.$datos[$x]['emergency_phone_number'].'</td>
    <td><a href="showAcollaborator.php?numberCollaborator='.$datos[$x]['numero_empleado'].'"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
    <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
  </svg></a></td>
  </tr>');
          }}

        }catch(Exception $e){
          ?>
          <script>
          window.location="../err.html"
        </script>
        <?php
      }
          
        }
        ?>
    

</tbody>
</table>
      </div>
      
      
  </body>
</html>