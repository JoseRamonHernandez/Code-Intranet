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

    <title>Opciones</title>
</head>
<body >

<?php

if(isset($_GET['save_question'])==1)
{

if(!empty(isset($_GET['question_text'])) && !empty(isset($_GET['nameCourse'])) && !empty(isset($_GET['idCourse'])) && !empty(isset($_GET['idCategorie'])) && !empty(isset($_GET['nameCategorie'])))
{

    $idCourse = $_GET['idCourse'];
    $idCategorie = $_GET['idCategorie'];
    $nameCategorie = $_GET['nameCategorie'];
    $nameCourse = $_GET['nameCourse'];

    $question_text = $_GET['question_text'];

    try
{ 
//url de la petición
$url = "http://localhost:3000/$idCategorie/insertQuestions/$idCourse";

//inicializamos el objeto CUrl
$ch = curl_init($url);

//el json simulamos una petición de un login
$jsonData = array(
  'question_text' => $question_text
);

//creamos el json a partir de nuestro arreglo
$jsonDataEncoded = json_encode($jsonData);

//Indicamos que nuestra petición sera Post
curl_setopt($ch, CURLOPT_POST, 1);

//para que la peticion no imprima el resultado como un echo comun, y podamos manipularlo
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

//Adjuntamos el json a nuestra petición
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);

//Agregamos los encabezados del contenido
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

//ignorar el certificado, servidor de desarrollo
         //utilicen estas dos lineas si su petición es tipo https y estan en servidor de desarrollo
//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        //curl_setopt($process, CURLOPT_SSL_VERIFYHOST, FALSE);

//Ejecutamos la petición
$result = curl_exec($ch);

if($result)
{



    $idQuestion = json_decode(file_get_contents("http://localhost:3000/$idCategorie/questions/$idCourse"), true);

    $count = 0;

    foreach ($idQuestion['questions'] as $question) {
        #echo $question['question_text'] . '<br>'; // Imprimir valor de "question_text"
        $count++;
      }
      $total = $count -1;

      $idQuestionText = $idQuestion['questions'][$total]['_id'];




?>

<br>
<div class="container">
    <h3>Formulario para pregunta nueva (OPCIONES)!</h3>
    <div class="" style="padding-top:3%;">
        <hr>
        <h5>Pregunta:</h5>
        <h6><?php echo $question_text; ?></h6>
        <hr>

        <div class="card border-success mb-3">
            <div class="container" style="padding: 3%;">
        <form method="GET" action="createAnswerOption.php">

        <input type="hidden" name="idCourse" value="<?php echo $idCourse; ?>">
        <input type="hidden" name="idCategorie" value="<?php echo $idCategorie; ?>">
        <input type="hidden" name="nameCategorie" value="<?php echo $nameCategorie; ?>">
        <input type="hidden" name="nameCourse" value="<?php echo $nameCourse; ?>">

        <input type="hidden" name="idQuestionText" value="<?php echo $idQuestionText; ?>">
        <input type="hidden" name="question_text" value="<?php echo $question_text; ?>">

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Opcion 1</label>
                <input type="text" name="option1" placeholder="Ingresa el texto de la Opcion 1"  class="form-control border-dark" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Opcion 2</label>
                <input type="text" name="option2" placeholder="Ingresa el texto de la Opcion 2"  class="form-control border-dark" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Opcion 3</label>
                <input type="text" name="option3" placeholder="Ingresa el texto de la Opcion 3"  class="form-control border-dark" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Opcion 4</label>
                <input type="text" name="option4" placeholder="Ingresa el texto de la Opcion 4"  class="form-control border-dark" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                
            </div>
            <div id="emailHelp" class="form-text">Step 2.</div>
            <button type="submit" name="saveOptions" class="btn btn-success ">Continuar</button>
            
            
        </form>
        </div>
</div>

    </div>
</div>

<?php

}else{
    ?>
    <script>
        window.location="../err.html"
    </script>
    <?php
}

}catch(Exception $e){
    ?>
    <script>
        window.location="../err.html"
    </script>
    <?php
}

}else{
    echo("No se reciben parametros");
}
}else{
    echo("Error en la consulta");
}
?>