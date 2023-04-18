<?php


require_once "../poo/clases.php";

function exception_error_handler($errno, $errstr, $errfile, $errline)
{
    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
}

set_error_handler("exception_error_handler");


if(isset($_GET['guardar'])==1)
{
    
    $empleado = $_GET['empleado'];
    $nombre = $_GET['nombre'];
    $apellido = $_GET['apellido'];
    $email = $_GET['email'];
    $area = $_GET['area'];
  
    
  
  
    try
    { 
   //url de la petición
   $datos = json_decode(file_get_contents("http://localhost:3000/collaborator/$empleado"), true);
   $id = $datos['_id'];
  // echo $id;          
   $url = "http://localhost:3000/collaboratorUpdate/$id";
   
   //inicializamos el objeto CUrl
   $ch = curl_init($url);
    
   //el json simulamos una petición de un login
   $jsonData = array(
      'numero_empleado' => $empleado,
      'name' => $nombre,
      'lastname' => $apellido,
      'email' => $email,
      'area' => $area,
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
        text: 'La actualización se realizó con éxtio',
        showDenyButton: false,
        showCancelButton: false,
        confirmButtonText: 'OK',
        
      }).then((result) => {
  /* Read more about isConfirmed, isDenied below */
  if (result.isConfirmed) {
   
    window.location="./showAdministrators.php" 
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
        showDenyButton: false,
        showCancelButton: false,
        confirmButtonText: 'OK',
        
      }).then((result) => {
  /* Read more about isConfirmed, isDenied below */
  if (result.isConfirmed) {
   
    window.location="./showAdministrators.php" 
  } 
      })     
      </script>
</body>
</html>
    <?php
    }
  

}

?>