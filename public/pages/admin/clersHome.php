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
    <a class="navbar-brand"><h4 style="color:blue">CLER´S</h4></a>
    <p></p>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Registrar por
          </a>
          <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="./clersArea.php">Área</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="./clersProyecto.php">Proyecto</a></li>
          </ul>
        </li>
       
      </ul>
      <form class="d-flex" role="search" method="GET" action="./home.php">
        <button class="btn btn-outline-primary" type="submit">Regresar</button>
      </form>
    </div>
  </div>
</nav>

<div class="container" style="padding-top:5%">
    <p>Vista grafica resaltando los valores de Cler´s</p>
</div>

</body>
</html>