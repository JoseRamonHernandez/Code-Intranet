<?php
// Establecer la fecha actual
$fecha_actual = date('Y-m-d');
$fecha = "2023-02-24";
// Sumar un día a la fecha actual
$nueva_fecha = date('Y-m-d', strtotime($fecha . ' +3 day'));

// Mostrar la nueva fecha
echo "La nueva fecha es: " . $nueva_fecha;

$today = date('N'); // Obtiene el día de la semana en formato numérico
if ($today == 5) {
    echo "¡Hoy es viernes!";
} else {
    echo "Hoy no es viernes :(";
}

#$fecha_actual = "2023-02-24"; // Fecha en formato YYYY-MM-DD

if (date("N", strtotime($fecha_actual)) == 5) {
  echo "La fecha $fecha_actual corresponde a un viernes.";
} else {
  echo "La fecha $fecha_actual no corresponde a un viernes.";
}



if (date("N", strtotime($deadline)) == 5) {
    $nueva_fecha = date('Y-m-d', strtotime($deadline . ' +3 day'));
    $friday = ("Favor de pasar el dia Lunes ".$nueva_fecha." con Recursos Humanos para continuar con el proceso");
  } else {
    
    $nueva_fecha = date('Y-m-d', strtotime($deadline . ' +1 day'));
    $friday = ("Favor de pasar el dia ".$nueva_fecha." con Recursos Humanos para continuar con el proceso");
  }
?>