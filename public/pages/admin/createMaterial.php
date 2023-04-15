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

    <title>Registrar Material</title>
</head>
<body >


<?php

if(!empty(isset($_GET['nameCourse'])) && !empty(isset($_GET['idCourse'])) && !empty(isset($_GET['idCategorie'])) && !empty(isset($_GET['nameCategorie'])))
{

    $idCourse = $_GET['idCourse'];
    $idCategorie = $_GET['idCategorie'];
    $nameCategorie = $_GET['nameCategorie'];
    $nameCourse = $_GET['nameCourse'];

    if(isset($_POST['save']))
    {

        /* The other inputs */
        $idCourse = $_GET['idCourse'];
        $idCategorie = $_GET['idCategorie'];
        $nameCategorie = $_GET['nameCategorie'];
        $nameCourse = $_GET['nameCourse'];

        $extends = $_POST['extends'];

        $urlVideo = $_POST['url'];

        if(empty($_FILES['document']['name']))
    {
        $document = $_POST['nameVideo'];
    }
    else
    {
        
        $target_path = "../documents/"; 
        $target_path = $target_path . basename( $_FILES['document']['name']); 
        if(move_uploaded_file($_FILES['document']['tmp_name'], $target_path)) 
        { 
            $document = $_FILES['document']['name'];
        }else{
            echo("Error al capturar Documento");
        }
    }
        
try
{ 
//url de la petición
$url = "https://REST-API.joseramonhernan.repl.co/$idCategorie/insertMaterial/$idCourse";

$ch = curl_init($url);

$jsonData = array(
  'name' => $document,
  'documentType' => $extends,
  'url' => $urlVideo
);

$jsonDataEncoded = json_encode($jsonData);

curl_setopt($ch, CURLOPT_POST, 1);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);

curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

$result = curl_exec($ch);


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
        position: 'center',
  icon: 'success',
  title: 'Documento guardado con éxito!',
  
});
           
      </script>
</body>
</html>
<?php

 } 
 catch(Exception $e){
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
           icon: 'error',
           title: 'Lo sentimos!',
           text: 'Ocurrio un error, intentalo nuevamente',
       })     
         </script>
  
      <?php
 }
    }



?>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
   <div class="container" style="">
   <p></p>
   </div>
      <form class="d-flex" role="search" method="GET" action="selectCourses.php">
        <input type="hidden" name="idCourse" value="<?php echo $idCourse; ?>">
        <input type="hidden" name="idCategorie" value="<?php echo $idCategorie; ?>">
        <input type="hidden" name="nameCategorie" value="<?php echo $nameCategorie; ?>">
        <input type="hidden" name="nameCourse" value="<?php echo $nameCourse; ?>">
        <button class="btn btn-outline-primary" name="buscar" type="submit">Regresar</button>
      </form>
    
  </div>
</nav>

<br>

<div class="container">
    <h3>
    Formulario para Registrar material para el curso: <?php echo$nameCourse; ?> de la Categoria: <?php echo$nameCategorie; ?>
    </h3>
<br>
    <div class="container">
        <form method="POST" action="#" enctype="multipart/form-data">

        <!-- Inputs type hidden for return-->
        <input type="hidden" name="nameCourse" value="<?php echo $nameCourse; ?>">
        <input type="hidden" name="idCourse" value="<?php echo $idCourse; ?>">
        <input type="hidden" name="idCategorie" value="<?php echo $idCategorie; ?>">
        <input type="hidden" name="nameCategorie" value="<?php echo $nameCategorie; ?>">


        <label for="exampleFormControlInput1" class="form-label">Selecciona la extensión del documento</label>
        <div class="form-check">
        <input class="form-check-input" type="radio" name="extends" id="exampleRadios1" value="PDF" checked>
        <label class="form-check-label" for="exampleRadios1">
        PDF
        </label>
        </div>
        <div class="form-check">
        <input class="form-check-input" type="radio" name="extends" id="exampleRadios2" value="WORD">
        <label class="form-check-label" for="exampleRadios2">
        WORD
        </label>
        </div>
        <div class="form-check">
        <input class="form-check-input" type="radio" name="extends" id="exampleRadios3" value="EXCEL">
        <label class="form-check-label" for="exampleRadios3">
        EXCEL
        </label>
        </div>
        <div class="form-check">
        <input class="form-check-input" type="radio" name="extends" id="exampleRadios3" value="POWER-POINT">
        <label class="form-check-label" for="exampleRadios3">
        POWER POINT
        </label>
        </div>
        <div class="form-check">
        <input class="form-check-input" type="radio" name="extends" id="exampleRadios3" value="VIDEO">
        <label class="form-check-label" for="exampleRadios3">
        VIDEO
        </label>
        </div>

        <hr>

        <div class="container">
        <label for="exampleFormControlInput1" class="form-label">Ingresa el nombre del video <h6 style="color: red;">(SOLO PARA VIDEOS)</h6></label>
        <input type="text" class="form-control" name="nameVideo" id="exampleFormControlInput1" placeholder="INGRESA EL NOMBRE PARA EL VIDEO">  
        </div>

        <div class="container">
        <label for="exampleFormControlInput1" class="form-label">Ingresa el URL del video</h6></label>
        <input type="text" class="form-control" name="url" id="exampleFormControlInput1" placeholder="INGRESA URL DEL VIDEO">  
        </div>
        
        <br>

        <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Selecciona el documento a capturar <h6 style="color: red;">(SOLO PARA DOCUMENTOS)</h6></label>
        <input type="file" class="form-control" name="document" id="exampleFormControlInput1">
        </div>

        <hr>

        <button type="submit" name="save" class="btn btn-success">Guardar</button>

        </form>
    </div>
</div>

<?php
}else{
    echo("<h2>Sin Resultados</h2>");
}

?>

</body>
</html>