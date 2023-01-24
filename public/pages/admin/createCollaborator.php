<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    <title>Intranet-Admin</title>
</head>
<body>
<nav style="padding: 10px">
<ul class="nav justify-content-end">
  <li class="nav-item">
    <a href="./home.php">
<button type="button" class="btn btn-secondary" >Regresar</button>
</a>
  </li>
  
</ul>
</nav>


<div class="container" style="padding:3%; background: #FBFAFA">
<form method="GET" action="./createCollaborator.php" >
    <h3>Formulario para el registro de nuevos Colaboradores:</h3>
    <br>
  <div class="row">
    <div class="col">
        <a>Nombre:</a>
      <input type="text" name="nombre" class="form-control" placeholder="Nombre" required>
    </div>
    <div class="col">
    <a>Apellido:</a>
      <input type="text" name="apellido" class="form-control" placeholder="Apellido" required>
    </div>
</div>
<br>

<div class="row">
    <div class="col">
    <a>Numero de empleado:</a>
      <input type="text" name="no_emplado" class="form-control" placeholder="Numero de empleado" required>
    </div>
    <div class="col">
    <a>Fecha de Nacimiento:</a>
      <input type="date" name="date_birthday" class="form-control" placeholder="" required>
    </div>
  </div>
<br>

  <div class="form-group">
    <label for="formGroupExampleInput">Correo Electrónico</label>
    <input type="email" class="form-control" name="email" id="formGroupExampleInput" placeholder="Correo Electrónico" required>
  </div>
 <br>

  <div class="row">
  <div class="form-group col-md-4">
      <label for="inputState">Área</label>
      <select id="inputState" class="form-control" required>
        <option selected required>Choose...</option>
        <option value="costuras">Costuras</option>
        <option value="ensamblado">Ensamblado</option>
        <option value="espuma">Espuma</option>
      </select>
    </div>
    <div class="col">
    <a>Proyecto:</a>
      <input type="text" name="project" class="form-control" placeholder="Proyecto" required>
    </div>
    <div class="col">
    <a>Fecha de Ingreso:</a>
      <input type="date" name="date_register" class="form-control" placeholder="" required>
    </div>
  </div>
<br>

  <div class="row">
    <div class="col">
    <a>Numero de teléfono:</a>
      <input type="tel" name="number_phone" class="form-control" placeholder="ejemplo: (247) 247 0312"  pattern="\([0-9]{3}\) [0-9]{3}[ -][0-9]{4}" title="El valor valido para este campo debe ser como el ejemplo (247) 241 0314" required>
    </div>
    <div class="col">
    <a>Numero de teléfono de emergencia:</a>
      <input type="number" name="emergency_phone" class="form-control" placeholder="Numero de teléfono de emergencia" min="8" max="10" required>
    </div>
  </div>
  <br>

  <div class="row">
  <div class="col">
    <a>Fotografía:</a>
      <input type="file" class="form-control" placeholder="">
    </div>
</div>
<br>

<button type="submit" class="btn btn-info">Guardar</button>
</form>
</div>


<?php
/*
$datos = json_decode(file_get_contents("https://REST-API.joseramonhernan.repl.co/collaborators"), true);
print_r ($datos);
*/
?>
</body>
</html>