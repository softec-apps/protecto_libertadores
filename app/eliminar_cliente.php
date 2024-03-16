<?php

require_once 'conexion.php';
$id = $_GET['id'];
$sql = "DELETE FROM usuarios WHERE id_usuario = ?";
$query = $pdo->prepare($sql);
$query->execute(array($id));

//redirecciono a la página de ubicaciones con javascript
echo "<script>alert('Cliente eliminado correctamente');</script>";
echo "<script>window.location.href='/app/?p=clientes';</script>";