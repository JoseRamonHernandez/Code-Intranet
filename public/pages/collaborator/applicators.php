<?php

function exception_error_handler($errno, $errstr, $errfile, $errline)
{
    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
}

set_error_handler("exception_error_handler");

?>

<?php

if(empty($_GET['id']) || empty($_GET['idCollaborator']) || empty($_GET['idVacancie']) || empty($_GET['name_vacancie']))
{
    echo("No hay parametros");
}else{
  

  $id = $_GET['id'];
    $idCollaborator = $_GET['idCollaborator'];
    $idVacancie = $_GET['idVacancie'];
    $name_vacancie = $_GET['name_vacancie'];
    $fecha_actual = date('Y-m-d');

  $aplicadores = json_decode(file_get_contents("http://localhost:3000/findVacancies/$idVacancie"), true);
  $colaborador = json_decode(file_get_contents("http://localhost:3000/collaboratorFind/$id"), true);
    


for($z=0; $z<count($aplicadores); $z++)
{
  if($aplicadores[$z]['number_collaborator'] == $colaborador['numero_empleado'])
  {
    $app = "true";
    #echo $app;
  }elseif($aplicadores[$z]['number_collaborator'] != $colaborador['numero_empleado']){
    $app = "false";
    #echo $app;
  }
}


  if($app == "true")
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
         icon: 'error',
   title: 'Ya te habias postulado para esta vacante.',
   allowOutsideClick: false,
        allosEscapeKey: false,
        allosEnterKey: false,
        stopKeydownPropagation: false,
   showConfirmButton: true,
   confirmButtonText: "Entendido",
   confirmButtonColor: "#1F4566",
}).then((result) => {
  /* Read more about isConfirmed, isDenied below */
  if (result.isConfirmed) {
   
    window.location="./showVacancies.php?id=<?php echo$id;?>" 
  } 
      });
            
       </script>
 </body>
 </html>
    <?php
  }else{

    


    //Se registra en el colaborador la vacante seleccionada
    try{
       //url de la petición
 $url = "http://localhost:3000/vacaniesApplied/$idCollaborator";
 
 //inicializamos el objeto CUrl
 $ch = curl_init($url);
  
 //el json simulamos una petición de un login
 $jsonData = array(
    'name_vacancie' => $name_vacancie,
    'application_date' => $fecha_actual
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
         icon: 'info',
   title: 'Almacenando registro...',
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
    window.location="./registerApplied.php?id=<?php echo$id;?>&idVacancie=<?php echo$idVacancie;?>"
  }
}).then((result) => {
  /* Read more about handling dismissals below */
  if (result.dismiss === Swal.DismissReason.timer) {
    console.log('I was closed by the timer')
  }
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
         position: 'center',
   icon: 'error',
   title: 'Ocurrio un error durante el proceso, intentalo nuevamente!',
   
   footer: '<span style="color: blue">Comprueba tu conexión a internet.</span>',
   showConfirmButton: true,
   confirmButtonText: 'Close'
}).then((result) => {
window.location="vacantes.php?id=<?php echo$id;?>"
});
            
       </script>
 </body>
 </html>
 <?php
 }

    }catch(Exception $e){
        ?>
        <script>
        window.location="../err.html"
      </script>
      <?php
    }
  }

}

?>