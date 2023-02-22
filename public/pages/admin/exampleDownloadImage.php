<?php

if(isset($_POST['download'])==1)
{
    echo("<h1>Descargando...</h1>");
    $photo = "logo_clerprem.png";
    
    $img = "./subidasEvents/$photo";
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename='.basename($img));
header('Content-Transfer-Encoding: binary');
header('Expires: 0');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Pragma: public');
header('Content-Length: ' . filesize($img));
ob_clean();
flush();
readfile($img);
}

?>

<form method="POST" action="#">
    <button type="submit" name="download">Descargar IMG</button>
</form>