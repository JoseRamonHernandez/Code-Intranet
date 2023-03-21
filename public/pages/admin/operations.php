<?php
function exception_error_handler($errno, $errstr, $errfile, $errline)
{
    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
}

set_error_handler("exception_error_handler");

?>

<?php 

// Register Operation

if(isset($_GET['save'])==1)
{
   $text = $_GET['text'];
   $project = $_GET['project'];

   
try
{ 
//url de la petición
$url = 'https://REST-API.joseramonhernan.repl.co/newOperation';

//inicializamos el objeto CUrl
$ch = curl_init($url);

//el json simulamos una petición de un login
$jsonData = array(
  'name_of_operation' => $text,
  'project' => $project
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
 title: 'Operación guardada con éxito!',
 
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
}


?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    <title>Operaciones</title>
</head>
<body >

<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" ></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="position-sticky" id="navbarSupportedContent">
      <form class="d-flex" role="search" method="GET" action="./home.php">
        <button class="btn btn-outline-primary" type="submit">Home</button>
      </form>
    </div>
  </div>
</nav>

<?php

$projects = json_decode(file_get_contents("https://REST-API.joseramonhernan.repl.co/projects"), true);


?>
<br>    
<div class="container">
    <h3 class="text-center">Formulario para el registro de Operaciones</h3>
    <div class="card border-secondary mb-5" style="padding:5%;">
    <form action="#" method="GET">

    <div class="input-group flex-nowrap ">
    <span class="input-group-text" id="addon-wrapping">Nombre</span>
    <input type="text" name="text" class="form-control" placeholder="Nombre de la operación" aria-label="Username" aria-describedby="addon-wrapping" required>
    </div>

    <br>

    <div class="input-group mb-3">
    <label class="input-group-text" for="inputGroupSelect01">Proyectos</label>
    <select name="project" class="form-select" id="inputGroupSelect01" required>
    <option selected>Choose...</option>
    <?php 
    for($x=0; $x<count($projects); $x++)
    {
        ?>
        <option value="<?php echo$projects[$x]['name']; ?>"><?php echo$projects[$x]['name']; ?></option>    
        <?php
    }
    ?>
    </select>
    </div>

    <button type="submit" name="save" class="btn btn-success">Registrar Operación</button>

    </form>
    </div>
</div>

<hr>
<hr>

<div class="container">
    <h2 style="color: blue;">Desgloce de Operaciones Registradas</h2>
<br>

<table class="table">
  <thead>
    <tr class="table-primary">
      <th scope="col">#</th>
      <th class="text-center" scope="col">Nombre</th>
      <th class="text-center" scope="col">Proyecto</th>
      <th class="text-center">Personal Registrado</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php

    try{

        $getOperations = json_decode(file_get_contents("https://REST-API.joseramonhernan.repl.co/operations"), true);


        for($a=0; $a<count($getOperations); $a++)
        {
            ?>
             <tr class="table-warning">
      <th scope="row"><?php echo $a+1; ?></th>
      <td class="text-center"><?php echo $getOperations[$a]['name_of_operation']; ?></td>
      <td class="text-center"><?php echo $getOperations[$a]['project']; ?></td>
      <td class="text-center"><a href="showCollaboratorsIntoOperation.php?idOperation=<?php echo $getOperations[$a]['_id']; ?>" style="text-decoration:none; color: ;" title="Acceder"><svg xmlns="http://www.w3.org/2000/svg" width="38" height="38" fill="currentColor" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
  <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
</svg></a></td>
      <td class="text-center"><a href="deleteOperation.php?idOperation=<?php echo $getOperations[$a]['_id']; ?>" style="text-decoration:none; color: #E62F11;" title="Eliminar"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
    <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
  </svg></a></td>
    </tr>
            <?php
        }

    }catch(Exception $e){
        echo ("Error en la consulta");
    }

    ?>
      </tbody>
</table>

</div>