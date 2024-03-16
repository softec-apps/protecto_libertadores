<?php
include_once 'conexion.php';
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "SELECT * FROM usuarios WHERE id_usuario = ?";
    $query = $pdo->prepare($sql);
    $query->execute(array($id));
    $resultado = $query->fetch();
} elseif(isset($_POST)){
    $id = $_POST['id'];
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "UPDATE usuarios SET nombres = ?, apellidos = ?, username = ?, password = ? WHERE id_usuario = ?";
    $query = $pdo->prepare($sql);
    $query->execute(array($nombres, $apellidos, $username, $password, $id));
    echo "<script>alert('Usuario actualizado correctamente')</script>";
    echo '<script> window.location.href = "?p=usuarios"; </script>';
    
 
}
?>
<main id="main" class="main">
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Editar Usuario</h5>
                        <form action="?p=editar_usuario" method="POST">
                            <input type="hidden" name="id" value="<?php echo $resultado['id_usuario']; ?>">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nombresCliente" class="form-label">Nombres</label>
                                    <input type="text" class="form-control" id="nombresCliente" name="nombres"
                                        value="<?php echo $resultado['nombres']; ?>">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="apellidosCliente" class="form-label">Apellidos</label>
                                    <input type="text" class="form-control" id="apellidosCliente" name="apellidos"
                                        value="<?php echo $resultado['apellidos']; ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="usernameCliente" class="form-label">Usuario</label>
                                    <input type="text" class="form-control" id="usernameCliente" name="username"
                                        value="<?php echo $resultado['username']; ?>">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="passwordCliente" class="form-label">Contraseña</label>
                                    <input type="text" class="form-control" id="passwordCliente" name="password"
                                        value="<?php echo $resultado['password']; ?>">
                                </div>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Actualizar Usuario</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </section>
</main><!-- End #main -->