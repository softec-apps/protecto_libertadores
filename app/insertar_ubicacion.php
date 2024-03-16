<?php 

//habilito la depuración de errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once 'conexion.php';

//obtengo los datos del formulario
$canton = $_GET['canton'];
$estado = 0;

//si existe canton, preparo la consulta
if (isset($canton)) {
    $sql = "INSERT INTO ubicaciones (canton, estado) VALUES (?, ?)";
    $query = $pdo->prepare($sql);
    $query->execute(array($canton, $estado));
    //redirecciono a la página de ubicaciones con javascript
    echo "<script>alert('Ubicación añadida correctamente');</script>";
    echo "<script>window.location.href='/app/?p=ubicaciones';</script>";
    
}else 
  echo "Donde está el cantón?";
?>
