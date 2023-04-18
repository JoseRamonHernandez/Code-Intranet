<?php


class login{

    public function alertFailed()
    {
        echo ('
        <head>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

            <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
  <symbol id="check-circle-fill" viewBox="0 0 16 16">
    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
  </symbol>
  <symbol id="info-fill" viewBox="0 0 16 16">
        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
        </symbol>
            <symbol id="exclamation-triangle-fill" viewBox="0 0 16 16">
            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
            </symbol>
            </svg>
            <div class="alert alert-danger d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
            <div>
              <h1>Datos Incorrectos!</h1>
              <br>
              <p>Intentelo nuevamente</p>
            </div>
          </div>

        </head>'
    );
    }

    public function formFailed()
    {
        echo ('
        <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
        </hea>
        <body>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Ocurrio un Error!</strong> Ponte en contacto con tu proveedor.
        
        </div>
        </body>
        ');
    }

    public function formSucces()
    {
        echo ('
        <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
        </hea>
        <body>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Registro exitoso!</strong> El usuario fue almacenado correctamente.
       
        </div>
        </body>
        ');
    }


    public function navegation($user, $password)
    {   
        $this -> usuario = $user;
        $this -> contrasena = $password;
        ?>
        <script> window.location="./pages/collaborator/home.php?usuario=<?php echo$usuario?>"; </script>
        <?php

       // parameters($user, $password);
    }

        /*
    public function parameters($user, $password)
    {
        $this -> user = $user;
        $this -> password = $password;
        
        return [$user, $password];
    }
    */

    public function alerts($title, $text)
    {
        $this -> title = $title;
        $this -> text = $text;

       /* echo('
        titulo: '.$title.',
         texto: '.$text.'
        ');*/

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
    <script>
    (async() => {
       
    await  Swal.fire({
        icon: 'info',
        title: 'titulo',
        text: 'texto',
        showCloseButton: true,
        backdrop: true,
        allowOutsideClick: false,
        allosEscapeKey: false,
        allosEnterKey: false,
        stopKeydownPropagation: false,
        showCancelButton: false,
        showConfirmButton: false,
          });
                
})()
        </script>

</body>
</html>
        <?php
    }

};

class miHerencia extends login{
    public function metodoHerencia(){
         $this -> usuario; 
         $this -> contrasena;
         return [$usuario, $contrasena];
    }
};

class vacancie{

    public function status()
    {
        $datos = json_decode(file_get_contents("http://localhost:3000/Vacancies"), true);

        if(!$datos)
        {

        }else{

        for($x=0; $x<count($datos); $x++)
        {
            $today = date('Y-m-d');
            $date = $datos[$x]['deadline'];

            if($date <= $today)
            {
                $newId = $datos[$x]['_id'];
                $status = "false";
               # echo "status false";
                   //url de la petición
$url = "http://localhost:3000/updateVacancies/$newId";
//inicializamos el objeto CUrl
$ch = curl_init($url);
  
//el json simulamos una petición de un login
$jsonData = array(
    'status' => $status
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
            }else{
               # echo "status true";
            }
        }

    }
}

};

?>