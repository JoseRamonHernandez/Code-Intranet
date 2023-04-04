<?php

function exception_error_handler($errno, $errstr, $errfile, $errline)
{
    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
}

set_error_handler("exception_error_handler");



if(empty($_GET['idCollaborator']) && empty($_GET['idCategorie']) && empty($_GET['idCourse']))
{
    echo("No se reciben parametros");
}
else
{

    $idCollaborator = $_GET['idCollaborator'];
    $idCategorie = $_GET['idCategorie'];
    $idCourse = $_GET['idCourse'];

   

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
    
        <title>Cursos</title>
    </head>
    <body>
        
    
    
    
    
          <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">
        <a class="navbar-brand" >CURSO - Materiales</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item dropdown">
            <p></p>
            <a href="testInitial.php?idCollaborator=<?php echo $idCollaborator;?>&idCategorie=<?php echo $idCategorie; ?>&idCourse=<?php echo $idCourse; ?>" style="text-decoration: none;">
          <h5>Realizar Cuestionario</h5>
          </a>  
            </li>
    
          </ul>
          <form class="d-flex" role="search" method="GET" action="showCourses.php">
            <input type="hidden" name="idCollaborator" value="<?php echo $idCollaborator; ?>">
            <input type="hidden" name="idCategorie" value="<?php echo $idCategorie; ?>">
            <button class="btn btn-outline-primary" name="close" type="submit">Regresar</button>
          </form>
        </div>
      </div>
    </nav>

    <div class="container" style="padding-top: 5%">

<h3 class="text-center">Se muestra todos los materiales disponibles para el curso seleccionado.</h3>
<hr>

<div class="row row-cols-1 row-cols-md-3 g-4">
<?php

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
<a href="downloadFile.php?nameFile='.$element['name'].'&idCourse='.$idCourse.'&idCategorie='.$idCategorie.'&idCollaborator='.$idCollaborator.'" class="btn btn-primary"> Ver </a>
</div>
</div>
</div>
    ');
}

?>
</div>
</div>
<?php
}
?>