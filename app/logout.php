<?php
session_start();


//inserto en la tabla logs los siguientes datos
include_once 'conexion.php';
$fecha = date('d-m-Y');
$usuario = $_SESSION['username'];
$evento = 'Fin de sesión de usuario';
$detalle = 'Usuario: '.$usuario;
$sql = "INSERT INTO logs (fecha, evento, detalle) VALUES ('$fecha', '$evento', '$detalle')";
$pdo->query($sql);
session_destroy();
echo '<script type="text/javascript">
        window.location.assign("login.php");
    </script>';