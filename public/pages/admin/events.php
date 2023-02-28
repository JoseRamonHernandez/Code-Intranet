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

    <title>Eventos</title>
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
if(isset($_POST['save'])==1)
{


  
  if(!empty($_FILES['archivo-a-subir']['name']))
  {
    
    $target_path = "subidasEvents/"; 
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

    try
    { 
   //url de la petición
   $url = 'https://REST-API.joseramonhernan.repl.co/createEvent';
   //inicializamos el objeto CUrl
   $ch = curl_init($url);
     
   //el json simulamos una petición de un login
   $jsonData = array(
      'title' => $title,
      'photo' => $img
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
      title: 'Evento guardado con éxito!',
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


<br>
<h2 class="text-center">Formulario para el registro de Eventos</h2>


<form class="container" style="padding:3%;" method="POST" action="events.php" enctype="multipart/form-data">

  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-1 col-form-label">Título:</label>
    <div class="col-sm-7">
      <input type="text" class="form-control" id="inputEmail3" name="title" placeholder="Ingresa un título para el Evento." required>
    </div>
  </div>
<br>
  
<div class="form-group row">
    <label for="inputEmail3" class="col-sm-3 col-form-label">Elige la imagen correspondiente</label>
    </div>
    <div class="col-sm-7">
    <input type="file" name="archivo-a-subir" class="form-control form-control-lg"   id="inputEmai10" require>
  </div>


  <br>
  <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" class="btn btn-success" name="save">Save</button>
    </div>
  </div>



</form>

<hr>

<div class="container">
    <ul>
        <li style="">
           <h4 style="color:blue">Desglose de todos los eventos registrados</h4> 
        </li>
    </ul>
<div class="container">

<div class="row">

<?php
try{
        
    $datos = json_decode(file_get_contents("https://REST-API.joseramonhernan.repl.co/events"), true);
   // echo ("acceso concedido");
 
    for($x=0; $x<count($datos); $x++)
    {  
        $id = $datos[$x]['_id'];
       $number = $x+1;
       ?>
       <div class="card mb-2" style="max-width: 750px; border: 0;">
  <div class="row g-0">
    <div class="col-md-4">
      <img src="./subidasEvents/<?php echo$datos[$x]['photo'];?>" class="img-fluid rounded-start" alt="...">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title">Titulo: <?php echo$datos[$x]['title'];?></h5>
        <a href="./deleteEvents.php?id=<?php echo$id;?>" type="button" class="btn btn-outline-danger btn-lg btn-block" style="font-size: 15px;">Eliminar</a>

      </div>
    </div>
  </div>
</div>

     <?php
   
    }
   


}catch(Exception $e){
    echo("<h2>Sin Resultados</h2>");
    echo("<br>");
   }
?>


</div>

</div>
</div>
<br>
</body>
</html>