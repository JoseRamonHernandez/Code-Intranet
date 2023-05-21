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


<?php

$idCollaborator = $_GET['idCollaborator'];
   try
   {
       $datosCollaborator = json_decode(file_get_contents("http://localhost:3000/collaboratorFind/$idCollaborator"), true);
   
        $idCollaborator = $datosCollaborator['_id'];
        $numberCollaborator = $datosCollaborator['numero_empleado'];
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
        icon: '',
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
            window.location="home.php?_id=<?php echo $idCollaborator; ?>"
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
        title: 'Lo sentimos, ocurrio un error durante el proceso. Intentalo mas tarde.',
        showConfirmButton: true,
        showCancelButton: false,
        confirmButtonText: 'Ok',
        confirmButtonColor: 'blue'
      }).then((result) => {
        if(result.isConfirmed)
        {
            window.location="home.php?_id=<?php echo $idCollaborator; ?>"
        }
      })     
      </script>
        <?php
   }



?>



</body>
</html>