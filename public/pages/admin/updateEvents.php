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

    <title>Eventos - Update</title>
</head>
<body >

<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" ></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="position-sticky" id="navbarSupportedContent">
      <form class="d-flex" role="search" method="GET" action="./events.php">
        <button class="btn btn-outline-secondary" type="submit"><- Eventos</button>
      </form>
    </div>
  </div>
</nav>


<?php
if(isset($_GET['update'])==1)
{
    $newID = $_GET['id'];
    $title = $_GET['title'];
    $subtitle = $_GET['subtitle'];
    $text = $_GET['text'];
    $place = $_GET['place'];
    $date = $_GET['date'];
    $time = $_GET['time'];
   # echo("Haz dado click en update");
   try
 { 
//url de la petición
$url = "https://REST-API.joseramonhernan.repl.co/updateEvent/$newID";
//inicializamos el objeto CUrl
$ch = curl_init($url);
  
//el json simulamos una petición de un login
$jsonData = array(
    'title' => $title,
    'subtitle' => $subtitle,
    'text' => $text,
    'time' => $time,
    'date' => $date,
    'place' => $place
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
         
   icon: 'success',
   title: 'Evento actualizado con éxito!',
   showConfirmButton: false,
   timer: 2000,
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
    window.location="./events.php"
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
   timer: 2000
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


<?php
if(!empty($_GET['id']))
{
$id = $_GET['id'];

try{
    $datos = json_decode(file_get_contents("https://REST-API.joseramonhernan.repl.co/findEvent/$id"), true);
//echo $id;
$newId= $datos['_id'];
$title = $datos['title'];
$subtitle = $datos['subtitle'];
$text = $datos['text'];
$place = $datos['place'];
$date = $datos['date'];
$time = $datos['time'];

//echo $title. $subtitle. $text. $place. $date. $time;
?>
<br>
<h2 class="text-center">Formulario para actualizar Eventos</h2>


<form class="container" style="padding:3%;" method="GET" action="">

<div class="form-group row">
    
    <div class="col-sm-7">
      <input type="hidden" class="form-control" id="inputEmail3" name="id" value="<?php echo$newId;?>" required readonly>
    </div>
  </div>
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-1 col-form-label">Título:</label>
    <div class="col-sm-7">
      <input type="text" class="form-control" id="inputEmail3" name="title" value="<?php echo$title;?>" required>
    </div>
  </div>
<br>
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-1 col-form-label">Subtítulo:</label>
    <div class="col-sm-7">
      <input type="text" class="form-control" id="inputEmail3" name="subtitle" value="<?php echo$subtitle;?>" required>
    </div>
  </div>
<br>
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-1 col-form-label">Texto:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputEmail3" name="text" value="<?php echo$text;?>" required>
    </div>
  </div>
  <br>
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-1 col-form-label">Lugar:</label>
    <div class="col-sm-7">
      <input type="text" class="form-control" id="inputEmail3" name="place" value="<?php echo$place;?>" required>
    </div>
  </div>

<br>
 <div class="form-group row">
    <label for="inputEmail3" class="col-sm-1 col-form-label">Fecha:</label>
    <div class="col-sm-3">
      <input type="date" class="form-control" id="inputEmail3" name="date" value="<?php echo$date;?>" required>
    </div>
    <label for="inputEmail3" class="col-sm-1 col-form-label">Hora:</label>
    <div class="col-sm-3">
      <input type="time" class="form-control" id="inputEmail3" name="time" value="<?php echo$time;?>" required>
    </div>
  </div>

  <br>
  <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" class="btn btn-warning" name="update">Update</button>
    </div>
  </div>



</form>

<?php
}catch(Exception $e){
    echo("<h2>Sin Resultados</h2>");
   }
}else{
    echo("<h2>No se encuentran registros</h2>");
}
?>