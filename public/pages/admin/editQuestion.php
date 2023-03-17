
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

    <title>Editar Pregunta</title>
</head>
<body >

<?php

if(!empty(isset($_GET['idQuestion'])) && !empty(isset($_GET['nameCourse'])) && !empty(isset($_GET['idCourse'])) && !empty(isset($_GET['idCategorie'])) && !empty(isset($_GET['nameCategorie'])))
{

    $idCourse = $_GET['idCourse'];
    $idCategorie = $_GET['idCategorie'];
    $nameCategorie = $_GET['nameCategorie'];
    $nameCourse = $_GET['nameCourse'];

    $idQuestion = $_GET['idQuestion'];


?>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
   <div class="container" style="">
   <p></p>
   </div>
      <form class="d-flex" role="search" method="GET" action="test.php">
        <input type="hidden" name="idCourse" value="<?php echo $idCourse; ?>">
        <input type="hidden" name="idCategorie" value="<?php echo $idCategorie; ?>">
        <input type="hidden" name="nameCategorie" value="<?php echo $nameCategorie; ?>">
        <input type="hidden" name="nameCourse" value="<?php echo $nameCourse; ?>">
        <button class="btn btn-outline-primary" name="buscar" type="submit">Regresar</button>
      </form>
    
  </div>
</nav>



<?php

try{

    $obj = json_decode(file_get_contents("https://REST-API.joseramonhernan.repl.co/$idCategorie/curso/$idCourse/question/$idQuestion"));

    $questionText = $obj->question->question_text;
    #echo $questionText;

    $options = json_decode(file_get_contents("https://REST-API.joseramonhernan.repl.co/$idCategorie/curso/$idCourse/getOptions/$idQuestion"), true);

    $option1 = $options['options'][0]['option1'];
    $option2 = $options['options'][0]['option2'];
    $option3 = $options['options'][0]['option3'];
    $option4 = $options['options'][0]['option4'];

    $idOptions = $options['options'][0]['_id'];
   

    ?>

<div class="container">
    <h3>Formulario para actualizar cuestionario</h3>
    <br>

    <div class="card border-warning mb-3">
            <div class="container" style="padding: 3%;">
        <form method="GET" action="updateQuestionText.php">

        <input type="hidden" name="idCourse" value="<?php echo $idCourse; ?>">
        <input type="hidden" name="idCategorie" value="<?php echo $idCategorie; ?>">
        <input type="hidden" name="nameCategorie" value="<?php echo $nameCategorie; ?>">
        <input type="hidden" name="nameCourse" value="<?php echo $nameCourse; ?>">

        <input type="hidden" name="idQuestion" value="<?php echo $idQuestion; ?>">
        <input type="hidden" name="idOptions" value="<?php echo $idOptions; ?>">

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Pregunta</label>
                <input type="text" name="question_text" value="<?php echo $questionText; ?>"  class="form-control border-primary" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                
            </div>
           
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Opción 1</label>
                <input type="text" name="option1" value="<?php echo $option1; ?>"  class="form-control border-primary" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Opción 2</label>
                <input type="text" name="option2" value="<?php echo $option2; ?>"  class="form-control border-primary" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Opción 3</label>
                <input type="text" name="option3" value="<?php echo $option3; ?>"  class="form-control border-primary" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Opción 4</label>
                <input type="text" name="option4" value="<?php echo $option4; ?>"  class="form-control border-primary" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                <div id="emailHelp" class="form-text">Step 1.</div>
            </div>
            <button type="submit" name="saveQuestionText" class="btn btn-warning ">Continuar</button>
            
            
        </form>
        </div>
</div>
</div>

<?php
}catch(Exception $e)
{

echo ("<h2>Error en la consulta, intentalo nuevamente</h2>");

}

}else{
    echo ("No se reciben parametros");
}
?>