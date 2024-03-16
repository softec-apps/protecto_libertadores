<?php
//si el nivel de usuario es 2, redireccion con javascritp ?p=rastreo
if ($_SESSION['nivel'] == 2) {
    echo '<script>window.location.href = "?p=rastreo";</script>';
}elseif($_SESSION['nivel'] == 1){
    echo '<script>window.location.href = "?p=inicio_usuario";</script>';
}

?>
 
<main id="main" class="main">
<div class="pagetitle">
    <section class="section dashboard">
      <div class="row">
        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">
             

          
<!-- Recent Activity -->
<div class="col-lg-12">
  <div class="card">
  <div class="card-body">
              <h5 class="card-title">Visitas a la pagina Web de la Cooperativa</h5>
              <p class="card-text">

          <?php	
          include_once  'conexion.php';
          $tipo_evento = "Ingreso al portal publico";
          $consulta = $pdo->prepare("SELECT COUNT(*) as count FROM logs WHERE evento = :tipo_evento");
          $consulta->bindParam(':tipo_evento', $tipo_evento);
          $consulta->execute();
          $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
          $cantidadIngresosFallidos = $resultado['count'];
          echo "Cantidad de visitantes: " . $cantidadIngresosFallidos;
          ?>

              </p>
              
  </div>
</div>

<div class="card">
<?php 
include_once  'conexion.php';
$tipo_evento = "Ingreso al portal publico";
$consulta = $pdo->prepare("SELECT fecha, evento, detalle FROM logs WHERE evento = :tipo_evento ORDER BY id DESC LIMIT 10");
$consulta->bindParam(':tipo_evento', $tipo_evento);
$consulta->execute();
$logs = $consulta->fetchAll(PDO::FETCH_ASSOC);
?>     

            <div class="card-body">
              <h5 class="card-title">Ultimas 10 visitas</h5>
              <?php foreach($logs as $log): ?>
              <div class="activity">

                <div class="activity-item d-flex">
                  <div class="activite-label"><?php echo $log['fecha']; ?></div>
                  <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                  <div class="activity-content">
                  <a href="#" class="fw-bold text-dark"> <?php echo $log['evento']; ?> - </a> <?php echo $log['detalle']; ?>
                  </div>
                </div><!-- End activity item-->
                <?php endforeach; ?>
                
                
              </div>

            </div>
            


          </div><!-- End Recent Activity -->

          

          </div>
        </div><!-- End Left side columns -->

     

      </div>
    </section>

  </main><!-- End #main -->


