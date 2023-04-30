<?php

if(empty($_GET['numberCollaborator']))
{
    echo ("No se reciben parámetros");
}
else
{
    $numberCollaborator = $_GET['numberCollaborator'];
    ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link rel="icon" type="image/png" href="…">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css">
    <title>Documentos Colaborador</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    
  </head>
  <body>

  <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" ></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="position-sticky" id="navbarSupportedContent">
      <form class="d-flex" role="search" method="GET" action="./showAcollaborator.php">
        <input type="hidden" value="<?php echo $numberCollaborator; ?>" name="numberCollaborator">
        <button class="btn btn-outline-primary" type="submit">Regresar</button>
      </form>
    </div>
  </div>
</nav>

<?php

$datosCollaborator = json_decode(file_get_contents("http://localhost:3000/collaborator/$numberCollaborator"), true);

$nameCollaborator = $datosCollaborator['name'];
$lastnameCollaborator = $datosCollaborator['lastname'];
$idCollaborator = $datosCollaborator['_id'];
?>

<div class="container" style="padding: 5%;">

<h2>Formulario para registrar documentos</h2>

<br>

<div class="card text-bg-primary mb-3">

<div class="container" style="padding: 3%;">

    <form method="GET" action="saveDocument.php" class="">

    <input type="hidden" name="idCollaborator" value="<?php echo $idCollaborator; ?>">
    <input type="hidden" name="numberCollaborator" value="<?php echo $numberCollaborator; ?>">

<div class="mb-2">
  <label for="exampleFormControlInput1" class="form-label">Nombre del Documento:</label>
  <input type="text" name="textDocument" class="form-control" id="exampleFormControlInput1" placeholder="Contrato..." required>
</div>

<div class="mb-2">
  <label for="exampleFormControlInput1" class="form-label">URL:</label>
  <input type="text" name="urlDocument" class="form-control" id="exampleFormControlInput1" placeholder="https://google-drive/shared/document..." required>
</div>

<div class="mb-2" style="padding-top: 1rem;">
    <button type="submit" name="save" class="btn btn-success">Guardar</button>
</div>

</form>

</div>

</div>

<br>
<hr>
<h3>Listado de los documentos registrados para el usuario <?php echo $nameCollaborator; echo (" "); echo $lastnameCollaborator; ?></h3>

<?php

$documents = json_decode(file_get_contents("http://localhost:3000/showDocuments/$idCollaborator"), true);

?>

<div class="container" style="padding: 3%;">

<table class="table table-dark">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nombre del Documento</th>
      <th scope="col">URL</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>

  <?php

    for($x=0; $x<count($documents); $x++)
    {
        echo('
        <tr class="table-light">
        <th scope="row">'.($x+1).'</th>
        <td>'.$documents[$x]['text_document'].'</td>
        <td>'.$documents[$x]['url_document'].'</td>
        <td background-color: red;> <a href="deleteDocument.php?idDocument='.$documents[$x]['_id'].'&numberCollaborator='.$numberCollaborator.'" style="text-decoration: none; color: red;" title="ELIMINAR"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
        <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
      </svg></a></td>
      </tr>
        ');
    }

  ?>

  </tbody>
</table>

</div>
</div>

<?php
}


?>