<?php
require_once "../poo/clases.php";

function exception_error_handler($errno, $errstr, $errfile, $errline)
{
    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
}

set_error_handler("exception_error_handler");

?>

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
<body style="background: #A8BFEA">

<!--This is code to nav-->
<nav style="padding: 10px">
<ul class="nav justify-content-end">
  <li class="nav-item">
    <a href="./showAdministrators.php">
<button type="button" class="btn btn-outline-dark" >Regresar</button>
</a>
  </li>
  
</ul>
</nav>
<?php



            $id = $_GET['id'];
   // echo $id;
    echo ("<br>");
            try{
                $datos = json_decode(file_get_contents("https://REST-API.joseramonhernan.repl.co/collaboratorFind/$id"), true);
               //$numero_empleado = $datos['numero_emplado'];
               echo('
               
<!--This is code to Form-->
<div class="container" style="padding:3%; background: #FBFAFA">
<form method="GET" action="./updateAdministratorRegister.php" >
    <h3>Formulario para la actualización de Administradores:</h3>
    <br>
  <div class="row">
    <div class="col">
        <a>Nombre:</a>
      <input type="text" name="nombre" class="form-control" value='.$datos['name'].' required>
    </div>
    <div class="col">
    <a>Apellido:</a>
      <input type="text" name="apellido" class="form-control"value='.$datos['lastname'].' required>
    </div>
</div>
<br>

<div class="row">
    <div class="col">
    <a>Numero de empleado:</a>
      <input type="text" name="empleado" class="form-control" value='.$datos['numero_empleado'].' readonly>
    </div>
   
  </div>
<br>

  <div class="form-group">
    <label for="formGroupExampleInput">Correo Electrónico:</label>
    <input type="email" class="form-control" name="email" id="formGroupExampleInput" value='.$datos['email'].' required>
  </div>
 <br>

  <div class="row">
  <div class="form-group col-md-4">
      <label for="inputState">Área: '.$datos['area'].'</label>
      <select id="inputState" name="area" class="form-control" required>
        <option selected  required>Choose...</option>
        <option value="recursos_humanos">Recursos Humanos</option>
        <option value="sistemas">Sistemas</option>
      </select>
    </div>
  </div>
<br>

 


<button type="submit" name="guardar" class="btn btn-outline-success">Guardar</button>
</form>
</div>

               ');
            }catch(Exception $e){
                ?>
                <script>
                window.location="../err.html"
              </script>
              <?php
            }
            
           