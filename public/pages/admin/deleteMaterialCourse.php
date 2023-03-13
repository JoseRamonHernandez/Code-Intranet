<?php

if(!empty(isset($_GET['nameCourse'])) && !empty(isset($_GET['idMaterial']))  && !empty(isset($_GET['idCourse']))  && !empty(isset($_GET['idCategorie']))  && !empty(isset($_GET['nameCategorie'])))
{

    $nameCourse = $_GET['nameCourse'];
    $nameCategorie = $_GET['nameCategorie'];
    $idCategorie = $_GET['idCategorie'];
    $idCourse = $_GET['idCourse'];
    $idMaterial = $_GET['idMaterial'];

    ?>

<!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>deleteMaterial</title>
            
                <script src="sweetalert2.min.js"></script>
            <link rel="stylesheet" href="sweetalert2.min.css">
            
            </head>
            <body>
                
            
                <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>Swal.fire({
                    title: 'Seguro que quieres eliminar el Material',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonText: 'Si, Eliminar',
                    confirmButtonColor: '#E11515',
                    denyButtonText: 'Cancelar'
                    
                  }).then((result) => {
              /* Read more about isConfirmed, isDenied below */
              if (result.isConfirmed) {
               
                window.location="./deleteMaterialCoursesAnswer.php?nameCourse=<?php echo$nameCourse; ?>&idCourse=<?php echo$idCourse; ?>&idCategorie=<?php echo$idCategorie; ?>&nameCategorie=<?php echo$nameCategorie; ?>&idMaterial=<?php echo$idMaterial; ?>" 
              }else{
                window.location="./selectCourses.php?nameCourse=<?php echo$nameCourse; ?>&idCourse=<?php echo$idCourse; ?>&idCategorie=<?php echo$idCategorie; ?>&nameCategorie=<?php echo$nameCategorie; ?>"
              } 
                  });  
                  </script>

<?php

}else{
    echo("No se reciben parametros");
}