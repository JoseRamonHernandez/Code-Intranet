<?php

function exception_error_handler($errno, $errstr, $errfile, $errline)
{
    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
}

set_error_handler("exception_error_handler");

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link rel="icon" type="image/png" href="…">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css">
    <title>Eliminar registro </title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    
  </head>
  <body>

<?php

if(!empty($_GET['idCollaborator']) && !empty($_GET['id_operation']) && !empty($_GET['numberCollaborator']))
        {
            $idCollaborator = $_GET['idCollaborator'];
            $id_operation = $_GET['id_operation'];
            $numberCollaborator = $_GET['numberCollaborator'];

            //echo $numberCollaborator;

            
                $datosOperation = json_decode(file_get_contents("http://localhost:3000/findOperation/$id_operation"), true);
                $nombre = $datosOperation['name_of_operation'];
                $projecto = $datosOperation['project'];

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
                                    title: 'Seguro que quieres eliminar el registro del usuario en la operación: <?php echo $nombre; ?>',
                                    text: 'Del proyecto: <?php echo $projecto; ?>',
                                    showDenyButton: false,
                                    showCancelButton: true,
                                    confirmButtonText: 'Si, Eliminar',
                                    confirmButtonColor: '#E11515',
                                    denyButtonText: 'Cancelar'
                                    
                                  }).then((result) => {
                              /* Read more about isConfirmed, isDenied below */
                              if (result.isConfirmed) {
                               window.location="./deleteALLregisterOFoperations.php?idCollaborator=<?php echo $idCollaborator; ?>&id_operation=<?php echo $id_operation; ?>&numberCollaborator=<?php echo $numberCollaborator; ?>"
                               }else{
                               window.location="./registerOperation.php?numberCollaborator=<?php echo $numberCollaborator;?>"
                             } 
                                 });  
                                  </script>
        
                <?php
            

        }else{
            echo ("No se reciben parametros");
        }