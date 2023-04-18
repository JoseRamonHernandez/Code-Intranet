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

    <title>Delete Question</title>
</head>
<body >

<?php


    if(!empty(isset($_GET['idQuestion'])) && !empty(isset($_GET['nameCourse'])) && !empty(isset($_GET['idCourse'])) && !empty(isset($_GET['idCategorie'])) && !empty(isset($_GET['nameCategorie'])))
    {
    
        $idCourse = $_GET['idCourse'];
        $idCategorie = $_GET['idCategorie'];
        $nameCategorie = $_GET['nameCategorie'];
        $nameCourse = $_GET['nameCourse'];
    
        $idQuestion = $_GET['idQuestion'];

    try
{ 
    $deleteQuestion = json_decode(file_get_contents("http://localhost:3000/$idCategorie/course/$idCourse/question/$idQuestion"), true);

    if($deleteQuestion)
    {
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
         position: 'center',
   icon: 'success',
   title: 'Se elimino la pregunta correctamente!',
   iconColor: '#E61111',
   showConfirmButton: false,
   timer: 1500,
  timerProgressBar: true,
  didOpen: () => {
    Swal.showLoading()
    const b = Swal.getHtmlContainer().querySelector('b')
    timerInterval = setInterval(() => {
      b.textContent = Swal.getTimerLeft()
    }, 100)
  },
  willClose: () => {
    clearInterval(timerInterval)
    window.location="./test.php?idCourse=<?php echo $idCourse;?>&idCategorie=<?php echo $idCategorie;?>&nameCategorie=<?php echo $nameCategorie;?>&nameCourse=<?php echo $nameCourse;?>"
  }
}).then((result) => {
  /* Read more about handling dismissals below */
  if (result.dismiss === Swal.DismissReason.timer) {
    console.log('I was closed by the timer')
  }
       })
       
       
       </script>
 </body>
 </html>

<?php
    }else{
        echo("Error en la consulta");
    }
}catch(Exception $e){
    ?>
    <script>
        window.location="../err.html"
    </script>
    <?php
}

}else{
    echo("No se reciben parametros");
}

?>