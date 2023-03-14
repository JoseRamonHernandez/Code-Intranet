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

    <title>Cursos</title>
</head>
<body >


<?php

if(!empty(isset($_GET['nameCourse'])) && !empty(isset($_GET['idCourse'])) && !empty(isset($_GET['idCategorie'])) && !empty(isset($_GET['nameCategorie'])))
{

    $idCourse = $_GET['idCourse'];
    $idCategorie = $_GET['idCategorie'];
    $nameCategorie = $_GET['nameCategorie'];
    $nameCourse = $_GET['nameCourse'];

?>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
   <div class="container" style="">
   <ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="">Curso: <?php echo $nameCourse; ?> de la Categoria: <?php echo $nameCategorie; ?></a>
  </li>
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Acciones</a>
    <ul class="dropdown-menu">
      <li><a class="dropdown-item" href="createMaterial.php?nameCourse=<?php echo$nameCourse; ?>&idCourse=<?php echo$idCourse; ?>&idCategorie=<?php echo$idCategorie; ?>&nameCategorie=<?php echo$nameCategorie; ?>">Registrar material para el curso</a></li>
      <li><hr class="dropdown-divider"></li>
      <li><a class="dropdown-item" href="#">Cuestionario</a></li>
    </ul>
  </li>
</ul>

   </div>
      <form class="d-flex" role="search" method="GET" action="selectCategorie.php">
        <input type="hidden" name="idCategorie" value="<?php echo $idCategorie; ?>">
        <input type="hidden" name="nameCategorie" value="<?php echo $nameCategorie; ?>">
        <button class="btn btn-outline-primary" name="buscar" type="submit">Regresar</button>
      </form>
    
  </div>
</nav>

<div class="container" style="padding-top: 3%;">

<h3>Material Registrado para este Curso.</h3>

<div class="row row-cols-1 row-cols-md-3 g-4">

<br>

<?php

try{
    

        $curso = json_decode(file_get_contents("https://REST-API.joseramonhernan.repl.co/$idCategorie/curso/$idCourse"), true);

        

        $material = $curso['curso']['material'];

        

        foreach ($material as $element) {
           # echo $element['documentType'];
           $idMaterial = $element['_id'];

            if($element['documentType'] == "PDF")
            {
                $img = "pdf";
               # echo $img;
            }elseif($element['documentType'] == "WORD")
            {
                $img = "word";
               # echo $img;
            }elseif($element['documentType'] == "EXCEL")
            {
                $img = "excel";
               # echo $img;
            }elseif($element['documentType'] == "POWER-POINT")
            {
                $img = "powerpoint";
               # echo $img;
            }
            

            echo ('
            <div class="col">
<div class="card" style=" width: 15rem;">
  <img src="../../img/material/'.$img.'.png" class="card-img-top" alt="..."  width="100" height="200">
  <div class="card-body">
    <h5 class="card-title">'.$element['name'].'</h5>
    <a href="downloadFileAdmin.php?nameFile='.$element['name'].'&nameCourse='.$nameCourse.'&idCourse='.$idCourse.'&idCategorie='.$idCategorie.'&nameCategorie='.$nameCategorie.'" class="btn btn-primary"> Download </a>
    <a href="deleteMaterialCourse.php?idMaterial='.$idMaterial.'&nameCourse='.$nameCourse.'&idCourse='.$idCourse.'&idCategorie='.$idCategorie.'&nameCategorie='.$nameCategorie.'" class="btn btn-danger">Delete</a>
  </div>
</div>
</div>
            ');
        }

    }catch(Exception $e)
    {
        echo "error en la consulta";
    }

?>


</div>

</div>


<?php

}else{
    echo ("No se reciben parametros");
}



?>

</body>
</html>