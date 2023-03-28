
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
    <title>Hábilidades</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    
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

$datosUSerOperations = json_decode(file_get_contents("https://REST-API.joseramonhernan.repl.co/showAllOperationRegisterINTOCollaborator/$idCollaborator"), true);



?>


<div class="container" style="padding-top: 5%;">
<h3>Listado de todas las hábilidades registradas en tu perfil</h3>

<div class="container" style="padding: 5%">


<table class="table">
  <thead>
    <tr class="table-primary">
      <th scope="col">#</th>
      <th class="text-center" scope="col">Nombre</th>
      <th class="text-center" scope="col">Proyecto</th>
      <th class="text-center">Porcentaje de progreso</th>
    
    </tr>
  </thead>
  <tbody>

<?php
for($a=0; $a<count($datosUSerOperations); $a++)
{

  $idOperation = $datosUSerOperations[$a]['id_operation'];

  $datosOperation = json_decode(file_get_contents("https://REST-API.joseramonhernan.repl.co/findOperation/$idOperation"), true);
  ?>

  <tr class="table-warning">
      <th scope="row"><?php echo $a+1; ?></th>
      <td class="text-center"><?php echo $datosOperation['name_of_operation']; ?></td>
      <td class="text-center"><?php echo $datosOperation['project']; ?></td>
      <td class="text-center"><?php echo $datosUSerOperations[$a]['porcent']; ?></td>
     
    </tr>

<?php
}
?>

    </tbody>
</table>

</div>
</div>

<div class="container" style="padding-top: 5%;">
<p style="color:blue;">Pasar con Recursos Humanos para DUDAS y/o ACLARACIONES.</p>
</div>
    
</body>
</html>

<?php
}
?>