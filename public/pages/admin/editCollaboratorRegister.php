<?php

$empleado = $_GET['empleado'];
$nombre = $_GET['nombre'];
$apellido = $_GET['apellido'];
$date_birthday = $_GET['date_birthday'];
$email = $_GET['email'];
$password = "clerprem001";
$area = $_GET['area'];
$project = $_GET['project'];
$date_register = $_GET['date_register'];
$number_phone = $_GET['number_phone'];
$emergency_phone = $_GET['emergency_phone'];
$photo = $_GET['photo'];
$user_type = "collaborator";

echo ("numero emplado: ".$nombre);
/*
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
    $date_birthday = $_GET['date_birthday'];
    $email = $_GET['email'];
    $password = "clerprem001";
    $area = $_GET['area'];
    $project = $_GET['project'];
    $date_register = $_GET['date_register'];
    $number_phone = $_GET['number_phone'];
    $emergency_phone = $_GET['emergency_phone'];
    $photo = $_GET['photo'];
    $user_type = "collaborator";
  
    
  
  
    try
    { 
   //url de la petición
   $url = "ttps://REST-API.joseramonhernan.repl.co/collaboratorUpdate/$emplado";
   
   //inicializamos el objeto CUrl
   $ch = curl_init($url);
    
   //el json simulamos una petición de un login
   $jsonData = array(
      'numero_empleado' => $empleado,
      'name' => $nombre,
      'lastname' => $apellido,
      'dateofbirthday' => $date_birthday,
      'email' => $email,
      'password' => $password,
      'area' => $area,
      'project' => $project,
      'date_of_register' => $date_register,
      'phone_number' => $number_phone,
      'emergency_phone_number' => $emergency_phone,
      'photo' => $photo,
      'user_type' => $user_type
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
   $login -> formSucces();
  
    } 
    catch(Exception $e){
     $login -> formFailed();
    }
  

}
*/
?>