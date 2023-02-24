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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link rel="icon" type="image/png" href="…">


    <title>Update Vacantes</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    
  </head>
  <body>


  <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <div class="position-sticky"><h4>Editar Registro de Vacante</h4></div>
            <form class="d-flex" role="search" method="GET" action="vacantes.php">
              <button class="btn btn-outline-primary" name="buscar" type="submit">Regresar</button>
            </form>
          </div>
        </div>
      </nav>

<?php
if(!empty($_GET['idVacancie']))
{
    $vacancie = $_GET['idVacancie'];

    if(isset($_GET['update'])==1)
    {
        $newId = $_GET['idVacancie'];
        $title = $_GET['title'];
        $description = $_GET['description'];
        $deadline = $_GET['deadline'];
        $area = $_GET['area'];
        $date_register = date('Y-m-d');
       
            //url de la petición
$url = "https://REST-API.joseramonhernan.repl.co/updateVacancies/$newId";
//inicializamos el objeto CUrl
$ch = curl_init($url);
  
//el json simulamos una petición de un login
$jsonData = array(
   'title' => $title,
   'description' => $description,
   'date_register' => $date_register,
   'deadline' => $deadline,
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
         position: 'top-end',
   icon: 'success',
   title: 'Vacante actualizada con éxito!',
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
    window.location="./vacantes.php"
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


       
    }}
    
    try{
        $datos = json_decode(file_get_contents("https://REST-API.joseramonhernan.repl.co/findVacancie/$vacancie"), true);

        if($datos)
        {
            ?>

<div class="container" style=" justify-content: center; padding-top: 3%;">
    <form action="#" method="GET" >
       
    <input type="hidden" name="idVacancie" value="<?php echo $datos['_id'];?>">
        <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputEmail4">Título</label>
              <input type="text" name="title" class="form-control text-center" id="inputEmail4" value="<?php echo$datos['title'];?>" required >
            </div>
           
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputEmail4">Descripción</label>
                <input type="text" name="description" class="form-control text-center" id="inputEmail4" value="<?php echo$datos['description'];?>" required >
            </div>

        <div class="form-row">
                <div class="col-md-4">
                    <label for="inputEmail4">Fecha de Cierre</label>
                    <input type="date" name="deadline" class="form-control text-center" id="inputEmail4" value="<?php echo$datos['deadline'];?>" required >
                </div>
          
            <div class="col-md-4">
              <label for="inputState">Área: <?php echo $datos['area'];?></label>
              <select id="inputState" name="area" class="form-control" required>
                <option selected  required>Choose...</option>
                <option value="costuras">Costuras</option>
                <option value="ensamblado">Ensamblado</option>
                <option value="espuma">Espuma</option>
              </select>
            </div>
           <h5 class="" style="color:blue;">Si se desea cambiar la imagen, se tendrá que eliminar el registro por completo.</h5>
          </div>
         <br>
          <button type="submit" name="update" class="btn btn-warning">Update</button>

    </form>    
    </div>

            <?php
        }else{
            $error_msg("Ocurrio una falla");
            error_log($error_msg);
        }
    }catch(Exception $e){
        ?>
        <script>
        window.location="../err.html"
      </script>
      <?php
    }
}
else{
    echo ("No se Reciben parametros");
}

?>

</body>
</html>