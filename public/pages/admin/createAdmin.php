
<?php
require_once "../poo/clases.php";



function exception_error_handler($errno, $errstr, $errfile, $errline)
{
    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
}

set_error_handler("exception_error_handler");

?>

<!DOCTYPE html>
<html lang="HTML5">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    <title>Intranet-Admin</title>
</head>
<body style="background: #A8BFEA">

<?php


/*
$login = new login;

if(isset($_POST['guardar'])==1)
{

  $empleado = $_POST['empleado'];
  $nombre = $_POST['nombre'];
  $apellido = $_GET['apellido'];
  $email = $_POST['email'];
  $password = "admin001";
  $area = $_POST['area'];

  $user_type = "administrator";
 
if(!empty($_FILES['archivo-a-subir']['name']))
{
  
  $target_path = "../subidas/"; 
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
require __DIR__ . '../../../../vendor/autoload.php';
// Use the Configuration class 
//use Cloudinary\Configuration\Configuration;

// Configure an instance of your Cloudinary cloud
Configuration::instance('cloudinary://231262176462779:cJBGwWjzZyhnA_vgWBJKo5b5gSA@dpeovabge?secure=true');

// Use the UploadApi class for uploading assets
//use Cloudinary\Api\Upload\UploadApi;

// Upload the image

$upload = new UploadApi();

 json_encode(
    $upload->upload('../subidas/'.$img, [
        'public_id' => $img,
        'use_filename' => TRUE,
        'overwrite' => TRUE]),
    
);

// Use the AdminApi class for managing assets
//use Cloudinary\Api\Admin\AdminApi;

// Get the asset details
$admin = new AdminApi();

$info = json_encode($admin->asset($img), JSON_PRETTY_PRINT); //Almacena la información de la imagen en la variable

//echo $info; //Imprime la información
//echo ("<hr><br>");
$obj =(json_decode($info));// Convierte la cadena $info a un objeto JSON
//echo ("<hr><br>");
//echo ("<hr><br>");
$photo = $obj->{'secure_url'};// Imprime el campo solicitado

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
    'photo' => ([$img, $photo]),
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
         position: 'top-end',
   icon: 'success',
   title: 'Registro guardado con éxito!',
   showConfirmButton: false,
   timer: 1500
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
            text: 'Ocurrio un error, intentalo nuevamente',
        })     
          </script>
    </body>
    </html>
       <?php
  }

}
*/
?>

<!--This is code to nav-->
<nav style="padding: 10px">
<ul class="nav justify-content-end">
  <li class="nav-item">
    <a href="./showAdministrators.php">
<button type="button" class="btn btn-outline-dark" >Regresar</button>
</a>
  </li>
  
</ul>
</nav>



<!--This is code to Form-->
<div class="container" style="padding:3%; background: #FBFAFA">
<form method="POST" action="../../upload.php" enctype="multipart/form-data">
    <h3>Formulario para el registro de nuevos Administradores:</h3>
    <br>
    <input type="hidden" name="MAX_FILE_SIZE" value="250000" /> 
  <div class="row">
    <div class="col">
        <a>Nombre:</a>
      <input type="text" name="nombre" class="form-control" placeholder="Nombre" required>
    </div>
    <div class="col">
    <a>Apellido:</a>
      <input type="text" name="apellido" class="form-control" placeholder="Apellido" required>
    </div>
</div>
<br>

<div class="row">
    <div class="col">
    <a>Numero de empleado:</a>
      <input type="text" name="empleado" class="form-control" placeholder="Numero de empleado" required>
    </div>
   
  </div>
<br>

  <div class="form-group">
    <label for="formGroupExampleInput">Correo Electrónico</label>
    <input type="email" class="form-control" name="email" id="formGroupExampleInput" placeholder="Correo Electrónico" required>
  </div>
 <br>

  <div class="row">
  <div class="form-group col-md-4">
      <label for="inputState">Área</label>
      <select id="inputState" name="area" class="form-control" required>
        <option selected  required>Choose...</option>
        <option value="recursos_humanos">Recursos Humanos</option>
        <option value="sistemas">Sistemas</option>
      </select>
    </div>
  </div>
<br>

 

  <div class="row">
  <div class="col">
    <a>Fotografía:</a>
    <input name="archivo-a-subir" type="file"/>
    </div>
</div>
<br>

<button type="submit" name="guardar" class="btn btn-outline-success">Guardar</button>
</form>
</div>


<?php
/*
$datos = json_decode(file_get_contents("https://REST-API.joseramonhernan.repl.co/collaborators"), true);
print_r ($datos);
*/
?>
</body>
</html>