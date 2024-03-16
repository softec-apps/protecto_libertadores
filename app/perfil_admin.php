<?php
include_once 'conexion.php';
$id_usuario = $_SESSION['id'];
$sql = "SELECT * FROM usuarios WHERE id_usuario = $id_usuario";
$query = $pdo->prepare($sql);
$query->execute();
$resultado = $query->fetch();

if($_POST){
  $id_usuario = $_POST['id_usuario'];
  $nombres = $_POST['nombres'];
  $apellidos = $_POST['apellidos'];
  $username = $_POST['username'];
  $password = $_POST['password'];
    $sql = "UPDATE usuarios SET nombres = ?, apellidos = ?, username = ?, password = ? WHERE id_usuario = ?";
    $query = $pdo->prepare($sql);
    $query->execute(array($nombres, $apellidos, $username, $password, $id_usuario));
    //actualizar la sesion
    $_SESSION['nombres'] = $nombres;
    $_SESSION['apellidos'] = $apellidos;
    echo "<script>alert('Usuario actualizado exitosamente');</script>";
    echo "<script>window.location.href='?p=perfil_admin';</script>";
}
?>
<main id="main" class="main">
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Bienvenido -
                            <?php echo $_SESSION['nombres'].' '.$_SESSION['apellidos']; ?></h5>
                        <hr>
                        <form action="?p=perfil_admin" method="post">
                            <input type="hidden" name="id_usuario" value="<?php echo $resultado['id_usuario']; ?>">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nombres" class="form-label">Nombres</label>
                                    <input type="text" class="form-control" id="nombres" name="nombres"
                                        value="<?php echo $resultado['nombres']; ?>" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="apellidos" class="form-label">Apellidos</label>
                                    <input type="text" class="form-control" id="apellidos" name="apellidos"
                                        value="<?php echo $resultado['apellidos']; ?>" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="username" class="form-label">Usuario</label>
                                    <input type="text" class="form-control" id="username" name="username"
                                        value="<?php echo $resultado['username']; ?>" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="password" class="form-label">Contraseña</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Actualizar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->