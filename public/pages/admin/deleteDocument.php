<?php

function exception_error_handler($errno, $errstr, $errfile, $errline)
{
    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
}

set_error_handler("exception_error_handler");

?>


<?php

if(empty($_GET['idDocument']) && empty($_GET['numberCollaborator']))
{
    echo ("No se reciben parámetros");
}
else
{
    $idDocument = $_GET['idDocument'];
    $numberCollaborator = $_GET['numberCollaborator'];

    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DELETE</title>

    <script src="sweetalert2.min.js"></script>
<link rel="stylesheet" href="sweetalert2.min.css">

</head>
<body>
    

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>Swal.fire({
        title: '¿Seguro que quieres eliminar el documento seleccionado?',
        showDenyButton: false,
        showCancelButton: true,
        confirmButtonText: 'Si, Eliminar',
        confirmButtonColor: '#E11515',
        denyButtonText: 'Cancelar'
        
      }).then((result) => {
  /* Read more about isConfirmed, isDenied below */
  if (result.isConfirmed) {
   
    window.location="./deleteDocumentAnswer.php?idDocument=<?php echo$idDocument;?>&numberCollaborator=<?php echo $numberCollaborator; ?> " 
  }else{
    window.location="./registerDouments.php?numberCollaborator=<?php echo $numberCollaborator; ?>"
  } 
      })     
      </script>
</body>
</html>

    <?php
    
}

?>