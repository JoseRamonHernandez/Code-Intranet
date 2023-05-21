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
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="./clersUser.php">Usuario</a></li>
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Editar por
          </a>
          <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="./EditClersArea.php">Área</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="./EditClersProyecto.php">Proyecto</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="./EditClersUser.php">Usuario</a></li>
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Mostrar por
          </a>
          <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="./showClersArea.php">Área</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="./showClersProject.php">Proyecto</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="./showClersUser.php">Usuario</a></li>
          </ul>
        </li>
       
      </ul>
      <form class="d-flex" role="search" method="GET" action="./home.php">
        <button class="btn btn-outline-primary" type="submit">Regresar</button>
      </form>
    </div>
  </div>
</nav>

<div class="container text-center table-responsive" style="padding-top:5%">

<div class="text-center" style="padding-top: 5%; padding-bottom: 5%;"><h2>Cler´s por CATEGORIAS</h2></div>

    <table class="table table-bordered border-dark">
      <thead>
        <tr>
          <th scope="col" style="background-color: yellow; color: black;">CLER´S</th>
          <th scope="col" style="background-color: black; color: white;">150%</th>
          <th scope="col" style="background-color: green; color: white;">140%</th>
          <th scope="col" style="background-color: red; color: white;">130%</th>
          <th scope="col" style="background-color: blue; color: white;">115%</th>
          <th scope="col" style="background-color: white; color: black;">100%</th>
        </tr>
      </thead>
      <tbody>

      <tr>
        <th scope="row" style="background-color: yellow; color: black;">396</th>
        <td>$594.00</td>
        <td>$554.40</td>
        <td>$514.80</td>
        <td>$455.40</td>
        <td>$396.00</td>
      </tr>

</tboody>
</table>

</div>

</body>
</html>