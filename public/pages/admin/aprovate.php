<?php

if(empty($_GET['id_categorie']) && empty($_GET['idSolicitud']) && empty($_GET['id_collaborator']))
{
    echo ("No se reciben parámetros");
}
else
{
    $id_categorie = $_GET['id_categorie'];
    $idSolicitud = $_GET['idSolicitud'];
    $id_collaborator = $_GET['id_collaborator'];

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



</body>
</html>

<?php
//url de la petición
  $url = "http://localhost:3000/$id_collaborator/categoriesCompleted";
  
  //inicializamos el objeto CUrl
  $ch = curl_init($url);
   
  //el json simulamos una petición de un login
  $jsonData = array(
     'id_categorie' => $id_categorie
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
    ?><script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
            Swal.fire({
                icon: 'success',
                title: 'Permiso otorgado.',
                showCancelButton: false,
                showConfirmButton: true,
                confirmButtonText: 'Enterado',
                confirmButtonColor: "blue",
            }).then ((res) => {
                if(res)
                {
                    window.location="updateSolicitud.php?idSolicitud=<?php echo $idSolicitud; ?>&status=APROBADO";
                }
            })
            </script>
    <?php
  }

}
  ?>