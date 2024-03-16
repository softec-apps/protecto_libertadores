<?php
//activo la depuración de errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once 'conexion.php';

$cliente = $_POST['cliente'];
$bodega = $_POST['bodega'];
$mercaderia = $_POST['mercaderia'];
$espacio = $_POST['espacio'];
$estado = 1;

$sql = "INSERT INTO bodegaje (cliente_nombres, bodega, mercaderia_almacenada, espacio_ocupado, estado) VALUES (?, ?, ?, ?, ?)";
$query = $pdo->prepare($sql);
$query->execute(array($cliente, $bodega, $mercaderia, $espacio, $estado));


//redirect to vehiculos.php con javascript
echo "<script>alert('Registro de Mercaderia creada correctamente');</script>";
//envio a history back
echo "<script>window.history.go(-1);</script>";

