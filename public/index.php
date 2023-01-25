<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    <title>Intranet</title>
</head>
<body>
      <nav class="navbar bg-body-tertiar">
  <div class="container-fluid">
  <a class="navbar-brand">
            <img src="./img/logo.png" alt="Logo" width="150" height="70" class="d-inline-block align-text-top">
            
          </a>
    <form class="d-flex" role="search" action="./login.php">
      
      <button class="btn btn-outline-primary" type="submit">Iniciar Sesión</button>
    </form>
  </div>
</nav>
<div class="container" style="padding-top: 10px; display: flex;
    align-items: center;
    justify-content: center;
    flex-direction:row;">
<h2>INTRANET</h2>
</div>
<br>
<div clas="" style="margin:0;">
<div class="intranet" style="padding: 3%;">
<h3>Lo que harás.</h3>
<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae laborum ducimus labore necessitatibus maxime deserunt minima facere soluta nobis hic vel, doloribus excepturi sunt! Eligendi fugiat quo quibusdam iusto error?</p>
</div>
</div>

<div class="container" style="padding-top:">
<h2 style=" display: flex;
    align-items: center;
    justify-content: center;
    flex-direction:row;">Los Cumpleañeros de este mes</h2>
<div id="carouselExample" class="carousel slide" style=" ">
  <div class="carousel-inner">
    <div class="carousel-item active" style="top:10px; padding:20%">
      <img src="./img/profile2.jpg" class="d-block w-100" alt="..." >
      <h3 style="color:black">Persona 1</h3>
    </div>
    <div class="carousel-item" style="padding:20%;">
      <img src="./img/profile.jpg" class="d-block w-100" alt="...">
      <h3 style="color:black">Persona 2</h3>
    </div>
    <div class="carousel-item" style="padding:20%;">
      <img src="./img/profile2.jpg" class="d-block w-100" alt="...">
      <h3 style="color:black">Persona 3</h3>
    </div>
    <div class="carousel-item" style="padding:20%;">
      <img src="./img/logo.png" class="d-block w-100" alt="...">
      <h3 style="color:black">Persona 4</h3>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true" style="background-color:black"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true" style="background-color:black"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
</div>


<div style="margin:0;">
<div class="mision" style="padding: 5%; ">
<h3>Misión.</h3>
<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae laborum ducimus labore necessitatibus maxime deserunt minima facere soluta nobis hic vel, doloribus excepturi sunt! Eligendi fugiat quo quibusdam iusto error?</p>
</div>
</div>

<div style="margin:0;">
<div class="vision" style="padding: 5%; margin:0;">
<h3>Visión.</h3>
<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae laborum ducimus labore necessitatibus maxime deserunt minima facere soluta nobis hic vel, doloribus excepturi sunt! Eligendi fugiat quo quibusdam iusto error?</p>
</div>
</div>

<?php
/*
$datos = json_decode(file_get_contents("https://REST-API.joseramonhernan.repl.co/collaborators"), true);
print_r ($datos);
*/
?>


</body>
</html>