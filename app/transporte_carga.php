<?php
require_once 'conexion.php';
$sql = "SELECT * FROM envios ORDER BY id DESC";
$query = $pdo->prepare($sql);
$query->execute();
$resultado = $query->fetchAll();


//si recibo un id por get, actualizo o elimino dependiendo del caso
if (isset($_GET['op'])) {
  if ($_GET['op'] == 'actualizar') {
    $id = $_GET['id'];
    $sql = "UPDATE bodegaje SET estado = 0 WHERE id = ?";
    $query = $pdo->prepare($sql);
    $query->execute(array($id));
    header('Location: ?p=bodegaje');
  } else if ($_GET['op'] == 'eliminar') {
    $id = $_GET['id'];
    $sql = "DELETE FROM bodegaje WHERE id = ?";
    $query = $pdo->prepare($sql);
    $query->execute(array($id));
    header('Location: ?p=bodegaje');
  }
}


?>
<main id="main" class="main">
  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Registro de envios</h5>
            <table class="table table-striped" id="tabla_bodegaje">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Cliente</th>
                  <th>Destino</th>
                  <th>Detalle</th>
                  <th>Estado</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($resultado as $dato): ?>
                <tr>
                  <td><?php echo $dato['id']; ?></td>
                  <td><?php echo $dato['cliente']; ?></td>
                  <td><?php echo $dato['destino']; ?></td>
                  <td><?php echo $dato['detalle']; ?></td>
                  <td><?php echo $dato['estado'] == 1 ? 'Ocupado' : 'Entregado'; ?></td>
                  <td>
                    <a title="Entregar Mercaderia" href="?p=bodegaje&op=actualizar&id=<?php echo $dato['id']; ?>" class="btn btn-primary"><i
                        class="bi bi-arrow-clockwise"></i></a>
                    <a title="Eliminar" href="?p=bodegaje&op=eliminar&id=<?php echo $dato['id']; ?>" class="btn btn-danger"><i
                        class="bi bi-trash"></i></a>
                    <a title="PDF" href="?p=bodegaje_reporte&id=<?php echo $dato['id']; ?>" class="btn btn-success"><i class="bi bi-file-earmark-pdf"></i></a>
                    
                  </td>
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
<div class="modal fade" id="addRegistroMercancia" tabindex="-1" role="dialog" aria-labelledby="addBodegaModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addRegistroMercanciaLabel">Añadir Mercaderia</h5>
      </div>
      <div class="modal-body">
        <form id="addRegistroMercanciaForm" action="insertar_mercancia.php" method="post">
          <?php
          $consulta = $pdo->prepare("SELECT CONCAT(nombres, ' ', apellidos) as nombre_completo FROM usuarios");
          $consulta->execute();
          $clientes = $consulta->fetchAll(PDO::FETCH_ASSOC);
          ?>
          <div class="form-group">
            <label for="cliente">Cliente:</label>
            <select class="form-control" id="cliente" name="cliente" required>
              <?php foreach ($clientes as $cliente): ?>
                <option value="<?php echo $cliente['nombre_completo']; ?>"><?php echo $cliente['nombre_completo']; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <?php
          $consulta = $pdo->prepare("SELECT nombre FROM bodegas");
          $consulta->execute();
          $bodegas = $consulta->fetchAll(PDO::FETCH_ASSOC);
          ?>
          <div class="form-group">
            <label for="bodega">Bodega:</label>
            <select class="form-control" id="bodega" name="bodega" required>
              <?php foreach ($bodegas as $bodega): ?>
                <option value="<?php echo $bodega['nombre']; ?>"><?php echo $bodega['nombre']; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <label for="mercaderia">Mercadería:</label>
            <textarea class="form-control" id="mercaderia" name="mercaderia" rows="3" required></textarea>
          </div>
          <div class="form-group">
            <label for="espacio">Espacio:</label>
            <input type="number" class="form-control" id="espacio" name="espacio" required>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Guardar</button>
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
          </div>
        </form>
      </div>
    </div>
