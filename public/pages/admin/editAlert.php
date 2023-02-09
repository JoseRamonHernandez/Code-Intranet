<?php

function exception_error_handler($errno, $errstr, $errfile, $errline)
{
    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
}

set_error_handler("exception_error_handler");

?>

<?php

if(!empty($_GET['id']))
{
    $id = $_GET['id'];
    
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    <title>Avisos - Update</title>
</head>
<body >

<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" ></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="position-sticky" id="navbarSupportedContent">
      <form class="d-flex" role="search" method="GET" action="./alert.php">
        <button class="btn btn-outline-primary" type="submit">Regresar</button>
      </form>
    </div>
  </div>
</nav>

<?php

if(isset($_GET['update'])==1)
{
    $newId = $_GET['id'];
    $newTitle = $_GET['title'];
    $newText = $_GET['text'];
    $newStatus = $_GET['status'];

//    echo('id: '.$newId.', title: '.$newTitle.', text: '.$newText.', status: '.$newStatus);

try
 { 
//url de la petición
$url = "https://REST-API.joseramonhernan.repl.co/updateAlert/$newId";
//inicializamos el objeto CUrl
$ch = curl_init($url);
  
//el json simulamos una petición de un login
$jsonData = array(
   'title' => $newTitle,
   'text' => $newText,
   'status' => $newStatus
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
   title: 'Aviso actualizado con éxito!',
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

try{
$datos = json_decode(file_get_contents("https://REST-API.joseramonhernan.repl.co/findAlert/$id"), true);
$title = $datos['title'];
$text = $datos['text'];
$status = $datos['status'];



?>


<div class="container" style="padding: 10px;">
<form  method="GET" action="#">
    <br>
    <h2 class="text-center">Formulario para Actualizar Avisos</h2>
    <br>
    <div class="form-group row">
    <div class="col-sm-5">
      <input type="hidden" name="id" class="form-control form-control-lg" id="colFormLabelLg" value="<?php echo $id;?>" readonly>
    </div>
  </div>
  <br>
  <div class="form-group row">
    <label for="colFormLabelLg" class="col-sm-2 col-form-label col-form-label-lg">Título:</label>
    <div class="col-sm-5">
      <input type="text" name="title" class="form-control form-control-lg" id="colFormLabelLg" value="<?php echo $title;?>" required>
    </div>
  </div>
  <br>
  <div class="form-group row">
    <label for="colFormLabelLg" class="col-sm-2 col-form-label col-form-label-lg">Texto:</label>
    <div class="col-sm-10">
    <input type="text" name="text" class="form-control form-control-lg" id="colFormLabelLg" value="<?php echo $text;?>" required>
    </div>
  </div>
  <br>
  <?php
    if($status == "true"){
        echo ('
        <fieldset class="form-group">
        <div class="row">
          <legend class="col-form-label col-sm-2 pt-0">Status: ACTIVADO</legend>
          <div class="col-sm-10">
            <div class="form-check">
              <input class="form-check-input" name="status" type="radio" name="gridRadios" id="gridRadios1" value="true" required>
              <label class="form-check-label" for="gridRadios1">
                Activado
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" name="status" type="radio" name="gridRadios" id="gridRadios2" value="false" checked required>
              <label class="form-check-label" for="gridRadios2">
                Desactivado
              </label>
            </div>
          </div>
        </div>
      </fieldset>
        ');
    }elseif($status == "false")
    {
        echo ('
        <fieldset class="form-group">
        <div class="row">
          <legend class="col-form-label col-sm-2 pt-0">Status: DESACTIVADO</legend>
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
        ');
    }
  ?>
 
  <br>
  <button type="submit" name="update" class="btn btn-warning  my-1">Update</button>
</form>
</div>
<?php
}catch(Exception $e){
    echo("<h2>Sin Resultados</h2>");
   }
?>
</body>
</html>

<?php
}else
{
    echo("editAlert.php no recibe ningun parametro.");
}


?>