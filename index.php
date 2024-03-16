<?php
//activo la depuración de errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once 'app/conexion.php';
//inserto en la tabla logs los siguientes datos

$ip_cliente = $_SERVER['REMOTE_ADDR'];
$navegador = substr($_SERVER['HTTP_USER_AGENT'], 0, 30);
$fecha = date('d-m-Y');
$evento = 'Ingreso al portal publico';
$detalle = 'IP: '.$ip_cliente.' Navegador: '.$navegador;

$sql = "INSERT INTO logs (fecha, evento, detalle) VALUES ('$fecha', '$evento', '$detalle')";

$pdo->query($sql);

include 'header.php';
include 'home.php';
include 'footer.php';
?>

  