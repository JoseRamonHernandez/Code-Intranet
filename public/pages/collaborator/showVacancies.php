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
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
        <h1></h1>
</li>
            <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="./getAllApplied.php?id=<?php echo$id;?>">Visualizar todas la vacantes aplicadas.</a>
        </li>
        </ul>
</div>
            <form class="d-flex" role="search" method="GET" action="home.php">
                <input type="hidden" name="_id" value="<?php echo$id;?>">
              <button class="btn btn-outline-primary" name="buscar" type="submit">Regresar</button>
            </form>
          </div>
        </div>
      </nav>

<?php
try{
  
    $vacancies = json_decode(file_get_contents("https://REST-API.joseramonhernan.repl.co/Vacancies"), true);
    $user = json_decode(file_get_contents("https://REST-API.joseramonhernan.repl.co/collaboratorFind/$id"), true);
    $vacancies_applied = json_decode(file_get_contents("https://REST-API.joseramonhernan.repl.co/showApplied/$id"), true);

    $idCollaborator = $user['_id'];
?>
<div class="container">
<div class="row">
<?php

   for($x=0; $x<count($vacancies); $x++)
   {
    /*echo $vacancies[$x]['title'];
    echo ("<br>");*/
    for($z=0; $z<count($vacancies_applied); $z++)
    {
    # echo $vacancies_applied[$z]['name_vacancie'];
    # echo ("<br>");

    if($vacancies[$x]['title'] == $vacancies_applied[$z]['name_vacancie'])
    {
      $register_graduated = "true";
      $date_applied = $vacancies_applied[$z]['application_date'];
    }else{
      $register_graduated = "false";
    }
  }
    
if($vacancies[$x]['status'] == "true")
{
    ?>
<div class="col-sm-4" style="padding-top:25px;">
  <div class="card">
    <img class="card-img-top" src="../admin/subidasVacancies/<?php echo$vacancies[$x]['photo'];?>" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title"><?php echo$vacancies[$x]['title'];?></h5>
      <h6 class="card-title">Puesto: <?php echo$vacancies[$x]['puesto'];?></h6>
      <p class="card-text"><?php echo$vacancies[$x]['description'];?></p>
      <a href="./applicatorsValidate.php?id=<?php echo$id;?>&idCollaborator=<?php echo$idCollaborator;?>&idVacancie=<?php echo$vacancies[$x]['_id'];?>&name_vacancie=<?php echo$vacancies[$x]['title'];?>" class="btn btn-primary">Aplicar</a>
      <hr>
      <p class="card-text"><small class="text-muted">Fecha de Registro: <?php echo$vacancies[$x]['date_register'];?></small></p>
      <hr>
      <p class="card-text"><small class="text-muted">Fecha de Cierre: <?php echo$vacancies[$x]['deadline'];?></small></p>
    </div>
  </div>
   </div>
   

    <?php
  }
}
   ?>

</div>
  </div>
<?php
echo ("<hr>");
}catch(Exception $e){
  echo "error con la conexión a internet (Reload)";
}


}