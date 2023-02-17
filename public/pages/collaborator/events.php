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
<?php
 try{   
    $datos = json_decode(file_get_contents("https://REST-API.joseramonhernan.repl.co/events"), true);
   if($datos)
   {

    for($x=0; $x<count($datos); $x++)
    { 
        ?>
<div class="container border-dark" style="padding-top: 3%; padding:2%;">
        <div class="card text-center border-light" style="background-color: #EBF5FE">
        <div class="card-header">
            Evento# <?php echo$x+1;?>
        </div>
        <div class="card-body">
            <h5 class="card-title"><?php echo $datos[$x]['title'];?></h5>
            <h6 class="card-subtitle"><?php echo $datos[$x]['subtitle'];?></h3>
            <hr>
            <p class="card-text"><?php echo $datos[$x]['text'];?></p>
            <p class="card-text">Fecha: <?php echo $datos[$x]['date'];?></p>
            <p class="card-text">Hora: <?php echo $datos[$x]['time'];?></p>
            <p class="card-text">Lugar: <?php echo $datos[$x]['place'];?></p>
            
        </div>
        <div class="card-footer text-muted">
            Registrado: <?php echo $datos[$x]['createdAt'];?> 
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
<br>
</body>
</html>
<?php
}
?>