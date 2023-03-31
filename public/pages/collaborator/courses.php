<?php

function exception_error_handler($errno, $errstr, $errfile, $errline)
{
    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
}

set_error_handler("exception_error_handler");



if(empty($_GET['id']))
{
    echo("No se reciben parametros");
}
else
{

    $idCollaborator = $_GET['id'];
    
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
    <a class="navbar-brand" >INTRANET - Cursos</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item dropdown">
        </li>

      </ul>
      <form class="d-flex" role="search" method="GET" action="home.php">
        <input type="hidden" name="_id" value="<?php echo $idCollaborator; ?>">
        <button class="btn btn-outline-primary" name="close" type="submit">Regresar</button>
      </form>
    </div>
  </div>
</nav>

<div class="container" style="padding-top: 5% align-items:center;">

<center>
<img src="../../subidas/logo_clerprem.png"/>


<div class="container" style="padding:3%;">

<h3>Bienvenid@ al módulo de Encuestas</h3>
</center>

<hr>

<h4>INSTRUCCIONES:</h4>
<br>

<div class="container">

<div class="card text-bg-primary mb-6" style="">
  <div class="card-body">
    <h5 class="card-title">Categorías</h5>
    <p class="card-text" style="margin: 10px; padding: 5px;">Este módulo de encuestas trabaja junto a una sección de categorías las cuales tendras acceso dependiendo de tu desempeño en las evaluaciones.</p>
    <ul style="margin: 10px; padding: 5px;">
    <li class="card-text">Si es tu primera vez al ingresar a este módulo, notarás que solo se encontrará habilitada la categoría "WHITE" ya que necesitarás pasar todos los cursos que se encuentren en esta categoría.</li>
    <li class="card-text">Tendrás una vista similar a la siguiente.</li>
    </ul>
  </div>
</div>

<br>

<center>
<img class="card border-dark mb-3" src="./img/categories.png" title="categorías" alt="" height="75%" width="75%">
</center>

<br>
<br>

<div class="card text-bg-success mb-6" style="">
  <div class="card-body">
    <h5 class="card-title">Cursos</h5>
    <p class="card-text" style="margin: 10px; padding: 5px;">Al acceder a la(s) categoría(s) las cuales tengas permitido, notarás que existen varios cursos registrados y, tendrás que tomar y constestar correctamente a las evaluaciones para poder tener acceso a la siguiente categoría.</p>
    <ul style="margin: 10px; padding: 5px;">
    <li class="card-text">Si es tu primera vez al ingresar a este módulo, para la categoría "WHITE" (que es la unica que tendrás habilitada), de todos los cursos, solo podrás acceder al curso "CURSO DE INDUCCIÓN" y al completar este curso tendrás acceso al resto de los curso en la categoría "WHITE".</li>
    <li class="card-text">Tendrás una vista similar a la siguiente.</li>
    </ul>
  </div>
</div>

<br>
<p>--INSERTAR IMAGEN DE VISTA PREVIA A TODOS LOS CURSOS DE LA CATEGORIA WHITE RESALTANDO LA LIMITACIÓN DEL CURSO DE INDUCCIÓN--</p>
<br>

<div class="card text-bg-warning mb-6" style="">
  <div class="card-body">
    <h5 class="card-title">Material</h5>
    <p class="card-text" style="margin: 10px; padding: 5px;">Dentro de cada curso encontrarás materiales de lectura para que los puedas estudiar y poder contestar las evaluaciones sin ningún inconveniente. Cabe recalcar que todos estos "materiales" son de uso confidencial y a la persona que se sorprenda haciendo mal uso de este, será acreedor@ a una sanción de acuerdo al reglamento interno del trabajo de la ley federal del trabajo. </p>
    <ul style="margin: 10px; padding: 5px;">
     <li class="card-text">Tendrás una vista similar a la siguiente.</li>
    </ul>
  </div>
</div>

<br>
<p>--INSERTAR IMAGEN DE VISTA PREVIA A TODOS LOS MATERIALES REGISTRADOS DE UN CURSO--</p>
<br>

<div class="card text-bg-danger mb-6" style="">
  <div class="card-body">
    <h5 class="card-title">Cuestionario</h5>
    <p class="card-text" style="margin: 10px; padding: 5px;">Al acceder a un curso en su apartado de "CUESTIONARIO" se te mostrará todas las preguntas en secuencia de una por una (1x1). Para poder pasar a la siguiente pregunta, primero deberás contestar la pregunta que se te muestra en pantalla para poder avanzar, al finalizar este cuestionario, se te mostrará un mensaje el cuál indicará tu resultado de la evaluación, notificandonte si haz concluido el curso o si necesitas volver a intentarlo. </p>
    <p class="card-text" style="margin: 10px; padding: 5px;">(Es importante tener en cuenta que es necesario acreditar todos los cursos)</p>
    <ul style="margin: 10px; padding: 5px;">
     <li class="card-text">Tendrás una vista similar a la siguiente.</li>
    </ul>
  </div>
</div>

<br>
<p>--INSERTAR IMAGEN DE VISTA PREVIA SOBRE LAS PREGUNTAS DENTRO DEL CURSO--</p>
<br>

<div class="card text-bg-info mb-6" style="">
  <div class="card-body">
    <h5 class="card-title">DATO IMPORTANTE!</h5>
    <p class="card-text" style="margin: 10px; padding: 5px;">Es para tu conocimiento el saber que el tener acceso a la categoría que continua no esta sujeta unicamente a contestar todos los cursos de la categoría anterior, también debes cumplir con otro criterio que es el de las OPERACIONES con las que cuentas, mismas que se mencionan en el apartado de la pagina de tu inicio en "DESARROLLO DE HÁBILIDADES". </p>
    <p class="card-text" style="margin: 10px; padding: 5px;">Esta ultima condición no es la misma para todas las áreas ya que puede llegar a ser diferente el numero de operaciones requeridas, tanto para el usuario, como para la categoría.</p>
    <ul style="margin: 10px; padding: 5px;">
     <li class="card-text">(Da click para conocer este apartado "OPCIONAL").</li>
    </ul>
  </div>
</div>

<br>

<div class="card text-bg-secondary mb-6" style="">
  <div class="card-body">
    <h5 class="card-title text-center">AHORA, YA CONOCES TODA LA INFORMACIÓN NECESARIA. ESTAS LISTO PARA CONTINUAR.</h5>
  </div>
</div>

<br>

<center>
<div class="d-grid gap-4">
<a href="showCategories.php?idCollaborator=<?php echo $idCollaborator; ?>" style="text-decoration: none; color: white;">
  <button class="btn btn-primary" type="submit">IR A LAS CATEGORÍAS</button>
  </a>
</div>
</center>

<br>

</div>

</div>
</div>

<?php
}
?>