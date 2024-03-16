<?php
//activo la depuración de errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//uso conexion.php para buscar 
include_once 'app/conexion.php';

session_start();
$code = $_GET['code'];
$_SESSION['usuario'] = 'Publico';
$_SESSION['code'] = $code;
$_SESSION['nivel'] = 2;


//inserto en la tabla logs los siguientes datos
$fecha = date('d-m-Y');
$evento = 'Rastreo';
$detalle = 'Se ha rastreado desde el portal publico el código: '.$code;

$sql = "INSERT INTO logs (fecha, evento, detalle) VALUES ('$fecha', '$evento', '$detalle')";

$pdo->query($sql);

header('Location: /app/index.php');
