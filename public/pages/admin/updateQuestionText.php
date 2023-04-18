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

if(isset($_GET['saveQuestionText'])==1)
{

if(!empty(isset($_GET['idOptions'])) && !empty(isset($_GET['question_text'])) && !empty(isset($_GET['option1'])) && !empty(isset($_GET['option2'])) && !empty(isset($_GET['option3'])) && !empty(isset($_GET['option4'])) && !empty(isset($_GET['idQuestion'])) && !empty(isset($_GET['nameCourse'])) && !empty(isset($_GET['idCourse'])) && !empty(isset($_GET['idCategorie'])) && !empty(isset($_GET['nameCategorie'])))
{

    $idCourse = $_GET['idCourse'];
    $idCategorie = $_GET['idCategorie'];
    $nameCategorie = $_GET['nameCategorie'];
    $nameCourse = $_GET['nameCourse'];

    $idQuestion = $_GET['idQuestion'];
    $idOptions = $_GET['idOptions'];

    $question_text = $_GET['question_text'];
    $option1 = $_GET['option1'];
    $option2 = $_GET['option2'];
    $option3 = $_GET['option3'];
    $option4 = $_GET['option4'];

    
    try
    { 
   //url de la petición
   $url = "http://localhost:3000/$idCategorie/course/$idCourse/question/$idQuestion/insertQuestion";
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
    ?>
    <script>
        window.location="./updateOptions.php?idCategorie=<?php echo $idCategorie; ?>&idCourse=<?php echo $idCourse; ?>&nameCategorie=<?php echo $nameCategorie; ?>&nameCourse=<?php echo $nameCourse; ?>&idQuestion=<?php echo $idQuestion; ?>&idOptions=<?php echo $idOptions; ?>&option1=<?php echo $option1; ?>&option2=<?php echo $option2; ?>&option3=<?php echo $option3; ?>&option4=<?php echo $option4; ?>";
    </script>
    <?php
   }

}catch(Exception $e)
{
    ?>
    <script>
        window.location="../err.html";
    </script>
    <?php
}


}else{
    echo("No se reciben parametros");
}
}
?>