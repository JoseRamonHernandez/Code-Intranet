<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link rel="icon" type="image/png" href="…">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css">
    <title>Show Collaborators</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    
  </head>
  <body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand">Colaboradores</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="./home.php">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./createCollaborator.php">Registrar</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Áreas</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="./showCollaborators.php?area=costuras">COSTURAS</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="./showCollaborators.php?area=ensamblado">ENSAMBLADO</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="./showCollaborators.php?area=espuma">ESPUMA</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="./showCollaborators.php?area=sistemas">SISTEMAS </a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="./showCollaborators.php?area=recursos_humanos">RECURSOS HUMANOS </a></li>
            </ul>
          </li>
          
        

        </ul>
        <form class="form-inline my-4 my-lg-2">
          <input class="form-control mr-sm-2" type="text" placeholder="Buscar por numero de empleado" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </nav>

    <?php
        if(empty($_GET['area']))

        {
          echo ('<ul style="padding: 10%;">
          <li>
            <h4>Aquí se mostrarán a todos los usuarios registrados por área o a través de la busqueda por numero de empleado.</h4>
          </li>
        </ul>');
        }
        else
        {
          $area = $_GET['area'];
          echo $area;
          $datos = json_decode(file_get_contents("https://REST-API.joseramonhernan.repl.co/collaboratorArea/$area"), true);
          /*print_r ($datos);*/
          for($x=0; $x<count($datos); $x++)
          {   
            echo ("<br>");
            echo ("Nombre: ".$datos[$x]['name']);
          }
          
        }
        ?>
    
      
      
  </body>
</html>