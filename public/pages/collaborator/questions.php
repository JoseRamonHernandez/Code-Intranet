<?php

if(empty($_GET['idCollaborator']) && empty($_GET['idCategorie']) && empty($_GET['idCourse']) && empty($_GET['numberQuestion']) && empty($_GET['count']) && empty($_GET['points']))
{

}
else
{
    $idCollaborator = $_GET['idCollaborator'];
    $idCategorie = $_GET['idCategorie'];
    $idCourse = $_GET['idCourse'];
    $numberQuestion = $_GET['numberQuestion'];
    $count = $_GET['count'];
    $points = $_GET['points'];



    /*Code para el formulario*/

    //Code para conseguir los datos de las preguntas dentro del curso
    $questions = json_decode(file_get_contents("http://localhost:3000/$idCategorie/questions/$idCourse"), true);
    
    //Code para conseguir el id de la pregunta en curso
    $idQuestion = $questions['questions'][$numberQuestion]['_id'];//Esta es la clave

    //Code para la barra de progreso
    $progress = (100/$count)*($numberQuestion+1);

    //Code para obtener el Question_text de la pregunta
    $question_text = $questions['questions'][$numberQuestion]['question_text'];

    //Code para obtener las options de la pregunta
    $option1 = $questions['questions'][$numberQuestion]['options'][0]['option1'];
    $option2 = $questions['questions'][$numberQuestion]['options'][0]['option2'];
    $option3 = $questions['questions'][$numberQuestion]['options'][0]['option3'];
    $option4 = $questions['questions'][$numberQuestion]['options'][0]['option4'];


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
    
        <title>TEST</title>
    </head>
    <body>
  
    <div class="container">


<div class="" style="margin-top:5%">
<div class="progress" role="progressbar" aria-label="Example with label" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
<div class="progress-bar" style="width: <?php echo $progress;?>%"><?php echo $numberQuestion+1;?></div>
</div>

<br>
<div class="card border-success mb-3">
    <div class="container" style="padding: 3%;">
<form method="GET" action="saveAnswer.php">

<input type="hidden" name="idCollaborator" value="<?php echo $idCollaborator; ?>">
<input type="hidden" name="idCategorie" value="<?php echo $idCategorie; ?>">
<input type="hidden" name="idCourse" value="<?php echo $idCourse; ?>">
<input type="hidden" name="idQuestion" value="<?php echo $idQuestion; ?>">
<input type="hidden" name="numberQuestion" value="<?php echo $numberQuestion; ?>">
<input type="hidden" name="count" value="<?php echo $count; ?>">
<input type="hidden" name="points" value="<?php echo $points; ?>">

<p><?php echo $question_text; ?></p>

<div class="form-check">
<input class="form-check-input" type="radio" name="answerOption" id="exampleRadios1" value="<?php echo $option1; ?>" required >
<label class="form-check-label" for="exampleRadios1">
<?php echo $option1; ?>
</label>
</div>
<br>

<div class="form-check">
<input class="form-check-input" type="radio" name="answerOption" id="exampleRadios2" value="<?php echo $option2; ?>" required>
<label class="form-check-label" for="exampleRadios2">
<?php echo $option2; ?>
</label>
</div>
<br>

<div class="form-check">
<input class="form-check-input" type="radio" name="answerOption" id="exampleRadios3" value="<?php echo $option3; ?>" required>
<label class="form-check-label" for="exampleRadios3">
<?php echo $option3; ?>
</label>
</div>
<br>

<div class="form-check">
<input class="form-check-input" type="radio" name="answerOption" id="exampleRadios3" value="<?php echo $option4; ?>" required>
<label class="form-check-label" for="exampleRadios3">
<?php echo $option4; ?>
</label>
</div>
<br>
<div class="d-grid gap-2 d-md-flex justify-content-md-end">
    <button type="submit" name="saveAnsweroption" class="btn btn-outline-success ">Continuar</button>
</div>
    
</form>
</div>
</div>


</div>
</div>
    <?php
}

?>