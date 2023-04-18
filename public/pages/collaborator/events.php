<?php
function exception_error_handler($errno, $errstr, $errfile, $errline)
{
    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
}

set_error_handler("exception_error_handler");

require_once "../poo/clases.php";

if(empty($_GET['id']))
{
    ?>
    <script> window.location="../err.html"; </script>
    <?php
}else{
$id = $_GET['id'];
#echo $id;

if(!empty($_GET['img2']) && !empty($_GET['id'])) 
{
  $photo = $_GET['img2'];

  $img = "../admin/subidasEvents/$photo";



header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename='.basename($img));
header('Content-Transfer-Encoding: binary');
header('Expires: 0');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Pragma: public');
header('Content-Length: ' . filesize($img));
ob_clean();
flush();
readfile($img);

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Próximos eventos</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    

    <script src="sweetalert2.min.js"></script>
<link rel="stylesheet" href="sweetalert2.min.css">

</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" >EVENTOS CLERPREM</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="position-sticky" id="navbarSupportedContent">
      <form class="d-flex" role="search" method="GET" action="./home.php">
        <input type="hidden" name="_id" value="<?php echo$id;?>"/>
        <button class="btn btn-outline-dark" type="submit">Home</button>
      </form>
    </div>
  </div>
</nav>

<div class="container" style="padding-top: 10px;">
<div class="row row-cols-1 row-cols-md-2 g-4">
<br>
<?php
 try{   
    $datos = json_decode(file_get_contents("http://localhost:3000/events"), true);
   if($datos)
   {

    for($x=0; $x<count($datos); $x++)
    { 
        ?>

  <div class="col">
    <div class="card text-bg-dark">
      <img src="../admin/subidasEvents/<?php echo$datos[$x]['photo'];?>" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title"><?php echo$datos[$x]['title'];?></h5>
        <div class="card-group" style="justify-content: space-between;">

        <a href="events.php?img=<?php echo$datos[$x]['photo'];?>&title=<?php echo$datos[$x]['title'];?>&id=<?php echo$id;?>" style="text-decoration: none; color:white;" title="Ver Evento"><svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
  <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
  <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
</svg></a>

<p style="text-decoration: none; color:white; font-size:30px;"></p>
<p style="text-decoration: none; color:white; font-size:30px;"></p>

        <a href="events.php?img2=<?php echo$datos[$x]['photo'];?>&id=<?php echo$id;?>" style="text-decoration: none; color:white;" title="Descargar Imagen"><svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="currentColor" class="bi bi-cloud-download-fill" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M8 0a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 4.095 0 5.555 0 7.318 0 9.366 1.708 11 3.781 11H7.5V5.5a.5.5 0 0 1 1 0V11h4.188C14.502 11 16 9.57 16 7.773c0-1.636-1.242-2.969-2.834-3.194C12.923 1.999 10.69 0 8 0zm-.354 15.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 14.293V11h-1v3.293l-2.146-2.147a.5.5 0 0 0-.708.708l3 3z"/>
</svg></a>    

        </div>
      </div>
    </div>
  </div>
 
      <?php
    }

   }else{
    ?>
    <script> window.location="../err.html"; </script>
    <?php
   }
} catch(Exception $e){
echo("<h3>Sin registros.</h3>");

} 
?>
</div>
</div>  
<br>
</body>
</html>
<?php

if(!empty($_GET['img']) && !empty($_GET['title']) && !empty($_GET['id']))
{
  $img = $_GET['img'];
  $title = $_GET['title'];
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
        title: '<?php echo $title;?>',
      imageUrl: '../admin/subidasEvents/<?php echo$img;?>',
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
        
      });   
      </script>
</body>
</html>
  <?php
}else{

} 




}
?>