<html lang="HTML5">
<head>    <title>Register...</title>  </head>
<body>
<?php

function exception_error_handler($errno, $errstr, $errfile, $errline)
{
    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
}

set_error_handler("exception_error_handler");


if(isset($_POST['save'])==1)
{
    
    if(!empty($_FILES['archivo-a-subir']['name']))
{
  
  $target_path = "subidasVacancies/"; 
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

$title = $_POST['title'];
$description = $_POST['description'];
$date_register = date('Y-m-d');
$deadline = $_POST['deadline'];
$area = $_POST['area'];




try
  { 
 //url de la petición
 $url = 'https://REST-API.joseramonhernan.repl.co/createVacancies';
 
 //inicializamos el objeto CUrl
 $ch = curl_init($url);
  
 //el json simulamos una petición de un login
 $jsonData = array(
    'title' => $title,
    'description' => $description,
    'date_register' => $date_register,
    'deadline' => $deadline,
    'photo' => $img,
    'area' => $area
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
   title: 'Vacante guardado con éxito!',
   
    showConfirmButton: true,
   confirmButtonText: 'Close'
}).then((result) => {
window.location="vacantes.php"
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
         position: 'center',
   icon: 'error',
   title: 'Ocurrio un error durante el proceso, intentalo nuevamente!',
   
   footer: '<span style="color: blue">Comprueba tu conexión a internet.</span>',
   showConfirmButton: true,
   confirmButtonText: 'Close'
}).then((result) => {
window.location="vacantes.php"
});
            
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

/*
// Establecer la fecha actual
$fecha_actual = date('Y-m-d');

// Sumar un día a la fecha actual
$nueva_fecha = date('Y-m-d', strtotime($fecha_actual . ' +1 day'));

// Mostrar la nueva fecha
echo "La nueva fecha es: " . $nueva_fecha;

$today = date('N'); // Obtiene el día de la semana en formato numérico
if ($today == 5) {
    echo "¡Hoy es viernes!";
} else {
    echo "Hoy no es viernes :(";
}

#$fecha_actual = "2023-02-24"; // Fecha en formato YYYY-MM-DD

if (date("N", strtotime($fecha_actual)) == 5) {
  echo "La fecha $fecha_actual corresponde a un viernes.";
} else {
  echo "La fecha $fecha_actual no corresponde a un viernes.";
}
*/
}else{
    echo("Ocurrío un error durante el proceso. Intentalo Nuevamente o contácta al desarrollador!");
}

?>
</body>
</html>