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

    <title>Categoria</title>
</head>
<body >
<?php

if(empty(isset($_GET['idCategorie'])) && empty(isset($_GET['nameCategorie'])))
{
    echo("<h2>Sin Resultados</h2>");
}else{

    $idCategorie = $_GET['idCategorie'];
    $nameCategorie = $_GET['nameCategorie'];

    ?>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
   <div class="container" style="cursor: pointer;"><p></p></div>
      <form class="d-flex" role="search" method="GET" action="courses.php">
        <button class="btn btn-outline-primary" name="buscar" type="submit">Regresar</button>
      </form>
    
  </div>
</nav>


<div class="container">
    <h1>Registrar Curso Nuevo</h1>
    <div class="container" style="padding-top:3%;">

        <form method="GET" action="#">

        <input type="hidden" name="idCategorie" value="<?php echo $idCategorie; ?>">
        <input type="hidden" name="nameCategorie" value="<?php echo $nameCategorie; ?>">
            
<div class="mb-3">
  <label for="basic-url" class="form-label">Ingresa Unicamente el nombre del Curso Nuevo</label>
  <div class="input-group">
    <input type="text" name="nameCourse" placeholder="Nombre del Curso" class="form-control" id="basic-url" aria-describedby="basic-addon3" style="background-color: #AEB6BF; color: black;" required>
  </div>
  <br>
  <button type="submit" name="save" class="btn btn-success">Guardar</button>
</div>
        </form>

    </div>
</div>

<?php

if(isset($_GET['save'])==1)
{
    $idCategorie2 = $_GET['idCategorie'];
    $nameCategorie2 = $_GET['nameCategorie'];
    $nameCourse = $_GET['nameCourse'];

    try{

        $url = "https://REST-API.joseramonhernan.repl.co/insertCourse/$idCategorie2";
//inicializamos el objeto CUrl
$ch = curl_init($url);
  
//el json simulamos una petición de un login
$jsonData = array(
   'name_of_course' => $nameCourse
);
 
//creamos el json a partir de nuestro arreglo
$jsonDataEncoded = json_encode($jsonData);
 
//Indicamos que nuestra petición sera Post
curl_setopt($ch, CURLOPT_POST, 1);
 
 //para que la peticion no imprima el resultado como un echo comun, y podamos manipularlo
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 
//Adjuntamos el json a nuestra petición
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
 
//Agregamos los encabezados del contenido
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
 
 //ignorar el certificado, servidor de desarrollo
          //utilicen estas dos lineas si su petición es tipo https y estan en servidor de desarrollo
 //curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
         //curl_setopt($process, CURLOPT_SSL_VERIFYHOST, FALSE);
 
//Ejecutamos la petición
$result = curl_exec($ch);
if($result)
{
    ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Document</title>
 
     <script src="sweetalert2.min.js"></script>
 <link rel="stylesheet" href="sweetalert2.min.css">
 
 </head>
 <body>
     
 
     <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
     <script>Swal.fire({
         
   icon: 'success',
   title: 'Curso Nuevo registrado con éxito!',
   showConfirmButton: false,
   timer: 2000,
  timerProgressBar: true,
  didOpen: () => {
    Swal.showLoading()
    const b = Swal.getHtmlContainer().querySelector('b')
    timerInterval = setInterval(() => {
      b.textContent = Swal.getTimerLeft()
    }, 100)
  },
  willClose: () => {
    clearInterval(timerInterval)
    window.location="./selectCategorie.php?idCategorie=<?php echo $idCategorie2; ?>&nameCategorie=<?php echo $nameCategorie2; ?>"
  }
}).then((result) => {
  /* Read more about handling dismissals below */
  if (result.dismiss === Swal.DismissReason.timer) {
    console.log('I was closed by the timer')
  }
       })
       
       
       </script>
 </body>
 </html>
 <?php

}else{
    ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Document</title>
 
     <script src="sweetalert2.min.js"></script>
 <link rel="stylesheet" href="sweetalert2.min.css">
 
 </head>
 <body>
     
 
     <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
     <script>Swal.fire({
         position: 'top-end',
   icon: 'error',
   title: 'Ocurrio un error durante la acción, intentalo nuevamente',
   footer: '<span style="color: red">Si el error persiste, contacta al desarrollador.</span>',
   showConfirmButton: false,
   timer: 2000
       })     
       </script>
 </body>
 </html>
 <?php

}

    }catch(Exception $e){
        echo("<h3>No se Reciben parametros para Form</h3>");
    }
}

?>

<div class="container" style="padding-top:2.5%;">

<h2 style="center-text">Listado de Cursos sobre la Categoria <?php echo $nameCategorie; ?></h2>

<div class="container">
<table class="table table-info">
<thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nombre del Curso</th>
      <th></th>
      <th></th>
    </tr>
  </thead>
  <tbody>

<?php

    try{
    $courses = json_decode(file_get_contents("https://REST-API.joseramonhernan.repl.co/findCourses/$idCategorie"), true);

    for($x=0; $x<count($courses); $x++)
    {
        $a=$x+1;
        $idCourse = $courses[$x]['_id'];
        $name = $courses[$x]['name_of_course'];

        echo('
        <tr>
      <th scope="row">'.$a.'</th>
      <td>'.$name.'</td>
      <td><a href="" style="text-decoration: none;">Acceder</a></td>
      <td><a href="deleteCategorie.php?idCategorie='.$idCategorie.'&nameCategorie='.$nameCategorie.'&idCourse='.$idCourse.'" style="text-decoration: none; color: red;">Eliminar Curso</a></td>
    </tr>
        ');

    }

}catch(Exception $e)
{
    echo("Error en la consulta");
}

}

?>

</table>
</div>
</div>
</body>
</html>