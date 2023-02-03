<?php

function exception_error_handler($errno, $errstr, $errfile, $errline)
{
    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
}

set_error_handler("exception_error_handler");

//$id = $_GET['user'];
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
    <title>Show Administrators</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    
  </head>
  <body>


<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" >Administradores</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="./home.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./createAdmin.php">Registrar</a>
        </li>
      </ul>
      <form class="d-flex" role="search" method="GET" action="showAdministrators.php">
        <input class="form-control me-2" type="text" name="numberAdministrator"placeholder="Buscar por numero de empleado" aria-label="Search" required>
        <button class="btn btn-outline-success" name="buscar" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>

    <?php

    if(isset($_GET['buscar'])==1)
    {
        $numberAdministrator = $_GET['numberAdministrator'];
        try{
            $datos = json_decode(file_get_contents("https://REST-API.joseramonhernan.repl.co/collaborator/$numberAdministrator"), true);

            if(empty($datos))
            {
            echo("<h2>El usuario no se encuentra registrado</h2>");
            }else{
              ?>  
              <div class="container">
                <div class="row row-cols-1 row-cols-md-3 g-4">
            <div class="col">
              <div class="card h-100">
                <img src="<?php echo($datos['photo']);?>" class="card h-100" alt="...">
                <div class="card-body">
                  <h5 class="card-title"><?php echo($datos['name']);?> <?php echo($datos['lastname']);?></h5>
                  <h6 class="card-text"><?php echo($datos['numero_empleado']);?></h6>
                  <p class="card-text"><?php echo($datos['area']);?></p>
                    <p class="card-text"><?php echo($datos['email']);?></p>
                    <?php
                    $id = $datos['_id'];
                    ?>
                </div>
                <div class="card-footer"></div>
                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                <a href="./deleteAdministratorAnswer.php?id=<?php echo$id;?>" class="btn btn-danger">          
  <button type="sumbit" class="btn btn-danger">Eliminar</button>
            </a>
            <a href="./updateAdministrator.php?id=<?php echo$id;?>" class="btn btn-warning">
  <button type="button" class="btn btn-warning">Editar</button>
  </a>
</div>
<div class="card-footer"></div>
              </div>
            </div>
            </div>
            </div>
          <?php
            }
        }
        catch(Exception $e){
            echo("<h2>Sin Resultados</h2>");
           }
    } else{
        
         $datos = json_decode(file_get_contents("https://REST-API.joseramonhernan.repl.co/collaboratorType/administrator"), true);
        // echo ("acceso concedido");
      ?>
      <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php
         for($x=0; $x<count($datos); $x++)
         {  
            
            ?>
            <div class="col">
              <div class="card h-100">
                <img src="<?php echo($datos[$x]['photo']);?>" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title"><?php echo($datos[$x]['name']);?> <?php echo($datos[$x]['lastname']);?></h5>
                  <h6 class="card-text"><?php echo($datos[$x]['numero_empleado']);?></h6>
                  <p class="card-text"><?php echo($datos[$x]['area']);?></p>
                    <p class="card-text"><?php echo($datos[$x]['email']);?></p>
                 <?php
                  $id = $datos[$x]['_id'];
                 ?>
                </div>
                <div class="card-footer"></div>
                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                  <a href="./deleteAdministratorAnswer.php?id=<?php echo$id;?>" class="btn btn-danger">
  <button type="button" class="btn btn-danger">Eliminar</button>
  </a>
  <a href="./updateAdministrator.php?id=<?php echo$id;?>" class="btn btn-warning">
  <button type="button" class="btn btn-warning">Editar</button>
  </a>
</div>
<div class="card-footer"></div>
              </div>
            </div>
            
          <?php
        
         }
        
    
      echo ("</div>");
    }
    ?>
  </body>
</html>