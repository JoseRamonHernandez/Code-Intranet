<?php

function exception_error_handler($errno, $errstr, $errfile, $errline)
{
    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
}

set_error_handler("exception_error_handler");

?>

<?php

if(empty($_GET['id']) || empty($_GET['idVacancie']))
{
    echo("No hay parametros");
}else{
    $id = $_GET['id'];
    $idVacancie = $_GET['idVacancie'];


    //Se registra en lavacante el colaborador aplicado
    try{

        $datos = json_decode(file_get_contents("https://REST-API.joseramonhernan.repl.co/findVacancie/$idVacancie"), true);
        $user = json_decode(file_get_contents("https://REST-API.joseramonhernan.repl.co/collaboratorFind/$id"), true);

        $title = $datos['title'];
        $deadline = $datos['deadline'];

        $number_user = $user['numero_empleado'];
        $name_user = $user['name'];
        $area_collaborator = $user['area'];
        $date_applied = date('Y-m-d');

        

        if (date("N", strtotime($deadline)) == 5) {
    $nueva_fecha = date('Y-m-d', strtotime($deadline . ' +3 day'));
    $friday = ('Favor de pasar el dia Lunes '.$nueva_fecha.' con Recursos Humanos para continuar con el proceso en el horario de 13:30 hrs.');
  } elseif (date("N", strtotime($deadline)) == 6) {
    $nueva_fecha = date('Y-m-d', strtotime($deadline . ' +2 day'));
    $friday = ("Favor de pasar el dia Lunes ".$nueva_fecha." con Recursos Humanos para continuar con el proceso en el horario de 13:30 hrs.");
  
  }elseif (date("N", strtotime($deadline)) == 7) {
    $nueva_fecha = date('Y-m-d', strtotime($deadline . ' +1 day'));
    $friday = ("Favor de pasar el dia Lunes ".$nueva_fecha." con Recursos Humanos para continuar con el proceso en el horario de 13:30 hrs.");
  
  }else {
    
    $nueva_fecha = date('Y-m-d', strtotime($deadline . ' +1 day'));
    $friday = ("Favor de pasar el dia ".$nueva_fecha." con Recursos Humanos para continuar con el proceso en el horario de 13:30 hrs.");
  }


       //url de la petición
 $url = "https://REST-API.joseramonhernan.repl.co/registerApplicators/$idVacancie";
 
 //inicializamos el objeto CUrl
 $ch = curl_init($url);
  
 //el json simulamos una petición de un login
 $jsonData = array(
    'number_collaborator' => $number_user,
    'name_collaborator' => $name_user,
    'area_collaborator' => $area_collaborator,
    'date_applied' => $date_applied
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
   title: 'Felicidades haz aplicado para la vacante de <?php echo$title;?>',
   text: '<?php echo$friday;?>',
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
window.location="./showVancaies.php?id=<?php echo$id;?>"
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

?>