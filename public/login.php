<?php
require_once "./pages/poo/clases.php";

function exception_error_handler($errno, $errstr, $errfile, $errline)
{
    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
}

set_error_handler("exception_error_handler");

?>

<!-- Define que el documento esta bajo el estandar de HTML 5 -->
<!doctype html>

<!-- Representa la raíz de un documento HTML o XHTML. Todos los demás elementos deben ser descendientes de este elemento. -->
<html lang="es">
    
    <head>
        
        <meta charset="utf-8">
        
        <title> Formulario de Acceso </title>    
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <meta name="" content="">
        <meta name="" content="">
        <meta name="" content="">
        
        <link href="https://fonts.googleapis.com/css?family=Nunito&display=swap" rel="stylesheet"> 
        
        <!-- Link hacia el archivo de estilos css -->
        <link rel="stylesheet" href="css/login.css">
        
        <style type="text/css">
            
        </style>
        
        <script type="text/javascript">
        
        </script>
        
    </head>
    
    <body>

    <?php



$login = new login;

if(isset($_GET['ingresar'])==1)
{
    $usuario = $_GET['usuario'];
    $password = $_GET['password'];

   try
   { 
    $datos = json_decode(file_get_contents("http://localhost:3000/collaboratorNumberFind/$usuario/$password"), true);
   // echo ("acceso concedido");
 
    $id = $datos["_id"];
    $user_type = $datos["user_type"];
    $name = $datos["name"];
    

    if($user_type == "collaborator")
    {

      if($datos['status'] == "baja")
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
        icon: 'info',
        title: 'Acceso Denegado',
        iconColor: '#E41111',
        
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
    <script>let timerInterval
Swal.fire({
  title: 'Acceso Correcto!',
  html: 'Bienvenido: <?php echo$name;?>.',
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
    window.location="./pages/collaborator/home.php?_id=<?php echo$id;?>&param=1"
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
    }
  }
    elseif ($user_type == "administrator") {
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
    <script>let timerInterval
Swal.fire({
  title: 'Acceso Correcto!',
  html: 'Ingresando al módulo ADMINISTRADOR.',
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
    window.location="./pages/admin/home.php?_id=<?php echo$id?>"
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
    }
  
   
   
   
 
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
        title: 'Contraseña Incorrecta',
        text: 'Verifica tus credenciales e intentalo de nuevo',
        
      })     
      </script>
</body>
</html>
   <?php
   // echo ("acceso denegado");
   }
}

?>     
    
        <div id="contenedor">
            
            <div id="contenedorcentrado">
              
                <div id="login">
                    <form id="loginform" method="GET" action="./login.php">
                        <img src="./img/logo.png"/>
                        <label for="usuario">Usuario</label>
                        <input id="usuario" type="text" name="usuario" placeholder="Usuario" required>
                        
                        <label for="password">Contraseña</label>
                        <input id="password" type="password" placeholder="Contraseña" name="password" required>
                        
                        <button type="submit" title="Ingresar" name="ingresar">Iniciar Sesión</button>
                    </form>
                    
                </div>
                <div id="derecho">
                    <div class="titulo">
                        <h3>INTRANET CLREPREM</h3>
                        Bienvenido
                    </div>
                    <hr>
                    <div class="pie-form">
                       
                        <a href="./index.php">« Volver</a>
                    </div>
                </div>
            </div>
        </div>

   
        
    </body>
</html>