<?php
function exception_error_handler($errno, $errstr, $errfile, $errline)
{
    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
}

set_error_handler("exception_error_handler");

if(!empty($_GET['id']))
{
    $id = $_GET['id'];

    try{
        $datos = json_decode(file_get_contents("http://localhost:3000/findAlert/$id"), true);
          $title = $datos['title'];
        //  echo $name;
         
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
        icon: 'question',
        title: 'Seguro que quieres eliminar el aviso: ',
        text: '<?php echo $title;?>',
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: 'Si, Eliminar',
        denyButtonText: 'Cancelar'
        
      }).then((result) => {
  /* Read more about isConfirmed, isDenied below */
  if (result.isConfirmed) {
   
    window.location="./deleteAlertAnswer.php?id=<?php echo$id;?> " 
  }else{
    window.location="./alert.php"
  } 
      })     
      </script>
</body>
</html>
<?php
}catch(Exception $e){
    ?>
    <script>
    window.location="../err.html"
  </script>
  <?php
}
}else{

    ?>
    <script>window.location="./err.html"</script>
    <?php
}
?>