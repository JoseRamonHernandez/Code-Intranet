<?php

function exception_error_handler($errno, $errstr, $errfile, $errline)
{
    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
}

set_error_handler("exception_error_handler");

if(!empty($_GET['id']))
{

    $id = $_GET['id'];

try{
    $datos = json_decode(file_get_contents("https://REST-API.joseramonhernan.repl.co/deleteEvent/$id"), true);
        
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
                    text: 'Se elimino el evento correctamente',
                    showDenyButton: false,
                    showCancelButton: false,
                    confirmButtonText: 'OK',
                    
                  }).then((result) => {
              /* Read more about isConfirmed, isDenied below */
              if (result.isConfirmed) {
               
                window.location="./events.php" 
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
               
                window.location="./events.php" 
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