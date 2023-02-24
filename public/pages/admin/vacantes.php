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


    <title>Vacantes</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    
  </head>
  <body>


<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" >Vacantes</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="./home.php">Registrar nueva Vacante</a>
        </li>
       
      </ul>
      <form class="d-flex" role="search" method="GET" action="home.php">
        <button class="btn btn-outline-primary" name="buscar" type="submit">Regresar</button>
      </form>
    </div>
  </div>
</nav>

<?php

try{
    $datos = json_decode(file_get_contents("https://REST-API.joseramonhernan.repl.co/Vacancies"), true);

    if($datos)
    {

        ?>

            <div class="contianer" style=" padding:6%; style-content:center;">
            <div class="">
            <div class="row">

        <?php

        for($x=0; $x<count($datos); $x++)
          {   
            ?>

<div class="col-sm-4" style="padding-top:3%;">
    <div class="card">
        <a href="./applicators.php?idVacancie=<?php echo$datos[$x]['_id'];?>">
    <img class="card-img-top" src="./subidasVacancies/logo_clerprem.png" alt="Card image cap">
    </a>
      <div class="card-body">
        <h5 class="card-title"><?php echo $datos[$x]['title'];?></h5>
        <p class="card-text"><?php echo $datos[$x]['description'];?></p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
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

?>

</body>
</html>