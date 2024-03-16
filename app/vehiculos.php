<?php
require_once 'conexion.php';
$sql = "SELECT * FROM vehiculos";
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
            <h5 class="card-title">Gestión de Vehiculos</h5>
            <table class="table table-striped" id="tabla_vehiculos">
              <thead>
                <tr>
                  <th>Unidad #</th>
                  <th>Placa</th>
                  <th>Marca</th>
                  <th>Año</th>
                  <th>Capacidad KG</th>
                  <th>Ubicación</th>
                  <th>Acciones</th>

                </tr>
              </thead>
              <tbody>
                <?php
                foreach ($resultado as $row) {
                ?>
                <tr>
                  <td><?php echo $row['numero_unidad']; ?></td>
                  <td><?php echo $row['placa']; ?></td>
                  <td><?php echo $row['marca']; ?></td>
                  <td><?php echo $row['anio_fabricacion']; ?></td>
                  <td><?php echo $row['capacidad_carga']; ?></td>
                  <td><?php echo $row['ubicacion']; ?></td>
                  <td>
                    <div class="btn-group" role="group" aria-label="Acciones del vehículo">
                      <a href="?p=mantenimiento&id=<?php echo $row['id']; ?>" class="btn btn-outline-primary"
                        title="Mantenimiento">
                        <i class="bi bi-ev-front-fill"></i>
                      </a>
                      <a href="?p=combustible&id=<?php echo $row['id']; ?>" class="btn btn-outline-primary"
                        title="Combustible">
                        <i class="bi bi-fuel-pump-diesel-fill"></i>
                      </a>
                      <a href="?p=ver_vehiculo&id=<?php echo $row['id']; ?>" class="btn btn-outline-primary"
                        title="Ver vehículo">
                        <i class="bi bi-eye-fill"></i>
                      </a>
                      <a href="?p=editar_vehiculo&id=<?php echo $row['id']; ?>" class="btn btn-outline-primary"
                        title="Editar vehículo">
                        <i class="bi bi-pencil-fill"></i>
                      </a>
                      <a href="?p=eliminar_vehiculo&id=<?php echo $row['id']; ?>" class="btn btn-outline-primary"
                        title="Eliminar vehículo">
                        <i class="bi bi-trash-fill"></i>
                      </a>
                    </div>
                  </td>
                </tr>
                <?php
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</main><!-- End #main -->

<!-- Modal -->
<div class="modal fade" id="addVehiculoModal" tabindex="-1" aria-labelledby="addVehiculoModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addVehiculoModalLabel">Añadir Vehiculo</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="?p=insertar_vehiculos" method="POST">
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="numero_unidad" class="form-label">Unidad #</label>
              <input type="text" class="form-control" id="numero_unidad" name="numero_unidad" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="placa" class="form-label">Placa</label>
              <input type="text" class="form-control" id="placa" name="placa" required>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4 mb-3">
              <label for="marca" class="form-label">Marca</label>
              <select class="form-control" id="marca" name="marca" required>
                <?php 
              $consulta = $pdo->prepare("SELECT * FROM marcas");
              $consulta->execute();
              $marcas = $consulta->fetchAll(PDO::FETCH_ASSOC);
              foreach($marcas as $marca): ?>
                <option value="<?php echo $marca['marca']; ?>"><?php echo $marca['marca']; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col-md-4 mb-3">
              <label for="modelo" class="form-label">Modelo</label>
              <input type="text" class="form-control" id="modelo" name="modelo" required>
            </div>
            <div class="col-md-4 mb-3">
              <label for="anio_fabricacion" class="form-label">Año</label>
              <select class="form-control" id="anio_fabricacion" name="anio_fabricacion" required>
                <?php 
              $anio_actual = date('Y');
              for($i = $anio_actual - 25; $i <= $anio_actual + 1; $i++): ?>
                <option value="<?php echo $i; ?>" <?php echo $i == $anio_actual ? 'selected' : ''; ?>><?php echo $i; ?>
                </option>
                <?php endfor; ?>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="capacidad_carga" class="form-label">Capacidad de Carga (KG)</label>
              <input type="text" class="form-control" id="capacidad_carga" name="capacidad_carga" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="ubicacion" class="form-label">Ubicación</label>
              <select class="form-control" id="ubicacion" name="ubicacion" required>
                <?php 
              $consulta = $pdo->prepare("SELECT canton FROM ubicaciones WHERE estado = 1 order by canton asc");
              $consulta->execute();
              $ubicaciones = $consulta->fetchAll(PDO::FETCH_ASSOC);
              foreach($ubicaciones as $ubicacion): ?>
                <option value="<?php echo $ubicacion['canton']; ?>"><?php echo $ubicacion['canton']; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12 mb-3">
              <label for="tipo_combustible" class="form-label">Tipo de Combustible</label>
              <select class="form-control" id="tipo_combustible" name="tipo_combustible" required>
                <option value="0">Gasolina</option>
                <option value="1">Diesel</option>
                <option value="2">Electrico</option>
              </select>
            </div>

            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Guardar</button>
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </form>
      </div>
    </div>
  </div>


