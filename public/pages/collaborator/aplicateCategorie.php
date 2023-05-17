<?php

function exception_error_handler($errno, $errstr, $errfile, $errline)
{
    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
}

set_error_handler("exception_error_handler");



if(empty($_GET['idCollaborator']) && empty($_GET['idCategorie']))
{
    echo("No se reciben parametros");
}
else
{
    $idCollaborator = $_GET['idCollaborator'];
    $idCategorie = $_GET['idCategorie'];
    $status = "PENDIENTE";


    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clerprem</title>

    <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">

</head>
<body>
    <?php
    
  //url de la petición
  $url = "http://localhost:3000/createAplicator";
  
  //inicializamos el objeto CUrl
  $ch = curl_init($url);
   
  //el json simulamos una petición de un login
  $jsonData = array(
     'id_collaborator' => $idCollaborator,
     'id_categorie' => $idCategorie,
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

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>Swal.fire({
       icon: 'success',
        title: 'Registro exitoso',
        text: 'Sus datos han sido enviado al personal Administrativo.',
        showConfirmButton: true,
        showCancelButton: false,
      }).then((result) => {
        if(result)
        {
            window.location="ifCategorie.php?idCollaborator=<?php echo$idCollaborator; ?>"
        }
      })
      </script>
    <?php
    
}

    

    

   ?>
</body>
</html>

<?php

}