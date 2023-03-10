<html lang="HTML5">
<head>    <title>PHP Quick Start</title>  </head>
<body>
<?php

function exception_error_handler($errno, $errstr, $errfile, $errline)
{
    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
}

set_error_handler("exception_error_handler");


require __DIR__ . '../../vendor/autoload.php';




$empleado = $_POST['empleado'];
  $nombre = $_POST['nombre'];
  $apellido = $_POST['apellido'];
  $email = $_POST['email'];
  $password = "admin001";
  $area = $_POST['area'];

  $user_type = "administrator";
 
if(!empty($_FILES['archivo-a-subir']['name']))
{
  
  $target_path = "subidas/"; 
$target_path = $target_path . basename( $_FILES['archivo-a-subir']['name']); 
if(move_uploaded_file($_FILES['archivo-a-subir']['tmp_name'], $target_path)) 
{ 
//echo "\nEl archivo ". basename( $_FILES['archivo-a-subir']['name'])." ha sido subido exitosamente!"; 
$img = $_FILES['archivo-a-subir']['name'];
} 
else
{ 
//echo "\nHubo un error al subir tu archivo! Por favor intenta de nuevo."; 
$img = "logo_clerprem.png";
}
}else{
  $img = "logo_clerprem.png";
}




try
  { 
 //url de la petición
 $url = 'https://REST-API.joseramonhernan.repl.co/collaboratorRegister';
 
 //inicializamos el objeto CUrl
 $ch = curl_init($url);
  
 //el json simulamos una petición de un login
 $jsonData = array(
    'numero_empleado' => $empleado,
    'name' => $nombre,
    'lastname' => $apellido,
    'email' => $email,
    'password' => $password,
    'area' => $area,
    'photo' => $img,
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
   footer: '<span style="color: blue">Si no se encuentra el usuario registrado, puede ser por algún inconveniente a la hora de almacenarlo. Capturelo nuevamente.</span>',
   showConfirmButton: true,
   confirmButtonText: 'Close'
}).then((result) => {
window.location="./pages/admin/showAdministrators.php"
});
            
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
            text: 'Ocurrio un error, intentalo nuevamente',
        })     
          </script>
    </body>
    </html>
       <?php
  }


?>
<!--
<form method="POST" action="upload.php" enctype="multipart/form-data">
    <input type="text" name="texto" placeholder="example" required />
<input type="hidden" name="MAX_FILE_SIZE" value="250000" /> 
Elige el Archivo a Subir:
<input name="archivo-a-subir" type="file" required/><br />
<input type="submit" value="Subir Archivo" name="enviar" />
</form>
-->
</body>
</html>