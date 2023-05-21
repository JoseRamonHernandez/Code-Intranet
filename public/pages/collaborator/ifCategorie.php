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

    <div class="container">
        <h4>Se muestran todas las categorías, solicita acceso por cada una (recuerda que las categorías llevan un orden)</h4>
    </div>

    <div class="container" style="padding:5%">

    <div class="row row-cols-1 row-cols-md-2 g-4">

<?php

$categories = json_decode(file_get_contents("http://localhost:3000/Categories"), true);

$categoriesApplied = json_decode(file_get_contents("http://localhost:3000/$idCollaborator/showCategoriesCompleted"), true);

if(empty($categoriesApplied))
{
    for($x=0; $x<count($categories); $x++)
      {
        if($categories[$x]['_id'] == '640665b4f9977e40726ea4a5')
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
              <a href="aplicateCategorie.php?idCollaborator=<?php echo $idCollaborator; ?>&idCategorie=<?php echo $categories[$x]['_id']; ?>" stlye="text-decoration: none;">
              <button class="btn btn-dark btn-lg" type="submit">Solicitar Acceso</button>
              </a>
              </div>
              <br>
            </div>
          </div>
        
          <?php
        }
        else
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
              <button class="btn btn-dark btn-lg" type="submit" title="NO TIENE ACCESO">Acceder</button>
              </div>
              <br>
            </div>
          </div>
        
          <?php
        }
        }
      }else
      {
        $z=0;

        for($x=0; $x<count($categoriesApplied); $x++)
        {
            $z++;
        }

        if($z == 1)
        {
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
      }elseif($categories[$x]['_id'] == "640665c2f9977e40726ea4a7")
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
              <a href="aplicateCategorie.php?idCollaborator=<?php echo $idCollaborator; ?>&idCategorie=<?php echo $categories[$x]['_id']; ?>" stlye="text-decoration: none;">
              <button class="btn btn-dark btn-lg" type="submit">Solicitar Acceso</button>
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
            <button class="btn btn-dark btn-lg" type="submit" title="NO TIENE ACCESO">Acceder</button>
            </div>
            <br>
          </div>
        </div>
      
        <?php
      }
    }
}elseif($z == 2)
{
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
      }elseif($categories[$x]['_id'] == "640665c2f9977e40726ea4a7")
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
      }elseif($categories[$x]['_id'] == "64095094a60796eacfda586b")
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
              <a href="aplicateCategorie.php?idCollaborator=<?php echo $idCollaborator; ?>&idCategorie=<?php echo $categories[$x]['_id']; ?>" stlye="text-decoration: none;">
              <button class="btn btn-dark btn-lg" type="submit">Solicitar Acceso</button>
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
            <button class="btn btn-dark btn-lg" type="submit" title="NO TIENE ACCESO">Acceder</button>
            </div>
            <br>
          </div>
        </div>
      
        <?php
      }
    }
}elseif($z == 3)
{
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
        }elseif($categories[$x]['_id'] == "640665c2f9977e40726ea4a7")
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
        }elseif($categories[$x]['_id'] == "64095094a60796eacfda586b")
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
        }elseif($categories[$x]['_id'] == "642b6c2b25ccc6070fe08e6d")
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
                <a href="aplicateCategorie.php?idCollaborator=<?php echo $idCollaborator; ?>&idCategorie=<?php echo $categories[$x]['_id']; ?>" stlye="text-decoration: none;">
                <button class="btn btn-dark btn-lg" type="submit">Solicitar Acceso</button>
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
              <button class="btn btn-dark btn-lg" type="submit" title="NO TIENE ACCESO">Acceder</button>
              </div>
              <br>
            </div>
          </div>
        
          <?php
        } 
    }
}elseif($z == 4)
{
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
        }elseif($categories[$x]['_id'] == "640665c2f9977e40726ea4a7")
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
        }elseif($categories[$x]['_id'] == "64095094a60796eacfda586b")
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
        }elseif($categories[$x]['_id'] == "642b6c2b25ccc6070fe08e6d")
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
        }elseif($categories[$x]['_id'] == "642b6c3825ccc6070fe08e6f")
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
                <a href="aplicateCategorie.php?idCollaborator=<?php echo $idCollaborator; ?>&idCategorie=<?php echo $categories[$x]['_id']; ?>" stlye="text-decoration: none;">
                <button class="btn btn-dark btn-lg" type="submit">Solicitar Acceso</button>
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
              <button class="btn btn-dark btn-lg" type="submit" title="NO TIENE ACCESO">Acceder</button>
              </div>
              <br>
            </div>
          </div>
        
          <?php
        }
    }
}else
{
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
        }elseif($categories[$x]['_id'] == "640665c2f9977e40726ea4a7")
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
        }elseif($categories[$x]['_id'] == "64095094a60796eacfda586b")
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
        }elseif($categories[$x]['_id'] == "642b6c2b25ccc6070fe08e6d")
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
        }elseif($categories[$x]['_id'] == "642b6c3825ccc6070fe08e6f")
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
              <button class="btn btn-dark btn-lg" type="submit" title="NO TIENE ACCESO">Acceder</button>
              </div>
              <br>
            </div>
          </div>
        
          <?php
        }
    }   
}
}

}
?>