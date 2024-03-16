<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
if (!isset($_SESSION['usuario']) && !isset($_SESSION['nivel'])) {
    header('Location: login.php');   
}
    $pagina = isset($_GET['p']) ? strtolower($_GET['p']) : 'inicio';
    $pagina = $pagina . '.php';
    $ruta =  $pagina;
    if (file_exists($ruta)) {
        
        switch ($_SESSION['nivel']) {
            case 0:
                require_once 'header.php';
                require_once 'menu_admin.php';
                break;
            case 1:
                require_once 'header_usuario.php';
                require_once 'menu_usuario.php';
                break;
            case 2:
                require_once 'header_rastreo.php';
                require_once 'menu_rastreo.php';
                break;
            default:
                $ruta = '4f4adcbf8c6f66dcfc8a3282ac2bf10a.php';
                break;
        }
        require_once $ruta;
        require_once 'footer.php';
    } else {
        require_once '4f4adcbf8c6f66dcfc8a3282ac2bf10a.php';
    }