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


    <title>Aplicadores</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    
  </head>
  <body>


<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
      <form class="d-flex" role="search" method="GET" action="vacantes.php">
        <button class="btn btn-outline-primary" name="buscar" type="submit">Regresar</button>
      </form>
    </div>
  </div>
</nav>

<div class="container">
    <h3 class="text-center" style="color:blue;">Registro de Personas aplicadas a la vacante.</h3>
</div>
<?php

if(!empty($_GET['idVacancie']))
{
    $idVacancie = $_GET['idVacancie'];
    
try{
        $url = "http://localhost:3000/findVacancies/$idVacancie";
        if($url)
        {
$response = file_get_contents($url);
$data = json_decode($response, true);


// Recorrer el array de datos y mostrarlos en una tabla
?>
<div class="container" style="padding-top:5%;">
<table class="table table-striped table-dark">
  <thead class="">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Numero de Colaborador</th>
      <th scope="col">Nombre del Colaborador</th>
      <th scope="col">Área actual</th>
      <th scope="col">Fecha de Aplicación</th>
    </tr>
  </thead>
  <tbody>
<?php
$a=1;
foreach ($data as $row) {
    $numero_collaborator = $row['number_collaborator'];
    $name_collaborator = $row['name_collaborator'];
    $area_collaborator = $row['area_collaborator'];
    $date_applied = $row['date_applied'];
   // echo $numero_collaborator;
    ?>
<tr>
      <th scope="row"><?php echo $a;?></th>
      <td><?php echo $numero_collaborator;?></td>
      <td><?php echo $name_collaborator;?></td>
      <td><?php echo $area_collaborator;?></td>
      <td><?php echo $date_applied;?></td>
    </tr>

<?php
    /*
    echo "<tr>";
    echo "<td>".$row['number_collaborator']."</td>";
    echo "<td>".$row['name_collaborator']."</td>";
    echo "<td>".$row['area_collaborator']."</td>";
    echo "<td>".$row['date_applied']."</td>";
    echo "</tr>";
    */
    $a=$a+1;
}
?>

</tbody>
</table>
</div>
<?php
}else("No hay registros.");
}catch(Exception $e){
    ?>
    <script>
    window.location="../err.html"
  </script>
  <?php
  }
}else{
    echo("No se recive ningún parametro");
}
?>


</body>
</html>
