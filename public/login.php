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

   /* echo ($usuario);
    echo ("\n");
    echo($password);
    */
   // $datos = json_decode(file_get_contents("https://REST-API.joseramonhernan.repl.co/collaboratorNumberFind/$usuario/$password"), true);
   // print_r ($datos);

   try
   { 
    $datos = json_decode(file_get_contents("https://REST-API.joseramonhernan.repl.co/collaboratorNumberFind/$usuario/$password"), true);
   // echo ("acceso concedido");
   $id = $datos["_id"];
   ?>
   <script> window.location="./pages/collaborator/home.php?_id=<?php echo$id?>"; </script>
   
     
      <?php
    }
   catch(Exception $e){
    $login -> alertFailed();
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