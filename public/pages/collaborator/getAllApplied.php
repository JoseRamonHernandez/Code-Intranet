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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    
     <!-- Link hacia el archivo de estilos css 
     <link rel="stylesheet" href="../collaborator/style/nav.css"> -->

     <script src="sweetalert2.min.js"></script>
<link rel="stylesheet" href="sweetalert2.min.css">
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>Vacantes</title>
</head>
<body>

<?php

if(empty($_GET['id']))
{
    echo "No se reciben parametros";
}else{
    $id = $_GET['id'];
?>

<!--This is code to nav-->
<nav style="padding: 10px">
<div class="container-fluid">
<div class="position-sticky"><h4>Vacantes Disponibles</h4></div>
<ul class="nav justify-content-end">
  <li class="nav-item">
    <a href="./showVacancies.php?id=<?php echo$id;?>">
<button type="button" class="btn btn-outline-dark" >Regresar</button>
</a>
  </li>
  
</ul>
</div>
</nav>

<div class="container" style="padding-top:15px;">


<table class="table">
  <thead class="table-info">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nombre de la Vacante</th>
      <th scope="col">Fecha de Aplicación</th>
    </tr>
  </thead>
  <tbody>

<?php



try{

    $vacancies = json_decode(file_get_contents("https://REST-API.joseramonhernan.repl.co/showApplied/$id"), true);
    for($x=0; $x<count($vacancies); $x++)
    {
        
        ?>
        
    <tr>
      <th scope="row"><?php echo$x+1;?></th>
      <td><?php echo$vacancies[$x]['name_vacancie'];?></td>
      <td><?php echo$vacancies[$x]['application_date'];?></td>
    </tr>
    
<?php
    }

}catch(Exception $e)
{
    ?>
    <script>
         window.location="../err.html"
    </script>
    <?php
}

?>
  </tbody>
</table>
</div>


<?php
}
?>
</body>
</html>