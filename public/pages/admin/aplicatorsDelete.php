<?php

if(empty($_GET['idSolicitud']))
{
    echo ("No se reciben parámetros");
}
else
{
    $idSolicitud = $_GET['idSolicitud'];
    
    $eliminarSolicitud = json_decode(file_get_contents("http://localhost:3000/deleteAplicator/$idSolicitud"), true);

    if($eliminarSolicitud)
    {
        ?>
        <script>
            window.location="aplicatorsPage.php";
        </script>
        <?php
    }
}

?>