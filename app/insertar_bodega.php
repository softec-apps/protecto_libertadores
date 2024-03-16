<?php 

//habilito la depuración de errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


include_once 'conexion.php';
$nombre = $_POST['nombre'];
$ubicacion = $_POST['ubicacion'];
$capacidad = $_POST['capacidad'];
$disponibilidad = 0;
$responsable = $_POST['responsable'];
$contacto = $_POST['contacto'];

// Preparar la consulta SQL
$sql = "INSERT INTO bodegas (nombre, ubicacion, capacidad, disponibilidad, responsable, contacto) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $pdo->prepare($sql);

// Ejecutar la consulta
try {
    $stmt->execute([$nombre, $ubicacion, $capacidad, $disponibilidad, $responsable, $contacto]);
    echo 'success';

} catch (PDOException $e) {
    echo 'Error desconocido: ' . $e->getMessage();
}