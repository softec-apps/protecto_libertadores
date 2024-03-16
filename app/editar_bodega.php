<?php
include_once 'conexion.php';
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "SELECT * FROM bodegas WHERE id_bodega = ?";
    $query = $pdo->prepare($sql);
    $query->execute(array($id));
    $resultado = $query->fetch();
} elseif(isset($_POST)){
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $ubicacion = $_POST['ubicacion'];
    $capacidad = $_POST['capacidad'];
    $responsable = $_POST['responsable'];
    $contacto = $_POST['contacto'];

    $sql = "UPDATE bodegas SET nombre = ?, ubicacion = ?, capacidad = ?, responsable = ?, contacto = ? WHERE id_bodega = ?";
    $query = $pdo->prepare($sql);
    $query->execute(array($nombre, $ubicacion, $capacidad, $responsable, $contacto, $id));

    echo '<script> window.location.href = "?p=bodegas&msg=edc"; </script>';

 
}
?>
<main id="main" class="main">
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Editar Bodega</h5>
                        <form action="?p=editar_bodega" method="post">
                            <input type="hidden" name="id" value="<?php echo $resultado['id_bodega']; ?>">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nombre" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre"
                                        value="<?php echo $resultado['nombre']; ?>">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="ubicacion">Ubicación:</label>
                                    <select class="form-control select2" id="ubicacion" name="ubicacion" required>
                                        <?php
                                            $sql = "SELECT * FROM ubicaciones WHERE estado = 1 order by canton asc";
                                            $result = $pdo->query($sql);

                                            if ($result->rowCount() > 0) {
                                                while($row = $result->fetch()) {
                                                echo "<option value='".$row['canton']."'>".$row['canton']."</option>";
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="capacidad" class="form-label">Capacidad</label>
                                    <input type="number" class="form-control" id="capacidad" name="capacidad"
                                        value="<?php echo $resultado['capacidad']; ?>">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="responsable" class="form-label">Responsable</label>
                                    <input type="text" class="form-control" id="responsable" name="responsable"
                                        value="<?php echo $resultado['responsable']; ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="contacto" class="form-label ">Contacto</label>
                                    <input type="text" class="form-control" id="contacto" name="contacto"
                                        value="<?php echo $resultado['contacto']; ?>">
                                </div>
                                <div class="col-md-6 mb-3 text-end">
                                    <hr class="mb-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-edit"></i> EDITAR BODEGA
                                    </button>
                                    <a href="?p=bodegas" class="btn btn-danger">
                                        <i class="fas fa-times"></i> CANCELAR EDICIÓN </a>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->