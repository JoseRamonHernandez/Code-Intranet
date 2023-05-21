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


    <title>CLER´S</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    
  </head>
  <body>

  
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand"><h4 style="color:blue">MOSTRAR CLER´S - ÁREA</h4></a>
    <p></p>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item dropdown">
          
       
      </ul>
      <form class="d-flex" role="search" method="GET" action="./showClersArea.php">
        <button class="btn btn-outline-primary" type="submit">Regresar</button>
      </form>
    </div>
  </div>
</nav>


<?php

if(isset($_GET['saveData'])==1)
{
    $area = $_GET['area'];

    $datos = json_decode(file_get_contents("http://localhost:3000/collaboratorArea/$area"), true);

    if(!empty($datos))
    {
        ?>
        
        <div class="container text-center " style="padding-top:20px;">
            <h3>Se muestra listado de todos los colaboradores en el área <?php echo $area; ?></h3>
        
<br>
<div class="table-responsive">
        <table class="table" style="padding-top: 5%;">
  <thead>
    <tr class="table-dark">
      <th scope="col text-center">#</th>
      <th scope="col text-center">Número de empleado</th>
      <th scope="col text-center">Nombre</th>
      <th scope="col text-center">Apellido</th>
      <th scope="col text-center">Proyecto</th>
      <th scope="col text-center">Categoría</th>
      <th scope="col text-center">Cler´s</th>
      <th scope="col text-center">CONVERSIÓN</th>
    </tr>
  </thead>
  <tbody>
        <?php

    for($x=0; $x<count($datos); $x++)
    {
        $z=0;
        $idCollaborator = $datos[$x]['_id'];
        $numberCollaborator = $datos[$x]['numero_empleado'];
        $name = $datos[$x]['name'];
        $lastname = $datos[$x]['lastname'];
        $project = $datos[$x]['project'];

        $countClers = intval($datos[$x]['clers']);

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
 

        echo('
        <tr>
        <th scope="row">'.($x+1).'</th>
        <td>'.$numberCollaborator.'</td>
        <td>'.$name.'</td>
        <td>'.$lastname.'</td>
        <td>'.$project.'</td>
        <td>'.$categorie.'</td>
        <td class="table-dark">'.$countClers.'</td>
        <td class="table-primary">$'.$convertion.'</td>
        </tr>
        ');

        
    }
    ?>
        </tbody>
        </table>
        </div>
        </div>
    <?php
    }else
    {
        ?>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>Swal.fire({
        icon: 'warning',
        title: 'No hay usuarios registrados en esta área.',
        text: 'Regresar a la página anterior.',
        showConfirmButton: true,
        showCancelButton: false,
        confirmButtonText: 'Ok',
        confirmButtonColor: 'blue'
      }).then((result) => {
        if(result.isConfirmed)
        {
            window.location="showClersArea.php"
        }
      })     
      </script>
        <?php
    }
}
else
{
    echo ("No se reciben parámetros.");
}

?>