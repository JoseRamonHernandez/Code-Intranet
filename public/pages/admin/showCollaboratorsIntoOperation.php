<?php
function exception_error_handler($errno, $errstr, $errfile, $errline)
{
    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
}

set_error_handler("exception_error_handler");

?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    <title>Operaciones - Registro Colaboradores</title>
</head>
<body >

<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" ></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="position-sticky" id="navbarSupportedContent">
      <form class="d-flex" role="search" method="GET" action="./operations.php">
        <button class="btn btn-outline-secondary" type="submit">Regresar</button>
      </form>
    </div>
  </div>
</nav>

<?php

if(empty(isset($_GET['idOperation'])))
{
    echo ("No se reciben parametros");
}
else
{
    $idOperation = $_GET['idOperation'];

    $datosOperation = json_decode(file_get_contents("http://localhost:3000/findOperation/$idOperation"), true);

   $datos = json_decode(file_get_contents("http://localhost:3000/getCollaborators/operation/$idOperation"), true);
if(!$datos)
{
    echo ("<h2>Sin Resultados</h2>");
}
else
{
    ?>

    <div class="container">
        <h3 class="text-center">Listado de Personas registradas en la operación <?php echo $datosOperation['name_of_operation']; ?></h3>
        <h4 class="text-center">Del proyecto <?php echo $datosOperation['project']; ?></h4>
    </div>

<br>

<img src="" alt="">
<div class="container card border-info mb-3" style="padding: 5%;">

<table class="table">
  <thead>
    <tr class="table-dark">
      <th scope="col">#</th>
      <th scope="col"></th>
      <th scope="col">Nombre</th>
      <th scope="col">Apellido</th>
      <th scope="col">Área</th>
      <th scope="col">Porcentaje</th>
    </tr>
  </thead>
  <tbody>

</div>

    <?php
    for($x=0; $x<count($datos); $x++)
    {
     $numeroCollaborator = $datos[$x]['no_collaborator'];
     $collaboratorsInfo = json_decode(file_get_contents("http://localhost:3000/collaborator/$numeroCollaborator"), true);
        ?>
      <tr>
      <th class="table-success" scope="row"><?php echo $collaboratorsInfo['numero_empleado']; ?></th>
      <td class="text-center table-success"><img src="../../subidas/<?php echo $collaboratorsInfo['photo']; ?>" alt="" style="width: 25%; height: auto; aspect-ratio: 1/1;"></td>
      <td class="table-success"><?php echo $collaboratorsInfo['name']; ?></td>
      <td class="table-success"><?php echo $collaboratorsInfo['lastname']; ?></td>
      <td class="table-success"><?php echo $collaboratorsInfo['area']; ?></td>
      <td class="table-success"><?php echo $datos[$x]['porcent']; ?></td>
    </tr>
         
     <?php
    }
 
}
}

?>