<?php

function exception_error_handler($errno, $errstr, $errfile, $errline)
{
    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
}

set_error_handler("exception_error_handler");

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    <title>CLER´S</title>
</head>
<body >


<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand"><h4 style="color:blue">MOSTRAR CLER´S - USUARIO</h4></a>
    <p></p>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item dropdown">
          
       
      </ul>
      <form class="d-flex" role="search" method="GET" action="./clersHome.php">
        <button class="btn btn-outline-primary" type="submit">Regresar</button>
      </form>
    </div>
  </div>
</nav>

<?php

if(isset($_GET['findData'])==1)
{
   $numberCollaborator = $_GET['numberCollaborator'];

   try
   {
       $datosCollaborator = json_decode(file_get_contents("http://localhost:3000/collaborator/$numberCollaborator"), true);
   
        $idCollaborator = $datosCollaborator['_id'];
        $name = $datosCollaborator['name'];
        $lastname = $datosCollaborator['lastname'];
        $area = $datosCollaborator['area'];
        $project = $datosCollaborator['project'];
        $clers = $datosCollaborator['clers'];
        $countClers = intval($clers);
        $z=0;

        /* Codigo para saber a que área pertenece el usuario */
        $categoriesApplied = json_decode(file_get_contents("http://localhost:3000/$idCollaborator/showCategoriesCompleted"), true);

        if(empty($categoriesApplied))
        {
          $z=1;
          $categorie = "WHITE";
        }else{
          for($a=0; $a<count($categoriesApplied); $a++)
          {
            $z++;
          }
        }

       if($z==1)
       {
        $convertion = $countClers * 1;
        $categorie = "WHITE";
       }elseif($z==2)
       {
        $convertion = $countClers * 1.15;
        $categorie = "BLUE";
       }elseif($z==3)
       {
        $convertion = $countClers * 1.30;
        $categorie = "RED";
       }elseif($z==4)
       {
        $convertion = $countClers * 1.40;
        $categorie = "GREEN";
       }elseif($z==5)
       {
        $convertion = $countClers * 1.50;
        $categorie = "BLACK";
       }

        ?>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>Swal.fire({
        icon: 'info',
        title: 'Datos del usuario: <?php echo $numberCollaborator; ?>',
        html: '<p>Nombre: <?php echo $name; ?></p>'+
        '<p>Apellido: <?php echo $lastname; ?></p>'+
        '<p>Área: <?php echo $area; ?></p>'+
        '<p>Proyecto: <?php echo $project; ?></p>'+
        '<p>Categoría: <?php echo $categorie; ?></p>'+
        '<p>Cler´s acumulados: <?php echo $countClers; ?></p>'+
        '<p>Conversión: $<?php echo $convertion; ?></p>',
        showConfirmButton: true,
        showCancelButton: false,
        confirmButtonText: 'Ok',
        confirmButtonColor: 'blue'
      }).then((result) => {
        if(result.isConfirmed)
        {
            window.location="showClersUser.php"
        }
      })     
      </script>
        <?php


    }catch(Exception $e)
   {
    ?>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>Swal.fire({
        icon: 'error',
        title: 'No existe ningún colaborador con el número de empleado ingresado',
        showConfirmButton: true,
        showCancelButton: false,
        confirmButtonText: 'Ok',
        confirmButtonColor: 'blue'
      }).then((result) => {
        if(result.isConfirmed)
        {
            window.location="showClersUser.php"
        }
      })     
      </script>
        <?php
   }


}else
{
    ?>
    <div class="container" style="padding-top:5%">
    <h5>Ingresa el número de empleado</h5>
        <div class="card border-dark mb-3">
            <div class="container" style="padding-top: 2%">
            <form class="form-control" action="#" method="GET">
            Número de empleado
            <div class="form-floating mb-3">
            <input type="text" name="numberCollaborator" class="form-control card border-secondary mb-3" id="floatingInput" placeholder="jsjsjs" required>
            <label for="floatingInput">Ingresa el número de empleado para mostrar sus puntos cler´s</label>
            </div>
            <div class="col mb-3">
                <button class="btn btn-outline-success" name="findData">Buscar</button>
            </div>
            </div>
            </form>
            <br>
        </div>
    </div>
    <?php
}

?>



</body>
</html>