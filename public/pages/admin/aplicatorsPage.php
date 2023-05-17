<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    <title>Aplicaciones</title>

    <link href="./style.css" rel="stylesheet" type="text/css" />

    <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">

</head>
<body>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" >Aplicaciones</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      
        <!--
        <li class="nav-item">
          <a class="nav-link active" aria-curret="page" href="./downloadMatriz.php">Descargar matriz de hábilidades</a>
        </li>
    -->
       
      </ul>
      <form class="d-flex" role="search" method="GET" action="./home.php">
        <button class="btn btn-outline-primary" type="submit">Regresar</button>
      </form>
    </div>
  </div>
</nav>

<div class="container" style="padding-top: 4%; padding_bottom: 5%;">
    <h4 class="text-center">Listado de los colaboradores que solicitan acceso a ciertas categorias</h4>
</div>

<div class="container">
         <div class="table-responsive">
         <table class="table">
<thead>
  <tr>
    <th scope="col">#</th>
    <th scope="col">Numero de Empleado</th>
    <th scope="col">Nombre</th>
    <th scope="col">Apellido</th>
    <th scope="col">Categoria</th>
    <th scope="col">Estatus</th>
    <th scope="col"></th>
    <th scope="col">Acciones</th>
    <th></th>
  </tr>
</thead>
<tbody>
<?php

$aplicators = json_decode(file_get_contents("http://localhost:3000/getAplicators"), true);

if(!empty($aplicators))
{
    for($x=0; $x<count($aplicators); $x++)
    {
        $idSolicitud = $aplicators[$x]['_id'];
        $idCollaboratoRegister = $aplicators[$x]['id_collaborator'];
        $idCategorieRegister = $aplicators[$x]['id_categorie'];
        $estado = $aplicators[$x]['status'];

        $datosCollaborator = json_decode(file_get_contents("http://localhost:3000/collaboratorFind/$idCollaboratoRegister"), true);
        $numero_empleado = $datosCollaborator['numero_empleado'];
        $nameCollaborator = $datosCollaborator['name'];
        $lastnameCollaborator = $datosCollaborator['lastname'];


        $datosCategories = json_decode(file_get_contents("https://REST-API.joseramonhernan.repl.co/findCategorie/$idCategorieRegister"), true);
        $name_of_categorie = $datosCategories['name_of_categorie'];

        echo('
        <tr>
        <th scope="row">'.($x+1).'</th>
        <th scope="row">'.$numero_empleado.'</th>
        <td>'.$nameCollaborator.'</td>
        <td>'.$lastnameCollaborator.'</td>
        <td>'.$name_of_categorie.'</td>
        <td>'.$estado.'</td>
        <td><a class="text-center" href="showAcollaborator.php?numberCollaborator='.$numero_empleado.'" style="text-decoration:none; color:blue;" title="Mostrar Usuario"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
        <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
        </svg></a></td>
        <td><center><a class="text-center" href="deleteAplicator.php?idSolicitud='.$idSolicitud.'" style="color:red;" title="Eliminar Registro"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
        <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
      </svg></a></center></td>
        <td><a class="btn btn-success" href="changeSolicitud.php?id_categorie='.$idCategorieRegister.'&id_collaborator='.$idCollaboratoRegister.'&idSolicitud='.$idSolicitud.'">Cambiar estado</a></td>
        </tr>
        ');
    }

}else{
    echo("Sin resultados");
}

?>
</tbody>
</table>
      </div>
      </div>

    </body>
</html>