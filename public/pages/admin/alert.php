<?php
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

    <title>Avisos</title>
</head>
<body >

<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" ></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="position-sticky" id="navbarSupportedContent">
      <form class="d-flex" role="search" method="GET" action="../../login.php">
        <button class="btn btn-outline-primary" type="submit">Home</button>
      </form>
    </div>
  </div>
</nav>

<?php
if(isset($_GET['save'])==1)
{
 $title = $_GET['title'];
 $text = $_GET['text'];
 $status = $_GET['status'];

 try
 { 
//url de la petición
$url = 'https://REST-API.joseramonhernan.repl.co/createAlert';
//inicializamos el objeto CUrl
$ch = curl_init($url);
  
//el json simulamos una petición de un login
$jsonData = array(
   'title' => $title,
   'text' => $text,
   'status' => $status
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
         position: 'top-end',
   icon: 'success',
   title: 'Aviso guardado con éxito!',
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
    window.location="./alert.php"
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

<div class="container" style="padding: 10px;">
<form class="form" method="GET" action="#">
    <h2 class="text-center">Formulario para Registrar Eventos</h2>
  <div class="form-group row">
    <label for="colFormLabelLg" class="col-sm-2 col-form-label col-form-label-lg">Título:</label>
    <div class="col-sm-5">
      <input type="text" name="title" class="form-control form-control-lg" id="colFormLabelLg" placeholder="Título de la NOTIFICACIÓN" required>
    </div>
  </div>
  <div class="form-group row">
    <label for="colFormLabelLg" class="col-sm-2 col-form-label col-form-label-lg">Texto:</label>
    <div class="col-sm-5">
    <textarea class="form-control" name="text" id="exampleFormControlTextarea1" rows="3" required></textarea>
    </div>
  </div>
  <fieldset class="form-group">
    <div class="row">
      <legend class="col-form-label col-sm-2 pt-0">Status:</legend>
      <div class="col-sm-10">
        <div class="form-check">
          <input class="form-check-input" name="status" type="radio" name="gridRadios" id="gridRadios1" value="true" checked required>
          <label class="form-check-label" for="gridRadios1">
            Activado
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" name="status" type="radio" name="gridRadios" id="gridRadios2" value="false" required>
          <label class="form-check-label" for="gridRadios2">
            Desactivado
          </label>
        </div>
      </div>
    </div>
  </fieldset>
  <button type="submit" name="save" class="btn btn-success  my-1">Save</button>
</form>
</div>
<hr>
<div class="container" style="padding:10px;">
<?php
try{
        
    $datos = json_decode(file_get_contents("https://REST-API.joseramonhernan.repl.co/alerts"), true);
   // echo ("acceso concedido");
 
    for($x=0; $x<count($datos); $x++)
    {  
       $number = $x+1;
       if($datos[$x]['status'] == "true")
       {
        $status = "Activado";
       }elseif($datos[$x]['status'] == "false"){
        $status = "Desactivado";
       }
       ?>
       <div class="card">
  <div class="card-header">
    Aviso# <?php echo $number;?>
  </div>
  <div class="card-body">
    <h5 class="card-title">Título: <?php echo $datos[$x]['title'];?></h5>
    <p class="card-text">Texto: <?php echo $datos[$x]['text'];?></p>
    <h6 class="card-subtitle mb-2 text-muted">Status: <?php echo $status;?></h6>
   
    <a href="#" class="btn btn-warning ">Editar</a>
    
    <a href="#" class="btn btn-danger ">Eliminar</a>
   
  </div>
</div>
       <div class="container" style="padding:10px;">
        <hr>
        </div>
     <?php
   
    }
   


}catch(Exception $e){
    echo("<h2>Sin Resultados</h2>");
   }
?>
</div>
</body>
</html>

