<?php
require_once "./pages/poo/clases.php";

$vacancies = new vacancie;

$vacancies -> status();
?>

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

   <style>
      body {
        background-image: url('subidas/fondo2.png');
        background-repeat: no-repeat;
        background-size: cover;
        background-attachment: fixed;
      }
    </style>



<body>
      <nav class="navbar bg-body-tertiar">
  <div class="container-fluid">
  <a class="navbar-brand">
            <img src="./img/logo.png" alt="Logo" width="150" height="70" class="d-inline-block align-text-top">
            
          </a>
    <form class="d-flex" role="search" action="./login.php">
      
      <button class="btn btn-primary" type="submit">Iniciar Sesión</button>
    </form>
  </div>
</nav>
<?php
if(isset($_GET['politicas'])==1)
{
  ?>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>Swal.fire({
        icon: 'info',
        title: 'POLÍTICA Y PRIVACIDAD',
        text: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Aperiam amet illo autem, nostrum adipisci, at provident atque ea minima culpa vero quaerat. Nam animi blanditiis facere itaque quisquam nobis temporibus. Lorem ipsum dolor sit amet consectetur adipisicing elit. Aperiam amet illo autem, nostrum adipisci, at provident atque ea minima culpa vero quaerat. Nam animi blanditiis facere itaque quisquam nobis temporibus.Lorem ipsum dolor sit amet consectetur adipisicing elit. Aperiam amet illo autem, nostrum adipisci, at provident atque ea minima culpa vero quaerat. Nam animi blanditiis facere itaque quisquam nobis temporibus.Lorem ipsum dolor sit amet consectetur adipisicing elit. Aperiam amet illo autem, nostrum adipisci, at provident atque ea minima culpa vero quaerat. Nam animi blanditiis facere itaque quisquam nobis temporibus.Lorem ipsum dolor sit amet consectetur adipisicing elit. Aperiam amet illo autem, nostrum adipisci, at provident atque ea minima culpa vero quaerat. Nam animi blanditiis facere itaque quisquam nobis temporibus.Lorem ipsum dolor sit amet consectetur adipisicing elit. Aperiam amet illo autem, nostrum adipisci, at provident atque ea minima culpa vero quaerat. Nam animi blanditiis facere itaque quisquam nobis temporibus.Lorem ipsum dolor sit amet consectetur adipisicing elit. Aperiam amet illo autem, nostrum adipisci, at provident atque ea minima culpa vero quaerat. Nam animi blanditiis facere itaque quisquam nobis temporibus.',
        width: '60em',
        showDenyButton: false,
        showCancelButton: false,
        confirmButtonText: 'OK',
        confirmButtonColor: '#0E77DF'
        
      
      })     
      </script>
  <?php
}

?>
<div class="container" style="padding-top: 10px; display: flex;
    align-items: center;
    justify-content: center;
    flex-direction:row;">
<h2>INTRANET</h2>
</div>
<div class="container" style="padding-top: 10px; display: flex;
    align-items: center;
    justify-content: center;
    flex-direction:row;">
<h3 style="color:blue">LESS IS MORE</h3>
</div>
<br>
<div clas="" style="margin:0;">
<div class="intranet" style="padding: 3%;">
<h3>Lo que harás.</h3>
<p>Esta aplicación web en su versión 1.0, es un sistema en el cuál se tendrá el control total del personal, manejando su información compartida como correo electrónico, numero de teléfono, etc... y en el cuál podrán realizar cursos, visualizar CLER´S, Vacantes, Contratos y mucho más.</p>
</div>
</div>


<div class="container" >
<h2 style=" display: flex;
    align-items: center;
    justify-content: center;
    flex-direction:row;">Los Cumpleañeros de este mes</h2>

<div id="carouselExampleFade" class="carousel slide carousel-fade" >

  <div class="carousel-inner">
    <div class="carousel-item active">
      <center>
      <img src="./img/logo_clerprem.png" class="d-block w-50" alt="...">
      </center>
    </div>

    <?php

//Obtener la informacion de todos los colaboradores para comprobar su mes de nacimiento con la fecha actual para 
//mostrarlos en los siguientes apartados.

