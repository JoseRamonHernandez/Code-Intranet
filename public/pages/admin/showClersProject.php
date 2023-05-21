<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    <title>CLER´S</title>
</head>
<body >


<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand"><h4 style="color:blue">MOSTRAR CLER´S - PROYECTO</h4></a>
    <p></p>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item dropdown">
          
       
      </ul>
      <form class="d-flex" role="search" method="GET" action="./clersHome.php">
        <button class="btn btn-outline-primary" type="submit">Regresar</button>
      </form>
    </div>
  </div>
</nav>

<?php
// Traer todas los proyectos registradas para mostrarlas
$datos = json_decode(file_get_contents("http://localhost:3000/projects"), true);
?>

<div class="container" style="padding-top:5%">
<h5>Selecciona un proyecto</h5>
    <div class="card border-dark mb-3">
        <div class="container" style="padding-top: 2%">
        <form class="form-control" action="showTableClersProject.php" method="GET">
        <div class="input-group mb-3">
        <select class="form-select card border-secondary mb-3" name="project" id="inputGroupSelect01" required>
            <option selected>Choose...</option>
            <?php

for($x=0; $x<count($datos); $x++)
{ 
echo $datos[$x]['_id'];
?>
<option value="<?php echo $datos[$x]['name'];?>"><?php echo $datos[$x]['name'];?></option>
<?php
}

?>
        </select>
        </div>
        <div class="col mb-3">
            <button class="btn btn-outline-dark" name="saveData">Buscar</button>
        </div>
        </div>
        </form>
        <br>
    </div>
</div>

</body>
</html>