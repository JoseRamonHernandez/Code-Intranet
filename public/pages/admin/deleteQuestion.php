<?php

if(!empty(isset($_GET['textQuestion'])) && !empty(isset($_GET['idQuestion'])) && !empty(isset($_GET['nameCourse'])) && !empty(isset($_GET['idCourse'])) && !empty(isset($_GET['idCategorie'])) && !empty(isset($_GET['nameCategorie'])))
{

    $idCourse = $_GET['idCourse'];
    $idCategorie = $_GET['idCategorie'];
    $nameCategorie = $_GET['nameCategorie'];
    $nameCourse = $_GET['nameCourse'];

    $idQuestion = $_GET['idQuestion'];
    $textQuestion = $_GET['textQuestion'];

    ?>

<!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Document</title>
            
                <script src="sweetalert2.min.js"></script>
            <link rel="stylesheet" href="sweetalert2.min.css">
            
            </head>
            <body>
                
            
                <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>Swal.fire({
                    title: 'Seguro que quieres eliminar la pregunta:',
                    text: '<?php echo$textQuestion;?>',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonText: 'Si, Eliminar',
                    confirmButtonColor: '#E11515',
                    denyButtonText: 'Cancelar'
                    
                  }).then((result) => {
              /* Read more about isConfirmed, isDenied below */
              if (result.isConfirmed) {
               
                window.location="./deleteQuestionAnswer.php?idQuestion=<?php echo $idQuestion; ?>&idCourse=<?php echo $idCourse;?>&idCategorie=<?php echo $idCategorie;?>&nameCategorie=<?php echo $nameCategorie;?>&nameCourse=<?php echo $nameCourse;?>" 
              }else{
                window.location="./test.php?idCourse=<?php echo $idCourse;?>&idCategorie=<?php echo $idCategorie;?>&nameCategorie=<?php echo $nameCategorie;?>&nameCourse=<?php echo $nameCourse;?>"
              } 
                  });  
                  </script>

    <?php
}else{
    echo("No se reciben parametros");
}