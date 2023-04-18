<?php
require_once "../poo/clases.php";

function exception_error_handler($errno, $errstr, $errfile, $errline)
{
    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
}

set_error_handler("exception_error_handler");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    <title>Eliminar Operaciones</title>

    <link href="./style.css" rel="stylesheet" type="text/css" />

</head>
<body>

<?php

if(!empty($_GET['idOperation']))
      {
        $idOperation = $_GET['idOperation'];
        //echo $idOperation;

        try
        {
        $datos = json_decode(file_get_contents("http://localhost:3000/getCollaborators/operation/$idOperation"), true);
        
            for($x=0; $x<count($datos); $x++)
            {
                $numeroEmpleado = $datos[$x]['no_collaborator'];

                $datosCollaborator = json_decode(file_get_contents("http://localhost:3000/collaborator/$no_collaborator"), true);
                $idCollaborator = $datosCollaborator['_id'];

                $deleteRegisterINTOcollaborator = json_decode(file_get_contents("http://localhost:3000/$idCollaborator/DeleteOperationsINTOcollaborator/$idOperation"), true);
            }

        }catch(Exception $e)
        {
            echo ("Error en la consulta");
        }


      }

?>