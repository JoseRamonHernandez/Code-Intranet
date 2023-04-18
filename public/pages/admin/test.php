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
        $questions = json_decode(file_get_contents("http://localhost:3000/$idCategorie/questions/$idCourse"), true);
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

    try{
    if( is_null($question['options'][0]['option1']) || is_null($question['options'][0]['option2']) || is_null($question['options'][0]['option3']) || is_null($question['options'][0]['option4']) || is_null($question['answerOption']))
    {
      echo ("Tienes variables nulas");
    }
  }catch(Exception $e)
  {
    $idQuestion = json_decode(file_get_contents("http://localhost:3000/$idCategorie/questions/$idCourse"), true);

    $count = 0;

    foreach ($idQuestion['questions'] as $question) {
        #echo $question['question_text'] . '<br>'; // Imprimir valor de "question_text"
        $count++;
      }
      $total = $count -1;

      $idQuestionText = $idQuestion['questions'][$total]['_id'];

      $deleteQuestion = json_decode(file_get_contents("http://localhost:3000/$idCategorie/course/$idCourse/question/$idQuestionText"), true);

      if($deleteQuestion)
      {
        ?>
        <script>
          window.locations="./test.php?idCourse=<?php echo $idCourse; ?>&idCategorie=<?php echo $idCategorie; ?>&nameCategorie=<?php echo $nameCategorie; ?>&nameCourse=<?php echo $nameCourse; ?>";
        </script>
        <?php
      }
  }
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
    <td class="text-center"><a href="editQuestion.php?idQuestion='.$question['_id'].'&idCourse='.$idCourse.'&idCategorie='.$idCategorie.'&nameCategorie='.$nameCategorie.'&nameCourse='.$nameCourse.'" style="text-decoration:none; color: #E6C711;" title="Editar"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
  </svg></a></td>
    <td class="text-center"><a href="deleteQuestion.php?textQuestion='.$question['question_text'].'&idQuestion='.$question['_id'].'&idCourse='.$idCourse.'&idCategorie='.$idCategorie.'&nameCategorie='.$nameCategorie.'&nameCourse='.$nameCourse.'" style="text-decoration:none; color: #E62F11;" title="Eliminar"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
    <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
  </svg></a></td>
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