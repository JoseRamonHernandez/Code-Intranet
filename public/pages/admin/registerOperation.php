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
    <title>Registro Operación</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    
  </head>
  <body>

<?php

if(!empty($_GET['numberCollaborator']))
        {

          $numberCollaborator = $_GET['numberCollaborator'];

          $operations = json_decode(file_get_contents("http://localhost:3000/operations"), true);
        

            if(isset($_GET['saveCollaborator'])==1)
            {
                $numberCollaborator = $_GET['numberCollaborator'];
                $operationID = $_GET['operationID'];
                $porcent = $_GET['porcent'];
                $idCollaborator = $_GET['idCollaborator'];

                $operacion = json_decode(file_get_contents("http://localhost:3000/findOperation/$operationID"), true);
                $project = $operacion['project'];

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

                
try
{ 
//url de la petición
$url = "http://localhost:3000/insertCollaborator/operation/$operationID";

//URL PARA INSERTAR EN EL COLABORADOR
//https://REST-API.joseramonhernan.repl.co/registerOperation/IDCOLLABORATOR
/*
{
    "id_operation": "641909bcaea27ae24cbf67b5",
    "project2": "HINTEN",
    "porcent": "25%"
}
*/

//URL PARA INSERTAR EN LA OPERACION
//https://REST-API.joseramonhernan.repl.co/insertCollaborator/operation/IDOPERATION
/*
{
    "no_collaborator": "611",
    "porcent": "100"
}
*/


//inicializamos el objeto CUrl
$ch = curl_init($url);

//el json simulamos una petición de un login
$jsonData = array(
  'no_collaborator' => $numberCollaborator,
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
    window.location="registerOperationCollaborator.php?operationID=<?php echo $operationID; ?>&idCollaborator=<?php echo $idCollaborator; ?>&project=<?php echo $project; ?>&newPorcent=<?php echo $newPorcent; ?>&numberCollaborator=<?php echo $numberCollaborator; ?>"
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
      <form class="d-flex" role="search" method="GET" action="showAcollaborator.php">
        <input type="hidden" name="numberCollaborator" value="<?php echo $numberCollaborator; ?>">
        <button class="btn btn-outline-secondary" type="submit">Regresar</button>
      </form>
    </div>
  </div>
</nav>
<br>
<div class="container card border-danger mb-3" style="padding: 5%;">
    <br>
    <h2 class="text-center">Registro del colaborador a una Operación</h2>
    <br>

    <?php

    $collaborator = json_decode(file_get_contents("http://localhost:3000/collaborator/$numberCollaborator"), true);
    $idCollaborator = $collaborator['_id'];

    ?>
    <form method="GET" action="#">

    <input type="hidden" name="numberCollaborator" value="<?php echo $numberCollaborator; ?>">
    <input type="hidden" name="idCollaborator" value="<?php echo $idCollaborator; ?>">
    
    <div class="mb-3">
    <label for="exampleFormControlInput1" class="form-label">Operaciones Registradas</label>
    <p>Selecciona UNA</p>
    <select name="operationID" class="form-select" aria-label="Default select example" required>
    <option selected>Open this select menu</option>
    <?php
    for($x=0; $x<count($operations); $x++)
    {
        ?>
            <option value="<?php echo $operations[$x]['_id']; ?>"><?php echo $operations[$x]['name_of_operation']; ?> - <?php echo $operations[$x]['project']; ?></option>
        <?php
    }
    ?>
    </select>
    </div>

    <label for="customRange2" class="form-label">Elige el rango (0% - 25% - 50% - 75% - 100%)</label>
    <h6>Automaticamente se posiciona en 25%</h6>
<input type="range" name="porcent" class="form-range card border-dark" value="1" min="0" max="4" id="customRange2" required>

    <br>
    <button type="submit" name="saveCollaborator" class="btn btn-warning">Guardar Cambios</button>
    </form>



</div>

<div class="container">
    <hr>
    <div class="container">
        <h3>Listado de Operaciones en las que se encuentra Registrado</h3>
        <br>
        <!-- 
           
            Editar su porcentaje
            Eliminar el registro del colaborador en una operacion
        -->

        <?php
        $operations = json_decode(file_get_contents("http://localhost:3000/showAllOperationRegisterINTOCollaborator/$idCollaborator"), true); 
        ?>
        <div class="" style="padding: 5%;">
        <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nombre de la Operación</th>
      <th scope="col">Proyecto</th>
      <th scope="col">Porcentaje</th>
    </tr>
  </thead>
  <tbody>
    <?php
    for($x=0; $x<count($operations); $x++)
    {
      $idOPERATION = $operations[$x]['id_operation'];
        
        $textOperation = json_decode(file_get_contents("http://localhost:3000/findOperation/$idOPERATION"), true);
        $nameOPERATION = $textOperation['name_of_operation'];
        
      ?>
        <tr>
      <th scope="row"><?php echo $x+1; ?></th>
      <td><?php echo $nameOPERATION; ?></td>
      <td><?php echo $operations[$x]['project2']; ?></td>
      <td><?php echo $operations[$x]['porcent']; ?></td>
      <td><a href="updatePorcent.php?idCollaborator=<?php echo $idCollaborator; ?>&id_operation=<?php echo $operations[$x]['id_operation']; ?>" style="text-decoration: none; color: #EDC60D;" title="EDITAR REGISTRO">ACTUALIZAR PORCENTAJE</a></td>
      <td><a href="deleteREGISTERoperation.php?idCollaborator=<?php echo $idCollaborator; ?>&id_operation=<?php echo $operations[$x]['id_operation']; ?>&numberCollaborator=<?php echo $numberCollaborator; ?>" style="text-decoration: none; color: #DD4B25;" title="ELIMINAR REGISTRO">ELIMINAR REGISTRO</a></td>
    </tr>
      <?php
    }
    ?>

</tbody>
</table>
        </div>
    </div>
</div>
<?php
        }else{
            echo ("No se reciben parametros");
        }
        ?>