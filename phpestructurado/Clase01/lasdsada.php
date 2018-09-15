<?php 
echo "<h1> Programando con PHP</h1>";
echo "<h2> Trabajando con variables</h2>";

$nombre = "Gonzalo";
$apellido = 'Roland';
$edad = 31;
$sueldo = 75000.53;


var_dump($nombre, $apellido, $edad, $sueldo);

$edad = 32;
$apellido = 17.3;

echo "<br>";
echo $edad. " " . $apellido;

echo "<hr>";

$uno = "Tres";
$dos = "tristes";
$tres = "tigres";
$cuatro = "comen";
$cinco = "trigo";
$seis = "en";
$siete = "un";
$ocho = "trigal";

echo $uno. " ". $dos. " ". $tres. " ". $cuatro. " ". $cinco. " ". $seis. " ". $siete. " ". $ocho;

$miArray = [];
$miArray[] = 'Hola';
$miArray[] = 'Chau';

echo "<hr>";

var_dump($miArray);

echo "<hr>";

$animales = [];
$animales = ["perro", "gato", "cerdo", "caballo", "castor"];
$animales[] =["gallo", "tigre"];

var_dump($animales);

$animales[0] = "delfin";
var_dump($animales);
$animales[100] = "oso";
var_dump($animales);
$animales[16] = "escarabajo";
var_dump($animales);

echo "<hr>";

$auto = [];
$auto = [
    "Marca" => "Ford",
    "Modelo" => "Fiesta",
    "Color" => "Negra",
    "Anio" => 2008,
    "Patente" => "AXG-518"
];
$auto[0] = "Gonzalo";

var_dump($auto);

$auto[14] = "Seguros Rivadavia";

var_dump($auto);

$auto["Poliza"] = "666666666";

var_dump($auto);

$auto["Patente"] = "KPO-666";

var_dump($auto);

$auto[0] = "Daniel"; 

var_dump($auto);

echo "<hr>";

echo "Me gustan los animales: ";
echo "<ul type='circle'>";
echo "<li>$animales[0]</li>";
echo "<li>$animales[1]</li>";
echo "<li>$animales[2]</li>";
echo "<li>$animales[3]</li>";
echo "<li>$animales[4]</li>";

echo "<li>$animales[16]</li>";
echo "<li>$animales[100]</li>";
echo "</ul>";

echo "<hr>";

$entero = 2;
$decimal = 1.5;

echo $entero + $decimal;
echo "<br>";
echo $entero - $decimal;
echo "<br>";
echo $entero / $decimal;
echo "<br>";
echo $entero * $decimal;

$division = $entero / $decimal;
echo "<br>";
echo "La division es: ";
echo $division;
echo "<hr>";
$entero = $entero + 1;
$decimal = $decimal + 1;
echo "<br>";
echo $entero;
echo "<br>";
echo $decimal;
echo "<br>";
$entero = $entero + 5;
$decimal = $decimal - 0.5;
echo "Los nuevos valores son ".$entero." "."y"." ".$decimal;
echo "<br>";

$unaVariable = "Hola";
$otraVariable = "mundo!";
$concatenacion = $unaVariable." ".$otraVariable;
$mensajeFinal = $concatenacion." "."Qué bueno está PHP!";
echo $mensajeFinal;

?>
