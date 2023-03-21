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

    <title>Eliminar Operaciones</title>

    <link href="./style.css" rel="stylesheet" type="text/css" />

</head>
<body>

<?php

if(!empty($_GET['idOperation']))
      {
        $idOperation = $_GET['idOperation'];

        try
        {
            $datos = json_decode(file_get_contents("https://REST-API.joseramonhernan.repl.co/findOperation/$idOperation"), true);
            $name = $datos['name_of_operation'];
            $project = $datos['project'];
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
                    title: 'Seguro que quieres eliminar la Operación: <?php echo $name;?>',
                    text: 'Proyecto: <?php echo$project;?>',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonText: 'Si, Eliminar',
                    confirmButtonColor: '#E11515',
                    denyButtonText: 'Cancelar'
                    
                  }).then((result) => {
              /* Read more about isConfirmed, isDenied below */
              if (result.isConfirmed) {
               
                window.location="./deleteOperationAnswer.php?idOperation=<?php echo$idOperation;?> " 
              }else{
                window.location="./operations.php"
              } 
                  });  
                  </script>
<?php
        }catch(Exception $e)
        {
            ?>
            <script>
                window.location="../err.html"
            </script>
            <?php
        }
    }else{
        ?>
            <script>
                window.location="../err.html"
            </script>
            <?php
    }

?>

</body>
</html>