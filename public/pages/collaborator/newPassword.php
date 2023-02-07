<?php

function exception_error_handler($errno, $errstr, $errfile, $errline)
{
    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
}

set_error_handler("exception_error_handler");




if(empty($_GET['a'])|| empty($_GET['b']))

{
  ?>
  <script> window.location="../err.html"; </script>
  <?php
}
else{
  $password = $_GET['a'];
  $id = $_GET['b'];

 try{ $url = "https://REST-API.joseramonhernan.repl.co/collaboratorUpdate/$id";
   
    //inicializamos el objeto CUrl
    $ch = curl_init($url);
     
    //el json simulamos una petición de un login
    $jsonData = array(
       'password' => $password
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
         title: 'Todo correcto!',
         text: 'El cambio de contraseña se realizó con éxtio',
         footer: 'Por seguridad, inicia sesión nuevamente',
         allowOutsideClick: false,
        allosEscapeKey: false,
        allosEnterKey: false,
        stopKeydownPropagation: false,
         showDenyButton: false,
         showCancelButton: false,
         confirmButtonText: 'OK',
         
       }).then((result) => {
   /* Read more about isConfirmed, isDenied below */
   if (result.isConfirmed) {
    
     window.location="../../login.php" 
   } 
       })     
       </script>
 </body>
 </html>
    <?php
   
     } 
     catch(Exception $e){
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
         text: 'Ocurrió un error, intentalo nuevamente',
         allowOutsideClick: false,
        allosEscapeKey: false,
        allosEnterKey: false,
        stopKeydownPropagation: false,
         showDenyButton: false,
         showCancelButton: false,
         confirmButtonText: 'OK',
         
       }).then((result) => {
   /* Read more about isConfirmed, isDenied below */
   if (result.isConfirmed) {
    
     window.location="../../login.php" 
   } 
       })     
       </script>
 </body>
 </html>
     <?php
     }
   
 
 }
 
 ?>