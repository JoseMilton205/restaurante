<?php
$servidor ="localhost";
$baseDatos ="restaurante";
$usuario="root";
$contraseña ="";

try{
    $conexion = new PDO("mysql:host=$servidor;dbname=$baseDatos", $usuario, $contraseña);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
echo"conexion establecida";
} catch(Exception $error){
echo $error -> getMessage();
}
?>