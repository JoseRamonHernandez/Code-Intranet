<?php
function exception_error_handler($errno, $errstr, $errfile, $errline)
{
    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
}

set_error_handler("exception_error_handler");

?>



<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

<title>Editar Operaciones</title>
</head>
<body >

<nav class="navbar navbar-expand-lg bg-body-tertiary">
<div class="container-fluid">
<a class="navbar-brand" ></a>
<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
</button>
<div class="position-sticky" id="navbarSupportedContent">
  <form class="d-flex" role="search" method="GET" action="./operations.php">
    <button class="btn btn-outline-primary" type="submit">Regresar</button>
  </form>
</div>
</div>
</nav>



<?php 

if(empty($_GET['idOperation']))
{
    echo ("No se reciben parametros");
}
else
{
    $idOperation = $_GET['idOperation'];

    if(isset($_GET['update']) == 1)
    {
        $idOperation = $_GET['idOperation'];
        $text = $_GET['text'];

        //url de la petición
$url = "https://REST-API.joseramonhernan.repl.co/updateOperation/$idOperation";

//inicializamos el objeto CUrl
$ch = curl_init($url);

//el json simulamos una petición de un login
$jsonData = array(
  'name_of_operation' => $text
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
 title: 'Operación actualizada con éxito!',
 
  showConfirmButton: true,
  confirmButtonColor: '#3085d6',
 confirmButtonText: 'Close'
}).then((result) => {
window.location="operations.php"
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
window.location="operations.php"
});
          
     </script>
</body>
</html>
<?php
    }

}

   $datosOperation = json_decode(file_get_contents("https://REST-API.joseramonhernan.repl.co/getOperation/$idOperation"), true);

   ?>

<div class="container">
    <h3 class="text-center">Formulario para Actualizar de Operaciones</h3>
    <div class="card border-secondary mb-5" style="padding:5%;">
    <form action="#" method="GET">

    <input type="hidden" name="idOperation" value="<?php echo $idOperation; ?>">

    <div class="input-group flex-nowrap ">
    <span class="input-group-text" id="addon-wrapping">Nombre de la operación</span>
    <input type="text" name="text" class="form-control" value="<?php echo $datosOperation['name_of_operation']; ?>" aria-label="Username" aria-describedby="addon-wrapping" required>
    </div>

    <hr>

    <div class="input-group flex-nowrap ">
    <span class="input-group-text" id="addon-wrapping">Proyecto</span>
    <input type="text" name="" class="form-control" value="<?php echo $datosOperation['project']; ?>" aria-label="Username" aria-describedby="addon-wrapping" readonly>
    </div>

    <br>

    <button class="btn btn-warning" name="update">Actualizar</button>
    <br>
</form>

</div>

<?php
 
}
?>