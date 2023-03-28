
<?php

function exception_error_handler($errno, $errstr, $errfile, $errline)
{
    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
}

set_error_handler("exception_error_handler");




?>


<?php

if(empty($_GET['idCollaborator']))
{
    echo("No se reciben parametros");
}else{

    $idCollaborator = $_GET['idCollaborator'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PROFILE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    
</head>
<body>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" >Datos personales</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item dropdown">
        <p></p>
        </li>
        
      </ul>
      <form class="d-flex" role="search" method="GET" action="home.php">
        <input type="hidden" name="_id" value="<?php echo $idCollaborator; ?>">
        <button class="btn btn-outline-primary" name="close" type="submit">Regresar</button>
      </form>
    </div>
  </div>
</nav>

<?php

$datosUSer = json_decode(file_get_contents("https://REST-API.joseramonhernan.repl.co/collaboratorFind/$idCollaborator"), true);

?>


<div class="container" style="padding-top: 5%;">

<img src="../../subidas/<?php echo $datosUSer['photo'];?>" alt="" height="15%" width="15%">
<hr>

<div class="container text-bg-dark" style="padding:5% ">

<form action="" class="row g-3 needs-validation ">
<div class="col-md-4">
    <label for="validationCustom01" class="form-label">Nombre(s)</label>
    <input type="text" readonly class="form-control-plaintext" id="validationCustom01" value="<?php echo $datosUSer['name'];?>" style="color:white;">
  </div>
  <div class="col-md-4">
    <label for="validationCustom02" class="form-label">Appelido(s)</label>
    <input type="text" readonly class="form-control-plaintext" id="validationCustom02" value="<?php echo $datosUSer['lastname'];?>" style="color:white;">
  </div>
  <div class="col-md-4">
    <label for="validationCustomUsername" class="form-label">Numero de empleado</label>
    <div class="input-group has-validation">
      <input type="text" readonly class="form-control-plaintext" id="validationCustomUsername" aria-describedby="inputGroupPrepend" value="<?php echo $datosUSer['numero_empleado'];?>" style="color:white;">
    </div>
  </div>
  
  <hr>

  <div class="col-md-6">
    <label for="validationCustom03" class="form-label">Correo electronico</label>
    <input type="text" readonly class="form-control-plaintext" id="validationCustom03" value="<?php echo $datosUSer['email'];?>" style="color:white;">
  </div>

  <hr>

  <div class="col-md-3">
    <label for="validationCustom01" class="form-label">Fecha de nacimiento</label>
    <input type="text" readonly class="form-control-plaintext" id="validationCustom01" value="<?php echo $datosUSer['dateofbirthday'];?>" style="color:white;">
  </div>
  <div class="col-md-3">
    <label for="validationCustom02" class="form-label">Fecha de registro</label>
    <input type="text" readonly class="form-control-plaintext" id="validationCustom02" value="<?php echo $datosUSer['date_of_register'];?>" style="color:white;">
  </div>
  <div class="col-md-3">
    <label for="validationCustomUsername" class="form-label">Área</label>
    <div class="input-group has-validation">
      <input type="text" readonly class="form-control-plaintext" id="validationCustomUsername" aria-describedby="inputGroupPrepend" value="<?php echo $datosUSer['area'];?>" style="color:white;">
    </div>
  </div>
  <div class="col-md-3">
    <label for="validationCustomUsername" class="form-label">Proyecto</label>
    <div class="input-group has-validation">
      <input type="text" readonly class="form-control-plaintext" id="validationCustomUsername" aria-describedby="inputGroupPrepend" value="<?php echo $datosUSer['project'];?>" style="color:white;">
    </div>
  </div>

  <hr>

  <div class="col-md-4">
    <label for="validationCustom01" class="form-label">Número de telefono</label>
    <input type="text" readonly class="form-control-plaintext" id="validationCustom01" value="<?php echo $datosUSer['phone_number'];?>" style="color:white;">
  </div>
  <div class="col-md-4">
    <label for="validationCustom02" class="form-label">Número de telefono para emergencias</label>
    <input type="text" readonly class="form-control-plaintext" id="validationCustom02" value="<?php echo $datosUSer['emergency_phone_number'];?>" style="color:white;">
  </div>
  <div class="col-md-4">
    <label for="validationCustomUsername" class="form-label">Status</label>
    <div class="input-group has-validation">
      <input type="text" readonly class="form-control-plaintext" id="validationCustomUsername" aria-describedby="inputGroupPrepend" value="<?php echo $datosUSer['status'];?>" style="color:white;">
    </div>
  </div>
  
 
  
  </div>
</form>
<br>
</div>

</div>
  
    
</body>
</html>

<?php
}
?>