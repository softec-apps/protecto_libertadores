<?php
//errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$id_bodega = $_GET['id'];

include_once 'conexion.php';

//eliminar bodega
$sql = "DELETE FROM bodegas WHERE id_bodega = ?";
$query = $pdo->prepare($sql);
$query->execute([$id_bodega]);

header('Location: /app/?p=bodegas');
?>