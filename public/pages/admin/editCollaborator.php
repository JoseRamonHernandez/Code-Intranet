
<?php
require_once "../poo/clases.php";

function exception_error_handler($errno, $errstr, $errfile, $errline)
{
    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
}

set_error_handler("exception_error_handler");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    <title>Intranet-Admin</title>
</head>
<body style="background: #A8BFEA">

<!--This is code to nav-->
<nav style="padding: 10px">
<ul class="nav justify-content-end">
  <li class="nav-item">
    <a href="./showCollaborators.php">
<button type="button" class="btn btn-outline-dark" >Regresar</button>
</a>
  </li>
  
</ul>
</nav>
<?php


if(empty($_GET['number']))
        {
            echo ("<h1>Error 404</h1><br><br><h3> document not found</h3>");
        }
        else
        {
            $numberCollaborator = $_GET['number'];

            try{
                $datos = json_decode(file_get_contents("https://REST-API.joseramonhernan.repl.co/collaborator/$numberCollaborator"), true);
                echo('
                
<!--This is code to Form-->
<div class="container" style="padding:3%; background: #FBFAFA">
<form method="GET" action="" class="form" >
    <h3>Formulario para la actualización del Colaborador: '.$datos['name'].'-'.$datos['lastname'].'</h3>
    <br>
    
  <div class="row">
    <div class="col">
        <a>Nombre:</a>
      <input type="text" name="nombre" class="form-control" value="'.$datos['name'].'" required>
    </div>
    <div class="col">
    <a>Apellido:</a>
      <input type="text" name="apellido" class="form-control" value="'.$datos['lastname'].'" required>
    </div>
</div>
<br>

<div class="row">
    <div class="col">
    <a>Numero de empleado:</a>
      <input type="text" name="empleado" class="form-control"value="'.$datos['numero_empleado'].'" disabled>
    </div>
    <div class="col">
    <a>Fecha de Nacimiento: '.$datos['dateofbirthday'].'</a>
      <input type="date" name="date_birthday" class="form-control" placeholder="" required>
    </div>
  </div>
<br>

  <div class="form-group">
    <label for="formGroupExampleInput">Correo Electrónico</label>
    <input type="email" class="form-control" name="email" id="formGroupExampleInput" value="'.$datos['email'].'" required>
  </div>
 <br>

  <div class="row">
  <div class="form-group col-md-4">
      <label for="inputState">Área: '.$datos['area'].'</label>
      <select id="inputState" name="area" class="form-control" required>
        <option selected  required>Choose...</option>
        <option value="costuras">Costuras</option>
        <option value="ensamblado">Ensamblado</option>
        <option value="espuma">Espuma</option>
      </select>
    </div>
    <div class="col">
    <a>Proyecto:</a>
      <input type="text" name="project" class="form-control" value="'.$datos['project'].'" required>
    </div>
    <div class="col">
    <a>Fecha de Ingreso: '.$datos['date_of_register'].'</a>
      <input type="date" name="date_register" class="form-control" placeholder="" required>
    </div>
  </div>
<br>

  <div class="row">
    <div class="col">
    <a>Numero de teléfono:</a>
      <input type="tel" name="number_phone" class="form-control" value="'.$datos['phone_number'].'"  pattern="\([0-9]{3}\) [0-9]{3}[ -][0-9]{4}" title="El valor valido para este campo debe ser como el ejemplo (247) 241 0314 RESPETENADO LOS PARENTESÍS y ESPACIOS" required>
    </div>
    <div class="col">
    <a>Numero de teléfono de emergencia:</a>
      <input type="tel" name="emergency_phone" class="form-control" value="'.$datos['emergency_phone_number'].'"  pattern="\([0-9]{3}\) [0-9]{3}[ -][0-9]{4}" title="El valor valido para este campo debe ser como el ejemplo (247) 241 0314 RESPETENADO LOS PARENTESÍS y ESPACIOS" required>
    </div>
  </div>
  <br>
  <div class="row">
  <div class="col">
    <a>Fotografía: '.$datos['photo'].'</a>
      <input type="file" name="photo" class="form-control" placeholder="">
    </div>
</div>
 
<br>

<button type="submit" name="guardar" class="btn btn-outline-success">Guardar</button>');
                
                } catch(Exception $e){
                   echo ("Error en la consulta a la API");
                   }      


        }
        
        if(isset($_GET['guardar'])==1)
        {
            $empleado = $_GET['empleado'];
            $nombre = $_GET['nombre'];
            $apellido = $_GET['apellido'];
            $date_birthday = $_GET['date_birthday'];
            $email = $_GET['email'];
            $password = "clerprem001";
            $area = $_GET['area'];
            $project = $_GET['project'];
            $date_register = $_GET['date_register'];
            $number_phone = $_GET['number_phone'];
            $emergency_phone = $_GET['emergency_phone'];
            $photo = $_GET['photo'];
            $user_type = "collaborator";
          
            
          
          
            try
            { 
           //url de la petición
           $url = "ttps://REST-API.joseramonhernan.repl.co/collaboratorUpdate/$emplado";
           
           //inicializamos el objeto CUrl
           $ch = curl_init($url);
            
           //el json simulamos una petición de un login
           $jsonData = array(
              'numero_empleado' => $empleado,
              'name' => $nombre,
              'lastname' => $apellido,
              'dateofbirthday' => $date_birthday,
              'email' => $email,
              'password' => $password,
              'area' => $area,
              'project' => $project,
              'date_of_register' => $date_register,
              'phone_number' => $number_phone,
              'emergency_phone_number' => $emergency_phone,
              'photo' => $photo,
              'user_type' => $user_type
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
           $login -> formSucces();
          
            } 
            catch(Exception $e){
             $login -> formFailed();
            }

          }
          



?>

