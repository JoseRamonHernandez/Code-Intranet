
<?php

function exception_error_handler($errno, $errstr, $errfile, $errline)
{
    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
}

set_error_handler("exception_error_handler");




?>


<?php

if(empty($_GET['idCollaborator']))
{
    echo("No se reciben parametros aqui");
}else{

    $idCollaborator = $_GET['idCollaborator'];

    //echo $idCollaborator;

    if(isset($_GET['update'])==1)
    {
        $id = $_GET['idCollaborator'];
        $email = $_GET['email'];
        $phone1 = $_GET['number_phone'];
        $phone2 = $_GET['emergency_number_phone'];

        try
        { 
        //url de la petición
        $url = "https://REST-API.joseramonhernan.repl.co/collaboratorUpdate/$id";
        
        
        
        
        //inicializamos el objeto CUrl
        $ch = curl_init($url);
        
        //el json simulamos una petición de un login
        $jsonData = array(
          'email' => $email,
          'phone_number' => $phone1,
          'emergency_phone_number' => $phone2
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
              title: 'Actualización realizada con éxito!',
              
               showConfirmButton: true,
              confirmButtonText: 'Close'
           }).then((result) => {
           window.location="profile.php?idCollaborator=<?php echo $id; ?>"
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
                  text: 'Ocurrio un error, intentalo nuevamente por favor.',
              })     
                </script>
          </body>
          </html>
             <?php
        }

    }

    ?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PROFILE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    
</head>
<body>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" >Datos personales</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item dropdown">
        <p></p>
        </li>
        
      </ul>
      <form class="d-flex" role="search" method="GET" action="profile.php">
        <input type="hidden" name="idCollaborator" value="<?php echo $idCollaborator; ?>">
        <button class="btn btn-outline-primary" name="close" type="submit">Regresar</button>
      </form>
    </div>
  </div>
</nav>

<?php

    $user = json_decode(file_get_contents("https://REST-API.joseramonhernan.repl.co/collaboratorFind/$idCollaborator"), true);

?>

    <div class="container text-center" style="padding: 5%;">

    <h3>Formulario para la edición de tus datos</h3>
    <p>(Tienes acceso a editar tus datos de "Correo Electronico", "Número de Teléfono" y "Número de Teléfono para Emergencias")</p>

    <hr>

    <form class="card border-dark mb-10" action="#" method="GET">
    <br>

    <input type="hidden" name="idCollaborator" value="<?php echo $idCollaborator; ?>">

        <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Correo Electronico:</label>
        <center>
        <div class="col-sm-6">
        <input type="email" name="email" class="form-control text-center card border-secondary mb-10" id="exampleFormControlInput1" value="<?php echo $user['email']; ?>" required>
        </div>
        </center>
        </div>
        
        <div class="mb-3">
        <label for="inputPassword5" class="form-label">Teléfono</label>
        <center>
        <div class="col-sm-6">
        <input type="tel" name="number_phone" class="form-control text-center card border-secondary mb-10" value="<?php echo $user['phone_number']; ?>"  pattern="\([0-9]{3}\) [0-9]{3}[ -][0-9]{4}" title="El valor valido para este campo debe ser (247) 241 0314 RESPETENADO LOS PARENTESÍS y ESPACIOS" required>
        <div id="passwordHelpBlock" class="form-text">
        La actualización de este campo deber ser el formato tal cuál se muestra en los datos ya almacenados
        </div>
        </div>
        </center>
        </div>

        <div class="mb-3">
        <label for="inputPassword5" class="form-label">Teléfono de Emergencia</label>
        <center>
        <div class="col-sm-6">
        <input type="tel" name="emergency_number_phone" class="form-control text-center card border-secondary mb-10" value="<?php echo $user['emergency_phone_number']; ?>"  pattern="\([0-9]{3}\) [0-9]{3}[ -][0-9]{4}" title="El valor valido para este campo debe ser (247) 241 0314 RESPETENADO LOS PARENTESÍS y ESPACIOS" required>
        <div id="passwordHelpBlock" class="form-text">
        La actualización de este campo deber ser el formato tal cuál se muestra en los datos ya almacenados
        </div>
        </div>
        </center>
        </div>

        <p style="color:blue;">Recuerda que a través de estos datos podrán ponerse en contacto contigo, comprueba que la información que ingresas, sea la correcta</p>


        <div class="mb-3">
        <center>
            <button type="submit" name="update" class="btn btn-warning">Actualizar Datos</button>
        </center>
        </div>
    
    </form>

    </div>

<?php
}
?>