$mes_actual = date('m');

  $collaborators = json_decode(file_get_contents("http://localhost:3000/collaborators"), true);

  for($x=0; $x<count($collaborators); $x++)
  {
    $userType = $collaborators[$x]['user_type'];
    $nameCollaborator = $collaborators[$x]['name'];
    $lastNameCollaborator = $collaborators[$x]['lastname'];
    $photoCollaborator = $collaborators[$x]['photo'];

   /* echo $collaborators[$x]['_id'];
    echo ("<hr>"); */


    if($userType == 'collaborator')
    {
      $cumpleaños = $collaborators[$x]['dateofbirthday'];
      $digito1 = $cumpleaños[5];
      $digito2 = $cumpleaños[6];

      $digito3 = ($digito1."".$digito2);

      if($digito3 == $mes_actual)
      {
        
        echo('
        <div class="carousel-item">
        <center>
          <img src="./subidas/'.$photoCollaborator.'" class="d-block w-50" alt="...">
          <h3 style="color:black">'.$nameCollaborator.' '.$lastNameCollaborator.'</h3>
          </center>
        </div>
        ');
      }
      
    }

  }

  

?>

  
</div>

  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev" style="color: black; background-color: black;">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next" style="color: black; background-color: black;">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
</div>





<div class="container" style="padding-top: 5%;">
<div class="row row-cols-1 row-cols-md-3 g-4" style="justify-content: space-between;">


  <div class="col">
    <div class="card h-100 border-dark">
      <div class="card-body">
      <div class="card-header bg-transparent border-dark">Misión</div>
        <h5 class="card-title">Diseñamos y fabricamos sistemas y componentes de asientos de primera clase para cumplir con los exigentes requisitos de las industrias automotriz y ferroviaria.</h5>
       </div>
      <div class="card-footer">
      <div class="card-footer bg-transparent border-dark"></div>
      </div>
    </div>
  </div>

  <div class="col">
  <div class="card h-100 border-dark">
      <div class="card-body">
      <div class="card-header bg-transparent border-dark">Visión</div>
        <h5 class="card-title">Nuestro objetivo es mantener nuestra posición como proveedor preferido de productos de clase premium agregando valor para nuestros clientes, permitiéndoles sobresalir en el mercado global.</h5>
         </div>
      <div class="card-footer">
      <div class="card-footer bg-transparent border-dark"></div>
      </div>
    </div>
  </div>


</div>
</div>
<br>
<?php
/*
$datos = json_decode(file_get_contents("https://REST-API.joseramonhernan.repl.co/collaborators"), true);
print_r ($datos);
*/
?>

<!-- As a heading -->
<nav class="navbar navbar-dark bg-dark">
<div class="container" style="padding-top: 10px; display: flex;
    align-items: center;
    justify-content: center;
    flex-direction:row;">
  <p style="color:white;" class="text-center; font-italic;">Clerprem México</p>
</div>
<div class="container" style="padding-top: 10px; display: flex;
    align-items: center;
    justify-content: center;
    flex-direction:row;">
  <p style="color:white;" class="text-center; font-italic;">Ubicación: Benito Juárez, San Sebastián, 90526 Huamantla, Tlax.</p>
</div>
<div class="container" style="padding-top: 10px; display: flex;
    align-items: center;
    justify-content: center;
    flex-direction:row;">
    <form method="GET" action="">
    <button class="navbar navbar-dark bg-dark" type="submit" name="politicas" style="background-color: black; color: white; border:0;">
  <p style="color:white;" class="text-center; font-italic;">Política y privacidad</p>
  </button>
  </form>
</div>
</nav>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
if(isset($_GET['politicas'])==1)
{

}else{
        try{   
          $datos = json_decode(file_get_contents("http://localhost:3000/events"), true);
          $x=0;
          $count=count($datos);
?>


    <script>
 (async() => {
<?php

    do{
      
?>
      
   await Swal.fire({
    title: '<?php echo $datos[$x]['title'];?>',
      imageUrl: './pages/admin/subidasEvents/<?php echo$datos[$x]['photo'];?>',
      imageWidth: 900,
      imageHeight: 500,
      imageAlt: 'Custom image',
      width: '100%',
      position: 'center',   
    showDenyButton: false,
        showCloseButton: false,
      backdrop: true,
      allowOutsideClick: false,
      allosEscapeKey: false,
      allosEnterKey: false,
      stopKeydownPropagation: false,
      showCancelButton: false,
        confirmButtonText: 'OK',
        confirmButtonColor: '#0B509D',
      }).then((result) => {
if (result.isConfirmed) {
 
<?php
$x++;
?>
}else{}
      });
      
      <?php
      
    }while($x < $count)

    ?>
    
    })()
      </script>
      <?php
}catch(Exception $e){
  ?>
<script> window.location="../err.html"; </script>
<?php
 } 
}
      ?>
    
</body>
</html>