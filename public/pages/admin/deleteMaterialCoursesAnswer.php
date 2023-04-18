<?php

function exception_error_handler($errno, $errstr, $errfile, $errline)
{
    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
}

set_error_handler("exception_error_handler");

if(!empty(isset($_GET['nameCourse'])) && !empty(isset($_GET['idMaterial']))  && !empty(isset($_GET['idCourse']))  && !empty(isset($_GET['idCategorie']))  && !empty(isset($_GET['nameCategorie'])))
{

    $nameCourse = $_GET['nameCourse'];
    $nameCategorie = $_GET['nameCategorie'];
    $idCategorie = $_GET['idCategorie'];
    $idCourse = $_GET['idCourse'];
    $idMaterial = $_GET['idMaterial'];


try{
    $datos = json_decode(file_get_contents("http://localhost:3000/$idCategorie/$idCourse/material/$idMaterial"), true);
        
        if($datos){
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
                    icon: 'success',
                    title: 'Eliminación exitosa!',
                    text: 'Se elimino el MATERIAL correctamente',
                    showDenyButton: false,
                    showCancelButton: false,
                    iconColor: '#FF0000',
                    confirmButtonText: 'OK',
                    
                  }).then((result) => {
              /* Read more about isConfirmed, isDenied below */
              if (result.isConfirmed) {
               
                window.location="./selectCourses.php?nameCourse=<?php echo$nameCourse; ?>&idCourse=<?php echo$idCourse; ?>&idCategorie=<?php echo$idCategorie; ?>&nameCategorie=<?php echo$nameCategorie; ?>" 
              } 
                  }) 
                  </script>
            </body>
            </html>
                    <?php
        }else{
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
                    icon: 'error',
                    title: 'Ocurrio un error!',
                    text: 'Lo sentimos, ocurrio un error durante el proceso de eliminar, intentalo nuevamente.',
                    showDenyButton: false,
                    showCancelButton: false,
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#31DF0E'
                    
                  }).then((result) => {
              /* Read more about isConfirmed, isDenied below */
              if (result.isConfirmed) {
               
                window.location="./createProject.php" 
              } 
                  }) 
                  </script>
            </body>
            </html>
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
    ?>
    <script>
    window.location="../err.html"
  </script>
  <?php
}