<html lang="HTML5">
<head>    <title>PHP Quick Start</title>  </head>
<body>
<?php

require __DIR__ . '../../vendor/autoload.php';

// Use the Configuration class 
use Cloudinary\Configuration\Configuration;

// Configure an instance of your Cloudinary cloud
Configuration::instance('cloudinary://231262176462779:cJBGwWjzZyhnA_vgWBJKo5b5gSA@dpeovabge?secure=true');

// Use the UploadApi class for uploading assets
use Cloudinary\Api\Upload\UploadApi;

// Upload the image
/*
$upload = new UploadApi();
echo '<pre>';
echo json_encode(
    $upload->upload('./img/clerprem_mexico_2.jpg', [
        'public_id' => 'example',
        'use_filename' => TRUE,
        'overwrite' => TRUE]),
    JSON_PRETTY_PRINT
);
echo '</pre>';
*/
// Use the AdminApi class for managing assets
use Cloudinary\Api\Admin\AdminApi;

// Get the asset details
$admin = new AdminApi();
echo '<pre>';
$info = json_encode($admin->asset('example'), JSON_PRETTY_PRINT); //Almacena la información de la imagen en la variable


echo $info; //Imprime la información
echo ("<hr><br>");
$obj =(json_decode($info));// Convierte la cadena $info a un objeto JSON
echo ("<hr><br>");
echo ("<hr><br>");
echo$obj->{'url'};// Imprime el campo solicitado
echo ("<hr><br>");

var_dump($info[7]);
echo ("<hr><br>");
//echo $a;
//echo $info['url'];
//$datos = json_decode(file_get_contents($info));
echo ("<hr><br>");
$data = file_get_contents($info);
$decoded_json = json_decode($data, true);
if(isset($decoded_json['url'])){
//echo $decoded_json['url'];
}else{echo ("NEl perro no jala");}

?>