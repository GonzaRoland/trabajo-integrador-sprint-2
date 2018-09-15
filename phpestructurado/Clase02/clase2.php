<?php

$dias = ["Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo"];
$evaluaciones = ["Regular", "Bueno", "Excelente"];
$porcentajes = [10, 20, 30];

$nombre = "Gonzalo";
$apellido = "Roland";
$dni = "33103353";
$sueldo = 40000;
$dia = 4;
$evaluacion = 1; 

$msj_error = "<h1>ERROR, la evaluación debe ser solo: (0) =  Regular, (1) = Bueno, (2) = Excelente y el día especificado no puede ser mayor a 7!</h1>";

if ( ($dia >= 0 && $dia < 7 && $evaluacion >= 0 && $evaluacion < 4 ) ) {

$porcentaje = $porcentajes[$evaluacion];
$aumento = ($sueldo * ($porcentaje/100));
$sueldo = ($sueldo + $aumento);                    


echo "<h1>Estimado $nombre $apellido, portador del DNI: $dni... 
<br>
Le informamos que el día de hoy: $dias[$dia], de acuerdo al nivel de evaluación obtenido: $evaluaciones[$evaluacion], 
usted ha recibido un aumento del $porcentaje%, siendo su aumento de: $aumento y su nuevo sueldo es de: $sueldo</h1>";
}

else echo "$msj_error";

?>