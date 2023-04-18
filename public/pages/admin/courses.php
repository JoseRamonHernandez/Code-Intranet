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

    <title>Cursos</title>
</head>
<body >


<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
   <div class="container"><p></p></div>
      <form class="d-flex" role="search" method="GET" action="home.php">
        <button class="btn btn-outline-primary" name="buscar" type="submit">Regresar</button>
      </form>
    
  </div>
</nav>

<div class="container" style="padding-top:2%;">
    <h2>Categorias Disponibles</h2>
</div>

<div class="container" style="padding-top:3%;">
<div class="container">

<?php

try{

    $categorias = json_decode(file_get_contents("http://localhost:3000/Categories"), true);

    if(empty($categorias)){
        echo("<h1>Sin Resultados</h1>");
    }else{

        for($x=0; $x<count($categorias); $x++)
        {

            ?>

            <div class="card">
            <div class="card-body" style="background-color: <?php echo $categorias[$x]['background']; ?>; color: <?php echo $categorias[$x]['colorText']; ?>;">
                <h5 class="card-title">Nombre de la categoria: <?php echo $categorias[$x]['name_of_categorie']; ?></h5>
                <p class="card-text">Descripción <?php echo $categorias[$x]['description']; ?></p>
                <a href="selectCategorie.php?idCategorie=<?php echo $categorias[$x]['_id'];?>&nameCategorie=<?php echo $categorias[$x]['name_of_categorie']; ?>" class="btn btn-primary">Acceder</a>
                <a href="editCategorie.php?idCategorie=<?php echo $categorias[$x]['_id'];?>" class="btn btn-warning">Editar</a>
            </div>
            </div>
<br>
            <?php

        }

    }

}catch(Exception $e){
    echo("<h1>Sin Resultados</h1>");
}

?>


<br>
</div>
</div>
</body>
</html>