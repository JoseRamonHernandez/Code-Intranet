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
  ?>
  <script> window.location="../err.html"; </script>
  <?php
}
else{
  $id = $_GET['id'];

?>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <div class="position-sticky"><h4>Vacantes Disponibles</h4></div>
            <form class="d-flex" role="search" method="GET" action="home.php">
                <input type="hidden" name="_id" value="<?php echo$id;?>">
              <button class="btn btn-outline-primary" name="buscar" type="submit">Regresar</button>
            </form>
          </div>
        </div>
      </nav>

<?php

  try{
    $datos = json_decode(file_get_contents("https://REST-API.joseramonhernan.repl.co/Vacancies"), true);
    $user = json_decode(file_get_contents("https://REST-API.joseramonhernan.repl.co/collaboratorFind/$id"), true);


    $area_user = $user['area'];
    $name_user = $user['name'];
    $id_user = $user['_id'];

    if($datos)
    {

        
        ?>

            <div class="contianer" style=" padding:6%; style-content:center;">
            <div class="">
            <div class="row">

        <?php

        for($x=0; $x<count($datos); $x++)
          {   
            $area_datos = $datos[$x]['area'];
            $id_datos = $datos[$x]['_id'];

            if($area_user != $area_datos)
        {
            ?>

<div class="col-sm-3" style="padding-top:1%;">
    <div class="card">
        
    <img class="card-img-top" src="../admin//subidasVacancies/<?php echo$datos[$x]['photo'];?>" alt="Card image cap">
    
      <div class="card-body">
        <h5 class="card-title"><?php echo $datos[$x]['title'];?></h5>
        <p class="card-text"><?php echo $datos[$x]['description'];?></p>
        <a href="applicators.php?id=<?php echo$id;?>&idCollaborator=<?php echo $id_user;?>&idVacancie=<?php echo$datos[$x]['_id'];?>&name_vacancie=<?php echo$datos[$x]['title'];?>" class="btn btn-primary">Aplicar</a>
      </div>
      <div class="card-footer">
      <small class="text-muted">Fecha de Publicación: <?php echo $datos[$x]['date_register'];?></small>
    </div>
    <div class="card-footer">
      <small class="text-muted">Fecha de Cierre: <?php echo $datos[$x]['deadline'];?></small>
    </div>
    </div>
  </div>
  

            <?php
             }
          }
?>
</div>
</div>
</div>
<?php
       
    }else{
        echo("Aún no hay registros de Vacantes");
    }
}catch(Exception $e){
    ?>
    <script>
    window.location="../err.html"
  </script>
  <?php
}

}