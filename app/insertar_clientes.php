<?php
include_once 'conexion.php';

$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$username = $_POST['username'];
$password = "LIBERTADORES";

//si existe post nivel  lo almacena en la variable nivel, sino le asigna 1
if(isset($_POST['nivel'])){
    $nivel = $_POST['nivel'];
} else {
    $nivel = 1;
}


$sql = "INSERT INTO usuarios (nombres, apellidos, username, password, nivel) VALUES (?, ?, ?, ?, ?)";
$query = $pdo->prepare($sql);
$query->execute(array($nombres, $apellidos, $username, $password, $nivel));

//redireccionar a la página de clientes con javascript
echo "<script>alert('Registrado correctamente')</script>";

//si nivel es 0 redirecciona a la página de usuarios, sino redirecciona a la página de clientes
if($nivel == 0){
    echo "<script>location.href='?p=usuarios'</script>";
} else {
    echo "<script>location.href='?p=clientes'</script>";
}
?>

