<?php

if(isset($_GET['saveAnsweroption']) == 1)
{

if(empty($_GET['idCollaborator']) && empty($_GET['idCategorie']) && empty($_GET['idCourse']) && empty($_GET['idQuestion']) && empty($_GET['numberQuestion']) && empty($_GET['count']) && empty($_GET['points']) && empty($_GET['answerOption']))
{
    echo("Sin resultados.jpg");
}
else
{
    $idCollaborator = $_GET['idCollaborator'];
    $idCategorie = $_GET['idCategorie'];
    $idCourse = $_GET['idCourse'];
    
    $idQuestion = $_GET['idQuestion'];
    
    $numberQuestion = $_GET['numberQuestion'];
    $count = $_GET['count'];
    $points = $_GET['points'];
    
    $answerOption = $_GET['answerOption'];

    /*
    echo("<hr>");
    echo $idCollaborator;

    echo("<hr>");
    echo $idCategorie;

    echo("<hr>");
    echo $idCourse;

    echo("<hr>");
    echo $idQuestion;

    echo("<hr>");
    echo $numberQuestion;

    echo("<hr>");
    echo $count;

    echo("<hr>");
    echo $points;

    echo("<hr>");
    echo $answerOption;
    */

    $questions = json_decode(file_get_contents("https://REST-API.joseramonhernan.repl.co/$idCategorie/questions/$idCourse"), true);
    
    //Code para obtener la Respuesta Correcta
    $correctAnswer = $questions['questions'][$numberQuestion]['answerOption'];

    if($answerOption == $correctAnswer)
    {
        $points++;
    }

    if($numberQuestion+1 == $count)
    {
        //CODIGO DE NAVEGACION PARA COMPROBAR LOS PUNTOS CON EL TOTAL DE PREGUNTAS Y VALIDAR RESULTADOS
      ?>
            <script>
                window.location="saveData.php?idCollaborator=<?php echo $idCollaborator; ?>&idCategorie=<?php echo $idCategorie; ?>&idCourse=<?php echo $idCourse; ?>&count=<?php echo $count; ?>&points=<?php echo $points; ?>"
            </script>
      <?php
    }
    else
    {
        $numberQuestion++;

        ?>
            <script>
                window.location="questions.php?idCollaborator=<?php echo $idCollaborator; ?>&idCategorie=<?php echo $idCategorie; ?>&idCourse=<?php echo $idCourse; ?>&numberQuestion=<?php echo $numberQuestion; ?>&count=<?php echo $count; ?>&points=<?php echo $points; ?>"
            </script>

        <?php
    }
}
}
?>