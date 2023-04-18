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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    


<?php

if(!empty(isset($_GET['numberCollaborator'])) && !empty(isset($_GET['operationID'])) && !empty(isset($_GET['idCollaborator'])) && !empty(isset($_GET['project'])) && !empty(isset($_GET['newPorcent'])))
{

    $operationID = $_GET['operationID'];
    $idCollaborator = $_GET['idCollaborator'];
    $project = $_GET['project'];
    $newPorcent = $_GET['newPorcent'];
    $numberCollaborator = $_GET['numberCollaborator'];
/*
    echo('operationID: '.$operationID.'.');
    echo("<br>");

    echo('idCollaborator: '.$idCollaborator.'.');
    echo("<br>");

    echo('project: '.$project.'.');
    echo("<br>");

    echo('newPorcent: '.$newPorcent.'.');
    echo("<br>");
*/


try
{ 
//url de la petición
$url = "http://localhost:3000/registerOperation/$idCollaborator";

//URL PARA INSERTAR EN EL COLABORADOR
//https://REST-API.joseramonhernan.repl.co/registerOperation/IDCOLLABORATOR
/*
{
    "id_operation": "641909bcaea27ae24cbf67b5",
    "project2": "HINTEN",
    "porcent": "25%"
}
*/

//URL PARA INSERTAR EN LA OPERACION
//https://REST-API.joseramonhernan.repl.co/insertCollaborator/operation/IDOPERATION
/*
{
    "no_collaborator": "611",
    "porcent": "100"
}
*/


//inicializamos el objeto CUrl
$ch = curl_init($url);

//el json simulamos una petición de un login
$jsonData = array(
  'id_operation' => $operationID,
  'project2' => $project,
  'porcent' => $newPorcent
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
            position: 'center',
      icon: 'success',
      title: 'Registro guardado con éxito!',
      
       showConfirmButton: true,
      confirmButtonText: 'Close'
   }).then((result) => {
   window.location="registerOperation.php?numberCollaborator=<?php echo $numberCollaborator; ?>"
   });
               
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
          title: 'Lo sentimos!',
          text: 'Ocurrio un error, intentalo nuevamente',
      })     
        </script>
  </body>
  </html>
     <?php
}

}catch(Exception $e){
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
          title: 'Lo sentimos!',
          text: 'Ocurrio un error, intentalo nuevamente',
      })     
        </script>
  </body>
  </html>
     <?php
}
}else{
    echo ("No se reciben parametros");
}

?>
</body>
</html>