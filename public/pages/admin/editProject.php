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

    <title>Editar Proyectos</title>

    <link href="./style.css" rel="stylesheet" type="text/css" />

</head>
<body>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <div class="position-sticky"><h4>Editar Proyecto Seleccionado</h4></div>
            <form class="d-flex" role="search" method="GET" action="createProject.php">
              <button class="btn btn-outline-primary" name="buscar" type="submit">Regresar</button>
            </form>
          </div>
        </div>
      </nav>

    <!-- Code to Update Register -->
    <?php
    if(isset($_GET['update'])==1)
{
    $newID = $_GET['newID'];
    $name = $_GET['name'];
    $description = $_GET['description'];
    $date_start = $_GET['date_start'];
    $deadline = $_GET['deadline'];
    $authorized_template = $_GET['authorized_template'];


#    echo $name.$description.$date_start.$deadline.$authorized_template;

    try{
        //url de la petición
$url = "https://REST-API.joseramonhernan.repl.co/updateProject/$newID";
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
   title: 'Proyecto actualizado con éxito!',
   showConfirmButton: false,
   timer: 1500,
  timerProgressBar: true,
  iconColor: '#FBFF00',
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




      <!-- Code to Complete Form -->
      <?php

      if(!empty($_GET['id']))
      {
        $id = $_GET['id'];

        try
        {
            $datos = json_decode(file_get_contents("https://REST-API.joseramonhernan.repl.co/findProject/$id"), true);

            ?>

<form class="border-primary" action="#" method="GET">
    <div class="container" style="padding:5px; padding-top:4%;">
    <input type="hidden" name="newID" value="<?php echo$datos['_id'];?>">
    <input type="hidden" name="id" value="<?php echo$id;?>">
  <div class="row ">
    <div class="col">
    <label for="inputEmail4">Nombre:</label>
      <input type="text" name="name" class="form-control" value="<?php echo$datos['name'];?>" required>
    </div>
    <br>
    <div class="col">
    <label for="inputEmail4">Descripción:</label>
      <input type="text" name="description" class="form-control" value="<?php echo$datos['description'];?>" required>
    </div>
  </div>
  <br>

  <div class="row">
    <div class="col">
    <label for="inputEmail4">Fecha de Inicio: </label>
      <input type="date" name="date_start" class="form-control" value="<?php echo$datos['date_start'];?>" required>
    </div>
    <br>
    <div class="col">
    <label for="inputEmail4">Fecha final:</label>
      <input type="date" name="deadline" class="form-control" value="<?php echo$datos['deadline'];?>" required>
    </div>
  </div>
  <br>

  <div class="row">
    <div class="col">
    <label for="inputEmail4">Plantilla autorizada</label>
      <input type="number" name="authorized_template" class="form-control" value="<?php echo$datos['authorized_template'];?>" required>
    </div>
    <br>
    <div class="col">
        <br>
  <button type="submit" name="update" class="btn btn-warning">Actualizar</button>
    </div>
  </div>
  <br>
  </div>
</form>


            <?php

        }catch(Exception $e){
            ?>
                <script>
                window.location="../err.html"
              </script>
              <?php
        }
        }else{
            ?>
                <script>
                window.location="../err.html"
              </script>
              <?php
        }
      ?>

</body>
</html>