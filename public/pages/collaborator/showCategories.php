<?php

function exception_error_handler($errno, $errstr, $errfile, $errline)
{
    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
}

set_error_handler("exception_error_handler");



if(empty($_GET['idCollaborator']))
{
    echo("No se reciben parametros");
}
else
{

    $idCollaborator = $_GET['idCollaborator'];
    //echo $idCollaborator;

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
    
        <title>Categorías</title>
    </head>
    <body>
        
    
    
    
    
          <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">
        <a class="navbar-brand" >CATEGORÍAS</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item dropdown">
            </li>
    
          </ul>
          <form class="d-flex" role="search" method="GET" action="courses.php">
            <input type="hidden" name="id" value="<?php echo $idCollaborator; ?>">
            <button class="btn btn-outline-primary" name="close" type="submit">Regresar</button>
          </form>
        </div>
      </div>
    </nav>

    <?php

    $categories = json_decode(file_get_contents("https://REST-API.joseramonhernan.repl.co/Categories"), true);

    ?>

    <div class="container" style="padding-top: 5%">

    <h3>Se muestra el listado de todas las categorías disponibles. Accede a una para poder ver sus cursos.</h3>
    <h5>*Recuerda que tendrás acceso a las categorías las cuales cumplas ciertas condiciones.</h5>


    <div class="container" style="padding:5%">

    <div class="row row-cols-1 row-cols-md-2 g-4">

    <?php 

        for($x=0; $x<count($categories); $x++)
        {
            if($categories[$x]['_id'] == "640665b4f9977e40726ea4a5")
            {
    ?>

  <div class="col">
    <div class="card" style="background-color:<?php echo $categories[$x]['background']; ?>; color: <?php echo $categories[$x]['colorText']; ?>;">
    <div class="card-header">Categoría número <?php echo $categories[$x]['level']; ?></div>
      <div class="card-body">
        <h5 class="card-title">Nombre: <?php echo $categories[$x]['name_of_categorie']; ?></h5>
        <p class="card-text">Descripción: <?php echo $categories[$x]['description']; ?></p>
      </div>
      <div class="container">
      <a href="showCourses.php?idCollaborator=<?php echo $idCollaborator; ?>&idCategorie=<?php echo $categories[$x]['_id']; ?>" stlye="text-decoration: none;">
      <button class="btn btn-dark btn-lg" type="submit">Acceder</button>
      </a>
      </div>
      <br>
    </div>
  </div>

  <?php
            }else
            {
                ?>

                <div class="col">
                  <div class="card" style="background-color:<?php echo $categories[$x]['background']; ?>; color: <?php echo $categories[$x]['colorText']; ?>;">
                  <div class="card-header">Categoría número <?php echo $categories[$x]['level']; ?></div>
                    <div class="card-body">
                      <h5 class="card-title">Nombre: <?php echo $categories[$x]['name_of_categorie']; ?></h5>
                      <p class="card-text">Descripción: <?php echo $categories[$x]['description']; ?></p>
                    </div>
                    <div class="container">
                    <button disabled class="btn btn-dark btn-lg">Acceder</button>
                    
                    </div>
                    <br>

                  </div>
                </div>
              
                <?php
            }
        }
    ?>

</div>

    </div>
    </div>

<?php
}
?>