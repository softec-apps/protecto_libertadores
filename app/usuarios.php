<?php
require_once 'conexion.php';
$sql = "SELECT * FROM usuarios WHERE nivel = 0 and id_usuario != 1";
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
            <h5 class="card-title">Gestión de Usuarios</h5>
            <table class="table table-striped" id="tabla_usuarios">
              <thead>
                <tr>
                  <th>Usuario</th>
                  <th>Nombres</th>
                  <th>Apellidos</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($resultado as $dato): ?>
                <tr>
                  <td><?php echo $dato['username']; ?></td>
                  <td><?php echo $dato['nombres']; ?></td>
                  <td><?php echo $dato['apellidos']; ?></td>
                  <td>
                    <a href="?p=editar_usuario&id=<?php echo $dato['id_usuario']; ?>" class="btn btn-primary btn-sm">
                      <i class="bi bi-pencil-fill"></i>
                    </a>
                    <a href="?p=eliminar_usuario&id=<?php echo $dato['id_usuario']; ?>" class="btn btn-danger btn-sm">
                      <i class="bi bi-trash-fill"></i>
                    </a>
                  </td>
                </tr>
                <?php endforeach; ?>

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</main><!-- End #main -->

<!-- Modal -->
<div class="modal fade" id="addUsuarioModal" tabindex="-1" aria-labelledby="addUsuarioModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addUsuarioModalLabel">Añadir Usuario</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="?p=insertar_clientes" method="POST">
          <input type="hidden" name="nivel" value="0">
          <div class="mb-3">
            <label for="nombresCliente" class="form-label">Nombres</label>
            <input type="text" class="form-control" id="nombresCliente" name="nombres">
          </div>
          <div class="mb-3">
            <label for="apellidosCliente" class="form-label">Apellidos</label>
            <input type="text" class="form-control" id="apellidosCliente" name="apellidos">
          </div>
          <div class="mb-3">
            <label for="usernameCliente" class="form-label">Cédula</label>
            <input type="text" class="form-control" id="usernameCliente" name="username">
          </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Guardar</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
      </div>
      </form>
    </div>
  </div>
</div>