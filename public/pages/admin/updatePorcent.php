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
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css">
    <title>Actualizar PORCENTAJE</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    
  </head>
  <body>

<?php

if(!empty(isset($_GET['idCollaborator'])) && !empty(isset($_GET['id_operation'])))
    {
        $idCollaborator = $_GET['idCollaborator'];
        $id_operation = $_GET['id_operation'];

        $datosCollaborator = json_decode(file_get_contents("http://localhost:3000/collaboratorFind/$idCollaborator"), true);
        $numberCollaborator = $datosCollaborator['numero_empleado'];

        $datosOperation = json_decode(file_get_contents("http://localhost:3000/findOperation/$id_operation"), true);
        $nameOperation = $datosOperation['name_of_operation'];
        $project = $datosOperation['project'];

        $datos = json_decode(file_get_contents("http://localhost:3000/$idCollaborator/getOPERATIONintoCollaborator/$id_operation"), true);
        $porcent = $datos['porcent'];


        if(isset($_GET['save'])==1)
        {
            $numberCollaborator = $_GET['numberCollaborator'];
            $idCollaborator = $_GET['idCollaborator'];
            $id_operation = $_GET['id_operation'];
            $porcent = $_GET['porcent'];

            if($porcent == 0)
                { 
                    $newPorcent = "0%";
                }elseif($porcent == 1)
                {
                    $newPorcent = "25%";
                }elseif($porcent == 2)
                {
                    $newPorcent = "50%";
                }elseif($porcent == 3)
                {
                    $newPorcent = "75%";
                }elseif($porcent == 4)
                {
                    $newPorcent = "100%";
                }

                //Se hará primero el registro a la coleccion del colaborador

                try
{ 
//url de la petición
$url = "http://localhost:3000/$idCollaborator/operations/$id_operation";




//inicializamos el objeto CUrl
$ch = curl_init($url);

//el json simulamos una petición de un login
$jsonData = array(
  'porcent' => $newPorcent
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
  <script>
    window.location="updatePorcent2.php?id_operation=<?php echo $id_operation; ?>&numberCollaborator=<?php echo $numberCollaborator; ?>&newPorcent=<?php echo $newPorcent; ?>"
  </script>
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
          icon: 'error',
          title: 'Lo sentimos!',
          text: 'Ocurrio un error, intentalo nuevamente',
      })     
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

<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" ></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="position-sticky" id="navbarSupportedContent">
      <form class="d-flex" role="search" method="GET" action="registerOperation.php">
        <input type="hidden" name="numberCollaborator" value="<?php echo $numberCollaborator; ?>">
        <button class="btn btn-outline-secondary" type="submit">Regresar</button>
      </form>
    </div>
  </div>
</nav>

        <div class="container" style="padding-top:5%;">
            <h2>Actualizacion de AVANCE de la operacion: <?php echo $nameOperation; ?> y proyecto: <?php echo $project; ?></h2>
            <hr>

            <form method="GET" action="#">

            <input type="hidden" name="numberCollaborator" value="<?php echo $numberCollaborator; ?>">
            <input type="hidden" name="idCollaborator" value="<?php echo $idCollaborator; ?>">
            <input type="hidden" name="id_operation" value="<?php echo $id_operation; ?>">

            <h4>El registro contiene <?php echo $porcent; ?> de avance ACTUALMENTE</h4>
            <label for="customRange2" class="form-label">Elige el rango (0% - 25% - 50% - 75% - 100%)</label>
            
            <?php 
                if($porcent == "0%")
                {
                    ?>
                    <input type="range" name="porcent" class="form-range card border-dark" value="0" min="0" max="4" id="customRange2" required>
                    <?php
                }elseif($porcent == "25%")
                {
                    ?>
                    <input type="range" name="porcent" class="form-range card border-dark" value="1" min="0" max="4" id="customRange2" required>
                    <?php
                }elseif($porcent == "50%")
                {
                    ?>
                    <input type="range" name="porcent" class="form-range card border-dark" value="2" min="0" max="4" id="customRange2" required>
                    <?php
                }elseif($porcent == "75%")
                {
                    ?>
                    <input type="range" name="porcent" class="form-range card border-dark" value="3" min="0" max="4" id="customRange2" required>
                    <?php
                }elseif($porcent == "100%")
                {
                    ?>
                    <input type="range" name="porcent" class="form-range card border-dark" value="4" min="0" max="4" id="customRange2" required>
                    <?php
                }
            ?>
            
            <br>
            <button type="submit" name="save" class="btn btn-warning">Guardar Cambios</button>
            </form>
        </div>

        <?php
    }else{
        echo("No se reciben parametros");

    }
    ?>

    </html>
</body>