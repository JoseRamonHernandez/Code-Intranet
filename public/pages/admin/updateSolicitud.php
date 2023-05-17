<?php

if(empty($_GET['idSolicitud']) && empty($_GET['status']))
{
    echo ("No se reciben parámetros");
}
else
{
    $idSolicitud = $_GET['idSolicitud'];
    $status = $_GET['status'];

    //PUT
    //url de la petición
  $url = "http://localhost:3000/updateAplicator/$idSolicitud";
  
  //inicializamos el objeto CUrl
  $ch = curl_init($url);
   
  //el json simulamos una petición de un login
  $jsonData = array(
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

        <script>
            window.location="aplicatorsPage.php"
        </script>

    <?php
  }

}