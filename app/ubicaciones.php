<?php
//activo la depuración de errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM ubicaciones WHERE id = ?";
    $query = $pdo->prepare($sql);
    $query->execute(array($id));
    $resultado = $query->fetch();
    $estado = $resultado['estado'] == 1 ? 0 : 1;
    $sql = "UPDATE ubicaciones SET estado = ? WHERE id = ?";
    $query = $pdo->prepare($sql);
    $query->execute(array($estado, $id));
    header('Location: ?p=ubicaciones');
  }


$sql = "SELECT * FROM ubicaciones";
$query = $pdo->prepare($sql);
$query->execute();
$resultado = $query->fetchAll();
?>
<main id="main" class="main">
  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Gestión de Ubicaciones</h5>
            <table class="table table-striped" id="tabla_ubicaciones">
              <thead>
                <tr>
                  <th>Cantón</th>
                  <th>Estado</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($resultado as $dato): ?>
                <tr>
                  <td name="canton"><?php echo $dato['canton']; ?></td>
                  <td name="estado"><?php echo $dato['estado'] == 1 ? 'Activo' : 'Inactivo'; ?></td>
                  <td>
                    <a href="?p=ubicaciones&id=<?php echo $dato['id']; ?>" class="btn btn-warning"><i
                        class="bi bi-arrow-clockwise"></i></a>
                    
                    <a href="?p=eliminar_ubicacion&id=<?php echo $dato['id']; ?>" class="btn btn-danger"><i
                        class="bi bi-trash"></i></a>
                </tr>
                <?php endforeach ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</main><!-- End #main -->
<!-- Modal añadir -->
<div class="modal" id="addUbicacionModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addUbicacionModalLabel">Añadir Ubicación</h5>
      </div>
      <div class="modal-body">
        <form id="addUbicacionForm" action="insertar_ubicacion.php" method="GET">
          <div class="form-group">
            <label for="nombre">Nombre de la ubicación:</label>
            <input type="text" class="form-control" id="canton" name="canton" required>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Registrar Ubicación</button>
            <a href="?p=ubicaciones" class="btn btn-danger" data-dismiss="modal">Cerrar</a>

          </div>
        </form>
      </div>
    </div>