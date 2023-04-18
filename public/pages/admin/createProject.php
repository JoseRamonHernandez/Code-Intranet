<?php
require_once "../poo/clases.php";

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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    <title>Proyectos</title>

    <link href="./style.css" rel="stylesheet" type="text/css" />

</head>
<body>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <div class="position-sticky"><h4>Registrar Nuevo Proyecto</h4></div>
            <form class="d-flex" role="search" method="GET" action="home.php">
              <button class="btn btn-outline-primary" name="buscar" type="submit">Regresar</button>
            </form>
          </div>
        </div>
      </nav>

<!-- Code to Register a new Project -->
<?php

if(isset($_GET['save'])==1)
{
    $name = $_GET['name'];
    $description = $_GET['description'];
    $date_start = $_GET['date_start'];
    $deadline = $_GET['deadline'];
    $authorized_template = $_GET['authorized_template'];


#    echo $name.$description.$date_start.$deadline.$authorized_template;

    try{
        //url de la petición
$url = 'http://localhost:3000/createProject';
//inicializamos el objeto CUrl
$ch = curl_init($url);
  
//el json simulamos una petición de un login
$jsonData = array(
   'name' => $name,
   'description' => $description,
   'date_start' => $date_start,
   'deadline' => $deadline,
   'authorized_template' => $authorized_template,
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
   title: 'Proyecto guardado con éxito!',
   showConfirmButton: false,
   timer: 1500,
  timerProgressBar: true,
  didOpen: () => {
    Swal.showLoading()
    const b = Swal.getHtmlContainer().querySelector('b')
    timerInterval = setInterval(() => {
      b.textContent = Swal.getTimerLeft()
    }, 100)
  },
  willClose: () => {
    clearInterval(timerInterval)
    window.location="./createProject.php"
  }
}).then((result) => {
  /* Read more about handling dismissals below */
  if (result.dismiss === Swal.DismissReason.timer) {
    console.log('I was closed by the timer')
  }
       })
       
       
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
         position: 'top-end',
   icon: 'error',
   title: 'Ocurrio un error durante la acción, intentalo nuevamente',
   footer: '<span style="color: red">Si el error persiste, contacta al desarrollador.</span>',
   showConfirmButton: false,
   timer: 1500
       })     
       </script>
 </body>
 </html>
 <?php

}
 } catch(Exception $e){
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
            footer: '<span style="color: red">Si el error persiste, contacta al desarrollador.</span>',
        })     
          </script>
    </body>
    </html>
       <?php
  }
}

?>


<form class="border-primary" action="#" method="GET">
    <div class="container" style="padding:5px; padding-top:4%;">
  <div class="row ">
    <div class="col">
    <label for="inputEmail4">Nombre:</label>
      <input type="text" name="name" class="form-control" placeholder="Nombre del Proyecto" required>
    </div>
    <br>
    <div class="col">
    <label for="inputEmail4">Descripción:</label>
      <input type="text" name="description" class="form-control" placeholder="Descripción del proyecto" required>
    </div>
  </div>
  <br>

  <div class="row">
    <div class="col">
    <label for="inputEmail4">Fecha de Inicio:</label>
      <input type="date" name="date_start" class="form-control" placeholder="First name" required>
    </div>
    <br>
    <div class="col">
    <label for="inputEmail4">Fecha final:</label>
      <input type="date" name="deadline" class="form-control" placeholder="Last name" required>
    </div>
  </div>
  <br>

  <div class="row">
    <div class="col">
    <label for="inputEmail4">Plantilla autorizada</label>
      <input type="number" name="authorized_template" class="form-control" placeholder="Plantilla Autorizada para el proyecto" required>
    </div>
    <br>
    <div class="col">
        <br>
  <button type="submit" name="save" class="btn btn-success">Guardar</button>
    </div>
  </div>
  <br>
  </div>
</form>

<br>
<hr>
<h3 class="container" style="color:blue; padding-top:3%;">Desglose de todos los Proyectos</h3>
<div class="container">


    <?php

    try{

        $datos = json_decode(file_get_contents("http://localhost:3000/projects"), true);
   // echo ("acceso concedido");
 
   ?>
   <div class="table-responsive">
   <table class="table">
<thead>
<tr>
<th scope="col">#</th>
<th scope="col">Nombre</th>
<th scope="col">Descripción</th>
<th scope="col">Fecha de Inicio</th>
<th scope="col">Fecha de Cierre</th>
<th scope="col">Plantilla Autorizada</th>
<th scope="col"></th>
<th scope="col">Acciones</th>
<th scope="col"></th>

</tr>
</thead>
<tbody>
<?php
    for($x=0; $x<count($datos); $x++)
    {   
      $a = $x+1;
echo('

<tr>
<th scope="row">'.$a.'</th>
<td>'.$datos[$x]['name'].'</td>
<td>'.$datos[$x]['description'].'</td>
<td>'.$datos[$x]['date_start'].'</td>
<td>'.$datos[$x]['deadline'].'</td>
<td>'.$datos[$x]['authorized_template'].'</td>
<td><a href="editProject.php?id='.$datos[$x]['_id'].'" style="text-decoration: none; color:black;" title="EDITAR"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
</svg></a></td>
<td></td>
<td><a href="deleteProject.php?id='.$datos[$x]['_id'].'" style="text-decoration: none; color:black;" title="ELIMINAR"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
<path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
</svg></a></td>
</tr>');
    }

    }catch(Exception $e){
        echo("<h2>Sin Registros</h2>");
    }

    ?>


</div>
<br>
</body>
</html>