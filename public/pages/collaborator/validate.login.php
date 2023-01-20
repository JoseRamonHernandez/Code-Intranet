<?php

require_once "../poo/clases.php";

function exception_error_handler($errno, $errstr, $errfile, $errline)
{
    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
}

set_error_handler("exception_error_handler");


$alert = new alertLogin;

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
    echo ("acceso concedido");
    }
   catch(Exception $e){
    $alert -> failed();
    echo ("acceso denegado");
   }
}

?>