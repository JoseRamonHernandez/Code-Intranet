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

if(!empty(isset($_GET['id_operation'])) && !empty(isset($_GET['numberCollaborator'])) && !empty(isset($_GET['newPorcent'])))
    {
        $id_operation = $_GET['id_operation'];
        $numberCollaborator = $_GET['numberCollaborator'];
        $newPorcent = $_GET['newPorcent'];

        //Actualizamos la coleccion OPERATIONS
        try
        { 
        //url de la petición
        $url = "http://localhost:3000/$id_operation/updatePorcentOPERATION/$numberCollaborator";
        
        
        
        
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
           window.location="registerOperation.php?numberCollaborator=<?php echo $numberCollaborator; ?>"
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
                  text: 'Ocurrio un error, intentalo nuevamente',
              })     
                </script>
          </body>
          </html>
             <?php
        }

    }else{
        ?>
        <script>
            window.location="../err.html"
        </script>
        <?php
    }