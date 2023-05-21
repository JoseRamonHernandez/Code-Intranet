<?php

if(empty($_GET['idCollaborator']))
{
    echo ("Sin parámetros");
}
else
{
    $idCollaborator = $_GET['idCollaborator'];

    $datosCollaborator = json_decode(file_get_contents("http://localhost:3000/collaboratorFind/$idCollaborator"), true);
    $numberCollaborator = $datosCollaborator['numero_empleado'];
    ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    <title>Cursos</title>
</head>
<body >

<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" ></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="position-sticky" id="navbarSupportedContent">
      <form class="d-flex" role="search" method="GET" action="./showAcollaborator.php">
        <input type="hidden" value="<?php echo $numberCollaborator; ?>" name="numberCollaborator">
        <button class="btn btn-outline-primary" type="submit">Regresar</button>
      </form>
    </div>
  </div>
</nav>

<div class="container">
    <h4 style="color: black;">Listado de Cursos aprobados.</h4>
    <br>

    <div class="table-responsive">
         <table class="table table-dark">
<thead>
  <tr>
    <th scope="col" class="text-center">Categoría</th>
    <th scope="col" class="text-center">Nombre del curso</th>
    <th scope="col" class="text-center">Calificación obtenida</th>
  </tr>
</thead>
<tbody>

<?php

$courses = json_decode(file_get_contents("http://localhost:3000/$idCollaborator/showCoursesCompleted"), true);

for($x=0; $x<count($courses); $x++)
{
    $idCategorie = $courses[$x]['idCategorie'];
    $idCourse = $courses[$x]['id_course'];
    $califCourse = $courses[$x]['calf'];

    $datosCategorie = json_decode(file_get_contents("http://localhost:3000/findCategorie/$idCategorie"), true);
    $nameCategorie = $datosCategorie['name_of_categorie'];

    $datosCourse = json_decode(file_get_contents("http://localhost:3000/$idCategorie/curso/$idCourse"), true);
    $name_of_course = $datosCourse['curso']['name_of_course'];

    if($datosCategorie || empty($datosCategorie))
    {
      /*
    for($a=0; $a<count($datosCategorie); $a++)
    {
        if($idCourse == $datosCategorie[$a]['_id'])
        {
            $nameCourse = $datosCategorie[$a]['name_of_course'];
        }
        else
        {
            $nameCourse = "NULL";
        }
    }
    */

    echo('

  <tr>
    <th scope="row" class="text-center">'.$nameCategorie.'</th>
    <td class="text-center">'.$name_of_course.'</td>
    <td class="text-center">'.$califCourse.'%</td>
    </tr>');

  }else
  {
    echo("Sin resultados");
  }
}

?>
</tbody>
</table>
      </div>
</div>
<?php


?>
    <?php
}

?>