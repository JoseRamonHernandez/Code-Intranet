<?php
function exception_error_handler($errno, $errstr, $errfile, $errline)
{
    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
}

set_error_handler("exception_error_handler");

require_once "../poo/clases.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avisos</title>

    <script src="sweetalert2.min.js"></script>
<link rel="stylesheet" href="sweetalert2.min.css">

</head>
<body>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <?php
if(empty($_GET['id']))

{
  ?>
  <script> window.location="../err.html"; </script>
  <?php
}
else{
  $id = $_GET['id'];
     try{   
    $datos = json_decode(file_get_contents("http://localhost:3000/findAlertByStatus/true"), true);
   // echo ("acceso concedido");
   
   $login = new login;
   $count=count($datos);
   //echo("cantidad del arreglo: ".$count."<br>");
   $x=0; 
  ?>
  <script>(async() => {
  <?php
    do{

      $level = $datos[$x]['level'];
      if($datos[$x]['level'] == "info2")
      {
        $level = "success";
      }
?>

await Swal.fire({
      icon: '<?php echo$level;?>',
      title: '<?php echo $datos[$x]['title'];?>',
      imageUrl: '../admin/subidasAlerts/<?php echo$datos[$x]['photo'];?>',
      imageWidth: 900,
      imageHeight: 500,
      imageAlt: 'Custom image',
      width: '100%',
      position: 'center',
      showCloseButton: false,
      backdrop: true,
      allowOutsideClick: false,
      allosEscapeKey: false,
      allosEnterKey: false,
      stopKeydownPropagation: false,
      showCancelButton: false,
      confirmButtonColor: '#3085d6',
      confirmButtonText: 'Close'
}).then((result) => {
if (result.isConfirmed) {
 
<?php
$x++;
?>
}else{}
});

<?php
      
}while($x < $count)

?>
window.location="./home.php?_id=<?php echo$id;?>"
 })()
 
 </script>

  <?php

   /*

 <script>
        (async() => {
   await  Swal.fire({
        icon: 'info',
        title:'titulo',
        text: 'texto',
        showCloseButton: true,
        backdrop: true,
        allowOutsideClick: false,
        allosEscapeKey: false,
        allosEnterKey: false,
        stopKeydownPropagation: false,
        showCancelButton: false,
        showConfirmButton: false,
          });
                
        })()
        </script>
   */

      } catch(Exception $e){
        ?>
 <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>Swal.fire({
        icon: 'error',
        title: 'No hay avisos!',
        text: 'Por el momento no hay registros de avisos y/o no se encuentran activados.',
        showDenyButton: false,
        showCancelButton: false,
        confirmButtonText: 'OK',
        
      }).then((result) => {
  /* Read more about isConfirmed, isDenied below */
  if (result.isConfirmed) {
   
    window.location="./home.php?_id=<?php echo$id;?>" 
  } 
      })     
      </script>
        <?php
       } 
      }
?>



     
</body>
</html>