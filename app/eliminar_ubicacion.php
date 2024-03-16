<?php

require_once 'conexion.php';
$id = $_GET['id'];
$sql = "DELETE FROM ubicaciones WHERE id = ?";
$query = $pdo->prepare($sql);
$query->execute(array($id));

//redirecciono a la página de ubicaciones con javascript
echo "<script>alert('Ubicación eliminada correctamente');</script>";
echo "<script>window.location.href='/app/?p=ubicaciones';</script>";