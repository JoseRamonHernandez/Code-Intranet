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
    $upload->upload('https://res.cloudinary.com/demo/image/upload/flower.jpg', [
        'public_id' => 'flower_sample',
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
echo json_encode($admin->asset('flower_sample', [
    'asset_id']), JSON_PRETTY_PRINT
);
echo '</pre>';
?>