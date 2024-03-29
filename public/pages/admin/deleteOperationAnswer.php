<?php

function exception_error_handler($errno, $errstr, $errfile, $errline)
{
    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
}

set_error_handler("exception_error_handler");

if(!empty($_GET['idOperation']))
{

    $idOperation = $_GET['idOperation'];


try{
    $datosOperation = json_decode(file_get_contents("http://localhost:3000/getCollaborators/operation/$idOperation"), true);
        
    for($x=0; $x<count($datosOperation); $x++)
    {
        $numeroEmpleado = $datosOperation[$x]['no_collaborator'];

        $datosCollaborator = json_decode(file_get_contents("http://localhost:3000/collaborator/$numeroEmpleado"), true);
        $idCollaborator = $datosCollaborator['_id'];

        $deleteRegisterINTOcollaborator = json_decode(file_get_contents("http://localhost:3000/$idCollaborator/DeleteOperationsINTOcollaborator/$idOperation"), true);
    }

    $datos = json_decode(file_get_contents("http://localhost:3000/deleteOperation/$idOperation"), true);
        
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
                    text: 'Se elimino la Operación correctamente',
                    showDenyButton: false,
                    showCancelButton: false,
                    iconColor: '#FF0000',
                    confirmButtonText: 'OK',
                    
                  }).then((result) => {
              /* Read more about isConfirmed, isDenied below */
              if (result.isConfirmed) {
               
                window.location="./operations.php" 
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
               
                window.location="./operations.php" 
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