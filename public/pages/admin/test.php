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

    <title>Cuestionario</title>
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
   <a href="createQuestion.php?nameCourse=<?php echo$nameCourse; ?>&idCourse=<?php echo$idCourse; ?>&idCategorie=<?php echo$idCategorie; ?>&nameCategorie=<?php echo$nameCategorie; ?>" style="text-decoration:none;"><p>Registrar Pregunta Nueva</p></a>
   </div>
      <form class="d-flex" role="search" method="GET" action="selectCourses.php">
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
        $questions = json_decode(file_get_contents("https://REST-API.joseramonhernan.repl.co/$idCategorie/questions/$idCourse"), true);
        $a=0;
        $count = 0;

        foreach ($questions['questions'] as $question) {
            #echo $question['question_text'] . '<br>'; // Imprimir valor de "question_text"
            $count++;
          }
          #echo $count;

    }catch(Exception $e)
    {
        echo("Error en la consulta");
    }

    ?>

<div class="tex-center" style="padding-top:3%;">
    <div class="container">
        <h2>
            DESGLOSE DE PREGUNTAS REGISTRADAS PARA EL CURSO: <u><?php echo $nameCourse; ?></u> DENTRO DE LA CATEGORIA: <u><?php echo $nameCategorie; ?></u>
        </h2>

        <div class="table-responsive">

        <table class="table caption-top table-bordered border-primary">
  <caption>Numero de preguntas registradas: <?php echo $count; ?></caption>
  <thead>
    <tr>
      <th scope="col" class="text-center">#</th>
      <th scope="col" class="text-center">Texto de la Pregunta</th>
      <th scope="col" class="text-center">Opción 1</th>
      <th scope="col" class="text-center">Opción 2</th>
      <th scope="col" class="text-center">Opción 3</th>
      <th scope="col" class="text-center">Opción 4</th>
      <th scope="col" class="text-center">Respuesta Correcta</th>
      <th class="text-center">Editar</th>
      <th class="text-center">Eliminar</th>
    </tr>
  </thead>
  <tbody>

  <?php

foreach ($questions['questions'] as $question) {
    #echo $question['question_text'] . '<br>'; // Imprimir valor de "question_text"
    $a++;
    echo('
    
    <tr>
    <th scope="row">'.$a.'</th>
    <td>'.$question['question_text'].'</td>
    <td>'.$question['options'][0]['option1'].'</td>
    <td>'.$question['options'][0]['option2'].'</td>
    <td>'.$question['options'][0]['option3'].'</td>
    <td>'.$question['options'][0]['option4'].'</td>
    <td>'.$question['answerOption'].'</td>
    <td>Icon Edit</td>
    <td>Icon Delete</td>
  </tr>
    
    ');
  }

?>
    
   
  </tbody>
</table>

</div>

    </div>
</div>

<?php

}else{
    echo("<h2>Sin Resultados</h2>");
}
?>