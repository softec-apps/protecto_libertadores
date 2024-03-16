<?php
include_once 'conexion.php';
$id_bodegaje = $_GET['id'];
$sql = "SELECT * FROM bodegaje WHERE id = ?";
$query = $pdo->prepare($sql);
$query->execute(array($id_bodegaje));
$resultado = $query->fetch();

?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js"></script>

<script>
    var resultado = <?php echo json_encode($resultado); ?>;

    var doc = new jsPDF();
    doc.setFontSize(18);
    doc.text("Reporte de Bodegaje", 10, 20);
    doc.setFontSize(14);
    doc.text("Datos:", 10, 30);

    var y = 40;
    doc.setFontSize(12);
    doc.text("Cliente: " + resultado.cliente_nombres, 20, y);
    y += 10;
    doc.text("Bodega: " + resultado.bodega, 20, y);
    y += 10;
    doc.text("Detalle de la mercadería: " + resultado.mercaderia_almacenada, 20, y);
    y += 10;
    doc.text("Espacio Ocupado: " + resultado.espacio_ocupado, 20, y);
    y += 10;

    doc.save('Comprobante_Mercaderia'+resultado.id+'.pdf');
</script>
<?php

echo "<script>window.history.back();</script>";
?>