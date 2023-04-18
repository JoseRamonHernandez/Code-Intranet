<?php
function exception_error_handler($errno, $errstr, $errfile, $errline)
{
    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
}

set_error_handler("exception_error_handler");

if(!empty($_GET['idCategorie'])&&!empty($_GET['nameCategorie'])&&!empty($_GET['idCourse']))
{
    $idCategorie = $_GET['idCategorie'];
    $nameCategorie = $_GET['nameCategorie'];
    $idCourse = $_GET['idCourse'];

   try{
        $course = json_decode(file_get_contents("http://localhost:3000/$idCategorie/curso/$idCourse"));
         
        $idCourse2 = $course->curso->_id;
        #echo $id;
        #echo("<br>");
        $nameCourse = $course->curso->name_of_course;
        #echo $nameCourse;
         
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
        title: 'Seguro que quieres eliminar el Curso: ',
        text: '<?php echo $nameCourse;?> de la Categoria: <?php echo $nameCategorie; ?>',
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: 'Si, Eliminar',
        denyButtonText: 'Cancelar'
        
      }).then((result) => {
  /* Read more about isConfirmed, isDenied below */
  if (result.isConfirmed) {
   
    window.location="./deleteCourseAnswer.php?idCourse=<?php echo$idCourse2;?>&idCategorie=<?php echo $idCategorie; ?>&nameCategorie=<?php echo $nameCategorie; ?> " 
  }else{
    window.location="./selectCategorie.php?idCategorie=<?php echo $idCategorie; ?>&nameCategorie=<?php echo $nameCategorie; ?>"
  } 
      })     
      </script>
</body>
</html>
<?php

    }catch(Exception $e)
    {
        ?>
        <script>window.location="../err.html"</script>
        <?php
    }

}else{

    ?>
    <script>window.location="../err.html"</script>
    <?php
}
?>