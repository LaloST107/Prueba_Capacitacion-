<?php
header('Content-type: application/json');
include_once 'conexion.php';

$objeto = new Conexion();
$conexion = $objeto->Conectar();

$result = array();

$consulta = "SELECT nombre_raza, sum(cantidad_raza) FROM raza GROUP BY nombre_raza ORDER BY sum(cantidad_raza) DESC";
$resultado = $conexion->prepare($consulta);
$resultado->execute();

while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)){
    array_push($result, array($fila["nombre_raza"], $fila["sum(cantidad_raza)"] ));
}

print json_encode($result, JSON_NUMERIC_CHECK);
$conexion=null;
