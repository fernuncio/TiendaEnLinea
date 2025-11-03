<?php
// ¡SOLUCIÓN! Capturar el ID de venta desde la URL (la variable $_GET)
$id_venta = $_GET['id'] ?? null;

// Opcional: Si el ID no existe, puedes redirigir o mostrar un error
if (empty($id_venta)) {
    // header("Location: error_pago.php");
    // exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pago Realizado</title>
</head>
<body>
    <h1>
        GRACIAS POR TU PAGO
    </h1>
    
    <p>Tu número de orden es: **<?php echo htmlspecialchars($id_venta); ?>**</p>
    
    <a href="generarRecibo.php?id=<?php echo htmlspecialchars($id_venta); ?>" target="_blank">
        Descargar Recibo de Compra (PDF)
    </a>
</body>
</html>