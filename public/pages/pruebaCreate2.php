<?php

$empleado = $_GET['empleado'];
$nombre = $_GET['nombre'];
$apellido = $_GET['apellido'];
$date_birthday = $_GET['date_birthday'];
$email = $_GET['email'];
$password = "clerprem001";
$area = $_GET['area'];
$project = $_GET['project'];
$date_register = $_GET['date_register'];
$number_phone = $_GET['number_phone'];
$emergency_phone = $_GET['emergency_phone'];
$photo = $_GET['photo'];
$user_type = "collaborator";

echo ('Numero de empleado : '.$empleado);
echo ('<br>');
echo ('nombre : '.$nombre);
echo ('<br>');
echo ('apellido : '.$apellido);
echo ('<br>');
echo ('date_birthday : '.$date_birthday);
echo ('<br>');
echo ('email: '.$email);
echo ('<br>');
echo ('password : '.$password);
echo ('<br>');
echo ('area : '.$area);
echo ('<br>');
echo ('project: '.$project);
echo ('<br>');
echo ('date_register : '.$date_register);
echo ('<br>');
echo ('number_phone : '.$number_phone);
echo ('<br>');
echo ('emergency_phone: '.$emergency_phone);
echo ('<br>');
echo ('photo : '.$photo);
echo ('<br>');
echo ('user_type : '.$user_type);
echo ('<br>');

?>