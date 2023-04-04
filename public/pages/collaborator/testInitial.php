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
        <a class="navbar-brand" >Cuestionario</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item dropdown">
           
            </li>
    
          </ul>
          <form class="d-flex" role="search" method="GET" action="materialCourses.php">
            <input type="hidden" name="idCollaborator" value="<?php echo $idCollaborator; ?>">
            <input type="hidden" name="idCategorie" value="<?php echo $idCategorie; ?>">
            <input type="hidden" name="idCourse" value="<?php echo $idCourse;?>">
            <button class="btn btn-outline-primary" name="close" type="submit">Regresar</button>
          </form>
        </div>
      </div>
    </nav>

<?php

$questions = json_decode(file_get_contents("https://REST-API.joseramonhernan.repl.co/$idCategorie/questions/$idCourse"), true);

$count = 0;



foreach ($questions['questions'] as $question) {
    #echo $question['question_text'] . '<br>'; // Imprimir valor de "question_text"
    $count++;
   
  }

  echo $questions['questions'][1]['question_text'];//Esta es la clave
?>

<div class="container" style="padding-top: 4%">

<h2 style="color: blue">Dato importante: Después de iniciar con el cuestionario no podrás retroceder y deberás terminar tu intento, al final del cuestionario se te mostrará el resultado obtenido.</h2>

<hr>
<hr>

<h5>Número de preguntas: <?php echo $count; ?></h5>

<div class="container" style="padding: 5%">
<center>
<a href="" style="text-decoration: none">
<button class="btn btn-success btn-lg">Iniciar Cuestionario</button>
</a>
</center>
</div>
</div>

<?php
}
?>