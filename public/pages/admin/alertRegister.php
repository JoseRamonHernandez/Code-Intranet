<?php
if(isset($_POST['save'])==1)
{

  if(!empty($_FILES['archivo-a-subir']['name']))
  {
    
    $target_path = "subidasAlerts/"; 
  $target_path = $target_path . basename( $_FILES['archivo-a-subir']['name']); 
  if(move_uploaded_file($_FILES['archivo-a-subir']['tmp_name'], $target_path)) 
  { 
  //echo "\nEl archivo ". basename( $_FILES['archivo-a-subir']['name'])." ha sido subido exitosamente!"; 
  $img = $_FILES['archivo-a-subir']['name'];
  } 
  else
  { 
  echo "\nHubo un error al subir tu archivo! Por favor intenta de nuevo."; 
  $img = "logo_clerprem.png";
  }
  }else{
    $img = "logo_clerprem.png";
    echo ("No se envio img");
  }
  



 $title = $_POST['title'];
 $level = $_POST['level'];
 $status = $_POST['status'];

 echo ('<br>'.$title.'<br>'.$level.'<br>'.$status.'<br>'.$img);
}