<?php

function exception_error_handler($errno, $errstr, $errfile, $errline)
{
    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
}

set_error_handler("exception_error_handler");



if(empty($_GET['idCollaborator']) && empty($_GET['idCategorie']))
{
    echo("No se reciben parametros");
}
else
{

    $idCollaborator = $_GET['idCollaborator'];
    $idCategorie = $_GET['idCategorie'];

    $countCourseCompleted = 0;
    $countCourse = 0;

    $coursesCompleted = json_decode(file_get_contents("http://localhost:3000/$idCollaborator/showCoursesCompleted"), true);

    for ($x=0; $x<count($coursesCompleted); $x++)
        {
           $countCourseCompleted++;

        }

       
   
    $courses = json_decode(file_get_contents("http://localhost:3000/findCourses/$idCategorie"), true);
    for($x=0; $x<count($courses); $x++)
    {
        $countCourse++;
    }
   
    //FALTA VALIDACION SOBRE OPERACIONES REGISTRADAS ::::::::

    /*if($countCourseCompleted == $countCourse)
    {

     $categoriesCompleted = json_decode(file_get_contents("https://REST-API.joseramonhernan.repl.co/$idCollaborator/showCategoriesCompleted"), true);

      if(empty($categoriesCompleted))
      {

      $url = "https://REST-API.joseramonhernan.repl.co/$idCollaborator/categoriesCompleted";

      $ch = curl_init($url);
      
      $jsonData = array(
          'id_categorie' => $idCategorie
      );
      
      $jsonDataEncoded = json_encode($jsonData);
      
      curl_setopt($ch, CURLOPT_POST, 1);
      
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      
      curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
      
      curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
      
      $result = curl_exec($ch);

    }else
    {
      $condicionCategorie = "false";

      for($a=0; $a<count($categoriesCompleted); $a++)
      {
        if($idCategorie == $categoriesCompleted[$a]['id_categorie'])
        {
          $condicionCategorie = "true";
        }
      }

      if($condicionCategorie == "false")
      {
        $url = "https://REST-API.joseramonhernan.repl.co/$idCollaborator/categoriesCompleted";

        $ch = curl_init($url);
        
        $jsonData = array(
            'id_categorie' => $idCategorie
        );
        
        $jsonDataEncoded = json_encode($jsonData);
        
        curl_setopt($ch, CURLOPT_POST, 1);
        
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
        
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        
        $result = curl_exec($ch);
      }
    }
     

    }*/
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
        
         <!-- Link hacia el archivo de estilos css 
         <link rel="stylesheet" href="../collaborator/style/nav.css"> -->
    
         <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
        <title>Cursos</title>
    </head>
    <body>
        
    
    
    
    
          <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">
        <a class="navbar-brand" >CURSOS</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item dropdown">
            </li>
    
          </ul>
          <form class="d-flex" role="search" method="GET" action="showCategories.php">
            <input type="hidden" name="idCollaborator" value="<?php echo $idCollaborator; ?>">
            <button class="btn btn-outline-primary" name="close" type="submit">Regresar</button>
          </form>
        </div>
      </div>
    </nav>

<?php

  $datosCategorie = json_decode(file_get_contents("http://localhost:3000/findCategorie/$idCategorie"), true);
  $nameCategorie = $datosCategorie['name_of_categorie'];
  $background = $datosCategorie['background'];
  $colorText = $datosCategorie['colorText'];

  if($idCategorie == "640665b4f9977e40726ea4a5")
  {
    $coursesCompleted = json_decode(file_get_contents("http://localhost:3000/$idCollaborator/showCoursesCompleted"), true);
    if(empty($coursesCompleted))
    {
      ?>

    <div class="container" style="padding-top: 5%">

<h3 class="text-center">Se muestra el listado de todas los cursos disponibles para la categría <?php echo $nameCategorie; ?>.</h3>

<div class="row row-cols-1 row-cols-md-3 g-4" style="padding-top:4%;">

<?php
      $courses = json_decode(file_get_contents("http://localhost:3000/findCourses/$idCategorie"), true);
      for($x=0; $x<count($courses); $x++)
  {

  $idCourse = $courses[$x]['_id'];
  if($idCourse == "6414910558f2eb23fc70be0b")
  {
    ?>
     <div class="col">
    <div class="card h-100">
      <div class="card-body"  style="background-color: <?php echo $background; ?>; color: <?php echo $colorText; ?>;">
        <h5 class="card-title">Curso <?php echo $x+1; ?>:</h5>
        <p class="card-text"><?php echo $courses[$x]['name_of_course']; ?></p>
      </div>
      <div class="card-footer">
        <a href="materialCourses.php?idCollaborator=<?php echo $idCollaborator;?>&idCategorie=<?php echo $idCategorie;?>&idCourse=<?php echo $idCourse;?>" style="text-decoration: none">
        <button class="btn btn-outline-success">Acceder</button>
        </a>
      </div>
    </div>
  </div>
    <?php
  }
  else
  {
    ?>
     <div class="col">
    <div class="card h-100">
      <div class="card-body"  style="background-color: <?php echo $background; ?>; color: <?php echo $colorText; ?>;">
        <h5 class="card-title">Curso <?php echo $x+1; ?>:</h5>
        <p class="card-text"><?php echo $courses[$x]['name_of_course']; ?></p>
      </div>
      <div class="card-footer">
        <button class="btn btn-success">Acceder</button>
        
      </div>
    </div>
  </div>
    <?php
  }
?>

 
  <?php
  }
    }
    else
    {
      ?>

    <div class="container" style="padding-top: 5%">

<h3 class="text-center">Se muestra el listado de todas los cursos disponibles para la categría <?php echo $nameCategorie; ?>.</h3>

<div class="row row-cols-1 row-cols-md-3 g-4" style="padding-top:4%;">

<?php
      $courses = json_decode(file_get_contents("http://localhost:3000/findCourses/$idCategorie"), true);
      for($x=0; $x<count($courses); $x++)
  {

  $idCourse = $courses[$x]['_id'];
  ?>
  <div class="col">
 <div class="card h-100">
   <div class="card-body"  style="background-color: <?php echo $background; ?>; color: <?php echo $colorText; ?>;">
     <h5 class="card-title">Curso <?php echo $x+1; ?>:</h5>
     <p class="card-text"><?php echo $courses[$x]['name_of_course']; ?></p>
   </div>
   <div class="card-footer">
     <a href="materialCourses.php?idCollaborator=<?php echo $idCollaborator;?>&idCategorie=<?php echo $idCategorie;?>&idCourse=<?php echo $idCourse;?>" style="text-decoration: none">
     <button class="btn btn-outline-success">Acceder</button>
     </a>
   </div>
 </div>
</div>
 <?php

  }
    }
  }
  else{
  
?>

    <div class="container" style="padding-top: 5%">

<h3 class="text-center">Se muestra el listado de todas los cursos disponibles para la categría <?php echo $nameCategorie; ?>.</h3>

<div class="row row-cols-1 row-cols-md-3 g-4" style="padding-top:4%;">

<?php

  $courses = json_decode(file_get_contents("http://localhost:3000/findCourses/$idCategorie"), true);

  for($x=0; $x<count($courses); $x++)
  {

  $idCourse = $courses[$x]['_id'];
?>

  <div class="col">
    <div class="card h-100">
      <div class="card-body"  style="background-color: <?php echo $background; ?>; color: <?php echo $colorText; ?>;">
        <h5 class="card-title">Curso <?php echo $x+1; ?>:</h5>
        <p class="card-text"><?php echo $courses[$x]['name_of_course']; ?></p>
      </div>
      <div class="card-footer">
        <a href="materialCourses.php?idCollaborator=<?php echo $idCollaborator;?>&idCategorie=<?php echo $idCategorie;?>&idCourse=<?php echo $idCourse;?>" style="text-decoration: none">
        <button class="btn btn-outline-success">Acceder</button>
        </a>
      </div>
    </div>
  </div>
 
  <?php
  }
  ?>

</div>

</div>

<?php
  }
}
?>