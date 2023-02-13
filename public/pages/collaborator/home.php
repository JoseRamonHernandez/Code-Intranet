<?php

function exception_error_handler($errno, $errstr, $errfile, $errline)
{
    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
}

set_error_handler("exception_error_handler");




if(empty($_GET['_id']))

{
  ?>
  <script> window.location="../err.html"; </script>
  <?php
}
else{
  $id = $_GET['_id'];

 try{

 

$datos = json_decode(file_get_contents("https://REST-API.joseramonhernan.repl.co/collaboratorFind/$id"), true);
//print_r ($datos);
$password = $datos['password'];


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    
     <!-- Link hacia el archivo de estilos css 
     <link rel="stylesheet" href="../collaborator/style/nav.css"> -->

     <script src="sweetalert2.min.js"></script>
<link rel="stylesheet" href="sweetalert2.min.css">
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>Home</title>
</head>
<body>
    




      <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" >INTRANET</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Acciones
          </a>
          <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="./showCollaborators.php?area=costuras">COSTURAS</a></li>
          <li><a class="dropdown-item" href="#">Documentos/RIT/Contrato Colectivo</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Vacantes</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Avisos</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Recibos de Nómina</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">CLER´S</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Resultados de Indicadores</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="./habilidades.html">Desarrollo de habilidades</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./createCollaborator.php">Próximos eventos</a>
        </li>
        
      </ul>
      <form class="d-flex" role="search" method="GET" action="../../login.php">
        <button class="btn btn-outline-info" name="close" type="submit">Cerrar Sesión</button>
      </form>
    </div>
  </div>
</nav>


      <center>
        <img src="../../img/logo.png" style="padding: 10px;"/>
    </center>

    <div class="container" style="padding: 15px;">
    <div class="card mb-3" style="max-width: 540px;">
        <div class="row g-0">
          <div class="col-md-4">
            <center>
            <a href="./profile.html">
          <!--  <img src="<?php //echo $datos["photo"]?>" class="img-fluid" alt="Responsive image">-->
          </a>
 </center>
          </div>
          <div class="col-md-8">
            <div class="card-body">
              <h5 class="card-title"><?php echo $datos["name"]?><?php echo(" ")?><?php echo $datos["lastname"]?></h5>
            <ul>
              <li>Numero de empleado: <?php echo $datos["numero_empleado"]?></li>
              <li>Proyecto: <?php echo $datos["project"]?></li>
              <li>Fecha de ingreso: <?php echo $datos["date_of_register"]?></li>
              <li>Fecha de nacimiento: <?php echo $datos["dateofbirthday"]?></li>
            </ul>
              <p class="card-text"><small class="text-muted">Área: <?php echo $datos["area"]?></small></p>
            </div>
          </div>
        </div>
      </div>
    </div>
   
<?php
    if($password == 'clerprem001')
{
  ?>
   <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    
  (async() => {
    const {value: contraseña} = await  Swal.fire({
        icon: 'warning',
        title: 'Al inciar sesión por primera vez, debes cambiar tu contraseña',
        confirmButton: 'btn btn-success',
        confirmButtonText: 'Guardar',
        footer: '<span style="color: red">Recuerda no compartir tu nueva contraseña con nadie.</span>',
        backdrop: true,
        allowOutsideClick: false,
        allosEscapeKey: false,
        allosEnterKey: false,
        stopKeydownPropagation: false,
        input: 'text',
        placeholder: 'Ingresa nueva contraseña',
        required: true,
        
      });     

      if(contraseña){
        window.location='./newPassword.php?a='+contraseña+'&b=<?php echo$id; ?>'
      }
  })()

    
      </script>
  <?php
}else
?>
</body>
</html>

<?php
try{
  
 
  $alerts = json_decode(file_get_contents("https://REST-API.joseramonhernan.repl.co/alerts"), true);
 // echo ("acceso concedido");

  for($x=0; $x<count($alerts); $x++)
  {  
    $a=1;
     if($alerts[$x]['status'] == "true" && $datos['password']!="clerprem001")
     {
     //$number = $x+1;
     
     #$login -> alerts($datos[$x]['title'], $datos[$x]['text']);
   
      ?>
    <script>
Swal.fire({
      icon: 'info',
      title:'Tienes avisos nuevos por ver.',
      text: 'Puedes ir directo a los avisos dando click en el siguiente botón o puedes cerrar esta notificación.',
      position: 'bottom-end',
      width: '20rem',
      showCloseButton: true,
      backdrop: true,
      allowOutsideClick: false,
      allosEscapeKey: false,
      allosEnterKey: false,
      stopKeydownPropagation: false,
      showCancelButton: false,
      confirmButtonColor: '#3085d6',
      confirmButtonText: 'Ver avisos'
}).then((result) => {
if (result.isConfirmed) {
  window.location="./alerts.php?id=<?php echo($datos['_id']);?>"
}
})
         
      </script>
      
   <?php
     
}
 
  }



}catch(Exception $e){
 echo ("I don´t now what happend");
 }
}

   catch(Exception $e){
    ?>
  <script> window.location="../err.html"; </script>
  <?php
   } 
}





   ?>