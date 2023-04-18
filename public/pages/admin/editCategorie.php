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

    <title>Edit Cursos</title>
</head>
<body >


<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
   <div class="container"><p></p></div>
      <form class="d-flex" role="search" method="GET" action="courses.php">
        <button class="btn btn-outline-primary" name="buscar" type="submit">Regresar</button>
      </form>
    
  </div>
</nav>

<?php

if(!empty(isset($_GET['idCategorie'])))
{
    $idCategorie = $_GET['idCategorie'];

    if(isset($_GET['update'])==1)
    {
        $id = $_GET['idCategorie'];
        $nameCategorie = $_GET['name'];
        $description = $_GET['description'];
        $background = $_GET['background'];
        $colorText = $_GET['colorText'];

        try{

            //url de la petición
$url = "http://localhost:3000/updateCategorie/$id";
//inicializamos el objeto CUrl
$ch = curl_init($url);
  
//el json simulamos una petición de un login
$jsonData = array(
   'name_of_categorie' => $nameCategorie,
   'description' => $description,
   'background' => $background,
   'colorText' => $colorText
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
   title: 'Categoria actualizado con éxito!',
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
    window.location="./courses.php"
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

        }catch(Exception $e)
        {
            echo("<h3>Error al capturar la actualización</h3>");
        }
    }

    try
    {

        $categorie = json_decode(file_get_contents("http://localhost:3000/findCategorie/$idCategorie"), true);

        $id = $categorie['_id'];
        $name = $categorie['name_of_categorie'];
        $description = $categorie['description'];
        $background = $categorie['background'];
        $colorText = $categorie['colorText'];

        ?>

        <div class="container">

        <h3>Formulario para editar Categoria <?php echo $name; ?></h3>

        <form method="GET" action="#">

            <div class="mb-3 row">
            <div class="col-sm-10">
            <input type="hidden" name="idCategorie" value="<?php echo $id; ?>" class="form-control" id="inputPassword">
            </div>
        </div>

            <div class="mb-3 row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Nombre de la categoria</label>
            <div class="col-sm-10">
            <input type="text" name="name" value="<?php echo $name; ?>" class="form-control" id="inputPassword" require>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Descripción</label>
            <div class="col-sm-10">
            <input type="text" name="description" value="<?php echo $description; ?>" class="form-control" id="inputPassword" require>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Color de Fondo</label>
            <div class="col-sm-3">
            <input type="color" name="background" value="<?php echo $background; ?>" class="form-control" id="inputPassword" require>
            </div>
        </div>

        <div class="mb-3 row ">
            <label for="inputPassword" class="col-sm-2 col-form-label">Color de Texto</label>
            <div class="col-sm-3 ">
            <input type="color" name="colorText" value="<?php echo $colorText; ?>" class="form-control" id="inputPassword" require>
            </div>
        </div>

        <button type="submit" name="update" class="btn btn-warning">Actualizar</button>

        </form>

        </div>

        <?php

    }catch(Exception $e)
    {
        echo("<h2>Sin Resultados</h2>");
    }
}

?>


</body>
</html>