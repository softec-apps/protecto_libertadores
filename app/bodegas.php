<?php
require_once 'conexion.php';
$sql = "SELECT * FROM bodegas";
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
            <h5 class="card-title">Gestión de Bodegas</h5>
            <table class="table table-striped" id="tabla_bodegas">
              <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Ubicacion</th>
                  <th>Capacidad</th>
                  <th>Disponibilidad</th>
                  <th>Responsable</th>
                  <th>Teléfono</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($resultado as $dato): ?>
                <tr>
                  <td name="nombre"><?php echo $dato['nombre']; ?></td>
                  <td name="ubicacion"><?php echo $dato['ubicacion']; ?></td>
                  <td name="capacidad"><?php echo $dato['capacidad']; ?></td>
                  <td><?php echo $dato['disponibilidad']; ?></td>
                  <td name="responsable"><?php echo $dato['responsable']; ?></td>
                  <td name="contacto"><?php echo $dato['contacto']; ?></td>
                  <td>
                    <a href="?p=editar_bodega&id=<?php echo $dato['id_bodega']; ?>" class="btn btn-primary"><i
                        class="bi bi-pencil"></i></a>
                    <button type="button" class="btn btn-danger delete-btn"
                      data-id="<?php echo $dato['id_bodega']; ?>"><i class="bi bi-trash"></i></button>
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
<div class="modal fade" id="addBodegaModal" tabindex="-1" role="dialog" aria-labelledby="addBodegaModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addBodegaModalLabel">Añadir Bodega</h5>
      </div>
      <div class="modal-body">
        <form id="addBodegaForm" action="insertar_bodega.php" method="post">
          <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
          </div>
          <div class="form-group">
            <label for="ubicacion">Ubicación:</label>
            <select class="form-control select2" id="ubicacion" name="ubicacion" required>
              <?php
                  $sql = "SELECT * FROM ubicaciones WHERE estado = 1  order by canton asc";
                  $result = $pdo->query($sql);

                  if ($result->rowCount() > 0) {
                    while($row = $result->fetch()) {
                      echo "<option value='".$row['canton']."'>".$row['canton']."</option>";
                    }
                  }
              ?>
            </select>
          </div>
          <div class="form-group">
            <label for="capacidad">Capacidad:</label>
            <input type="number" class="form-control" id="capacidad" name="capacidad" required>
          </div>
          <div class="form-group">
            <label for="responsable">Responsable:</label>
            <input type="text" class="form-control" id="responsable" name="responsable" required>
          </div>
          <div class="form-group">
            <label for="contacto">Contacto:</label>
            <input type="text" class="form-control" id="contacto" name="contacto">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button id="saveChangesButton" type="submit" class="btn btn-primary">Guardar cambios</button>
          </div>
        </form>
      </div>
    </div>