<?php
require_once 'conexion.php';

if (isset($_POST['code'])) {
    $code = $_POST['code'];
    $_SESSION['code'] = $code;
} else {
    $code = $_SESSION['code'];
}


$code = $_SESSION['code'];
$sql = "SELECT * FROM rastreo where id_envio= '$code'"; 
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
              <h5 class="card-title">Rastreo de envió de carga código #<?php echo $_SESSION['code']?></h5>
        
              
               <table class="table table-striped table-bordered" id="tabla_rastreo" style="width:100%">
                    <thead>
                    <tr>
               
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Estado</th>
                        <th>Ubicación</th>
                        <th>Descripción</th>
                     
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($resultado as $dato): ?>
                    <tr>
                        <td><?php echo $dato['fecha']; ?></td>
                        <td><?php echo $dato['hora']; ?></td>
                        <td class="<?php echo $dato['estado'] == 0 ? 'bg-warning' : ($dato['estado'] == 1 ? 'bg-info' : 'bg-success'); ?>"><?php echo $dato['estado'] == 0 ? 'Preparado para el envio' : ($dato['estado'] == 1 ? 'En transito' : 'Entregado'); ?></td>
                        

                        <td><?php echo "<a href='https://www.google.com/maps/place/".$dato['ubicacion']."' target='_blank' ><i class='fas fa-map-marker-alt'></i></a>"; ?></td>
                        <td><?php echo $dato['descripcion']; ?></td>
                       
                    </tr>
                    
                    <?php endforeach ?>
                   
                </tbody>
            </div>
          </div>

        </div>

       

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  