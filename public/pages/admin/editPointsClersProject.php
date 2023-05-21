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


    <title>CLER´S</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    
  </head>
  <body>

<?php

if(isset($_GET['saveData'])==1)
{
    $project = $_GET['project'];
    $clers = $_GET['clers'];
    $count = 0;

    $numberCler = intval($clers);
    
    $allCollaborators = json_decode(file_get_contents("http://localhost:3000/collaborators"), true);

    if(!empty($allCollaborators))
    {
        for($x=0; $x<count($allCollaborators); $x++)
        {
            if($allCollaborators[$x]['project'] == $project)
            {
                $count++;

                $idCollaborator = $allCollaborators[$x]['_id'];

                $countClers = intval($allCollaborators[$x]['clers']);

                $total = $countClers - $numberCler;

                //echo $total;

                //url de la petición
                $url = "localhost:3000/collaboratorUpdate/$idCollaborator";
                //inicializamos el objeto CUrl
                $ch = curl_init($url);
                
                //el json simulamos una petición de un login
                $jsonData = array(
                    'clers' => $total
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
                <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>Swal.fire({
                icon: 'success',
                title: 'Captura correcta!',
                text: 'Se han actualizado todos los usuarios del proyecto <?php echo $project; ?>.',
                showConfirmButton: true,
                showCancelButton: false,
                confirmButtonText: 'Ok',
                confirmButtonColor: 'blue'
            }).then((result) => {
                if(result.isConfirmed)
                {
                    window.location="EditClersProyecto.php"
                }
            })     
            </script>
                <?php
                
            }
        }
        }

        if($count == 0)
        {
            ?>
            <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>Swal.fire({
            icon: 'info',
            title: 'No hay usuarios registrados para el proyecto <?php echo $project; ?>',
            text: 'No se realizó ninguna acción',
            showConfirmButton: true,
            showCancelButton: false,
            confirmButtonText: 'Ok',
            confirmButtonColor: 'blue'
            }).then((result) => {
                if(result.isConfirmed)
                {
                    window.location="EditClersProyecto.php"
                }
            })     
        </script>
            <?php
            
        }
    }
}
else
{
    echo("No hay parámetros");
}
?>