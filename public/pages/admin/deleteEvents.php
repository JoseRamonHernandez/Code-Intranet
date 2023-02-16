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
        $datos = json_decode(file_get_contents("https://REST-API.joseramonhernan.repl.co/findEvent/$id"), true);
          $title = $datos['title'];
          $subtitle = $datos['subtitle'];
        //  echo $name;
          $text = $datos['text'];
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
        icon: 'warning',
        title: 'Seguro que quieres eliminar el evento: <?php echo $title;?>',
        text: '<?php echo$text;?>',
        showDenyButton: false,
        showCancelButton: true,
        confirmButtonText: 'Si, Eliminar',
        confirmButtonColor: '#E11515',
        denyButtonText: 'Cancelar'
        
      }).then((result) => {
  /* Read more about isConfirmed, isDenied below */
  if (result.isConfirmed) {
   
    window.location="./deleteEventAnswer.php?id=<?php echo$id;?> " 
  }else{
    window.location="./events.php"
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