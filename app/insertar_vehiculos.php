<?php
include_once 'conexion.php';

$numero_unidad = $_POST['numero_unidad'];
$placa = $_POST['placa'];
$marca = $_POST['marca'];
$modelo = $_POST['modelo'];
$anio_fabricacion = $_POST['anio_fabricacion'];
$capacidad_carga = $_POST['capacidad_carga'];
$tipo_combustible = $_POST['tipo_combustible'];
$ubicacion = $_POST['ubicacion'];

$consulta = $pdo->prepare("INSERT INTO vehiculos (numero_unidad, placa, marca, modelo, anio_fabricacion, capacidad_carga, tipo_combustible, ubicacion) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$consulta->execute(array($numero_unidad, $placa, $marca, $modelo, $anio_fabricacion, $capacidad_carga, $tipo_combustible, $ubicacion));

//redirect to vehiculos.php con javascript
echo "<script>alert('Vehiculo registrado correctamente');</script>";
echo "<script>window.location.replace('?p=vehiculos');</script>";