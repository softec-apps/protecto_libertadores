<?php
include 'conexion.php';
if ($_POST) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $sql = "SELECT * FROM usuarios WHERE username = '$username' AND password = '$password'";
  $query = $pdo->prepare($sql);
  $query->execute();
  $resultado = $query->fetchAll();
  if ($resultado) {
    session_start();
    $_SESSION['id'] = $resultado[0]['id_usuario'];
    $_SESSION['username'] = $username;
    $_SESSION['nivel'] = $resultado[0]['nivel'];
    $_SESSION['nombres'] = $resultado[0]['nombres'];
    $_SESSION['apellidos'] = $resultado[0]['apellidos'];
    //inserto en la tabla logs los siguientes datos

    $fecha = date('d-m-Y');
    $usuario = $_POST['username'];
    $evento = 'Ingreso al portal de usuario Correcto';
    $detalle = 'Usuario: '.$usuario;
    $sql = "INSERT INTO logs (fecha, evento, detalle) VALUES ('$fecha', '$evento', '$detalle')";
    $pdo->query($sql);
    echo "<script>window.location.href='/app/';</script>";
  } else {
      //inserto en la tabla logs los siguientes datos

      $fecha = date('d-m-Y');
      $usuario = $_POST['username'];
      $ip_cliente = $_SERVER['REMOTE_ADDR'];
      $evento = 'Ingreso al portal de usuario fallido';
      $detalle = 'Usuario: '.$usuario.' IP: '.$ip_cliente;
      $sql = "INSERT INTO logs (fecha, evento, detalle) VALUES ('$fecha', '$evento', '$detalle')";
      $pdo->query($sql);
      echo "<script>alert('Usuario o contraseña incorrectos');</script>";
  }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Libertadores - Login</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
    rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <style>
    body {
      background-image: url('assets/img/fondo_libertadores_login.webp');
      background-repeat: no-repeat;
      background-size: cover;
    }
  </style>
</head>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-6 col-md-6 d-flex flex-column align-items-center justify-content-center">
              <div class="card mb-6">
                <div class="card-body">
                  <div class="d-flex justify-content-center py-4">
                    <a href="#" class="logo d-flex align-items-center w-auto">
                      <span class="d-none d-lg-block">
                        <h1>Cooperativa Libertadores</h1>
                      </span>
                    </a>
                  </div>

                  <form class="row g-3 needs-validation" novalidate action="login.php" method="POST">

                    <div class="col-12">
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">Usuario</span>
                        <input type="text" name="username" class="form-control" id="yourUsername" required>
                        <div class="invalid-feedback">Ingrese su usuario por favor.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">Clave &nbsp; &nbsp; </span>

                        <input type="password" class="form-control" id="password" name="password" required>
                        <div class="input-group-append">
                          <button id="togglePassword" class="btn btn-outline-secondary" type="button">Mostrar</button>
                        </div>
                        <div class="invalid-feedback">Ingrese su contraseña por favor.</div>
                      </div>
                    </div>
                    <div class="col-6">
                      <button class="btn btn-primary w-100" type="submit">Ingresar</button>
                    
                    </div>
                    <div class="col-6">
                    <a href="../" class="btn btn-danger w-100">Volver</a>
                      </div>

                  </form>

                </div>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  <script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');
    togglePassword.addEventListener('click', function(e) {
      // toggle the type attribute
      const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
      password.setAttribute('type', type);
      // toggle the text of this button
      this.textContent = type === 'password' ? 'Mostrar' : 'Ocultar';
    });
  </script>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>