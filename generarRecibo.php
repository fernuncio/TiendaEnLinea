<?php
require 'Configuracion/libreria/dompdf/autoload.inc.php';
use Dompdf\Dompdf;
use Dompdf\Options;

require_once 'Configuracion/database.php'; 

$id_venta = $_GET['id'] ?? null;

if (empty($id_venta) || !is_numeric($id_venta)) {
    die("Error: ID de venta no válido o faltante.");
}

$venta_info = [];
try {
    $db = new Database();
    $pdo = $db->conectar();
    
    $sql = "SELECT
                V.fecha, V.nombre_cliente, V.total AS total_general,
                DV.cantidad, DV.precio_unitario, P.nombre AS nombre_producto
            FROM ventas V
            JOIN detalle_venta DV ON V.id_venta = DV.id_venta
            JOIN productos P ON DV.id_producto = P.id_producto
            WHERE V.id_venta = :id_venta";
    
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id_venta', $id_venta, PDO::PARAM_INT);
    $stmt->execute();
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($resultados)) { die("Error: No se encontraron detalles para la venta ID " . $id_venta); }

    $venta_info = [
        'id_venta' => $id_venta, 'fecha' => $resultados[0]['fecha'],
        'cliente' => $resultados[0]['nombre_cliente'], 'total' => $resultados[0]['total_general'],
        'items' => []
    ];
    foreach ($resultados as $row) {
        $venta_info['items'][] = [
            'nombre' => $row['nombre_producto'], 'cantidad' => (int)$row['cantidad'],
            'precio' => (float)$row['precio_unitario'], 'subtotal_item' => $row['cantidad'] * $row['precio_unitario']
        ];
    }
} catch (PDOException $e) { die("Error de base de datos: " . $e->getMessage()); }

$tasa_impuesto = 0.16;
$subtotal_calculado = $venta_info['total'] / (1 + $tasa_impuesto);
$impuesto_calculado = $venta_info['total'] - $subtotal_calculado;

//generar el html para dompdf
ob_start(); 
?>
<html>
<head>
<style>

body { font-family: monospace; font-size: 10pt; margin: 0 auto; padding: 20px; } 

.center { text-align: center; }
.right { text-align: right; }
.top { vertical-align: top; }


.header h1 { margin: 0 !important; font-size: 18pt; } 
.header p { margin: 0 !important; font-size: 10pt; } 
.info-p { margin: 10px 0 10px 0 !important; line-height: 1.5; } 

.divider { border-top: 1px dashed black; margin: 10px 0; }

.item-list { 
    width: 100%; 
    border-collapse: collapse;
    table-layout: fixed; 
}
.item-list th, .item-list td { padding: 3px 5px; } 
.item-list th { text-align: left; }

.item-list .desc-col { 
    width: 60%; 
    word-wrap: break-word; 
}
.item-list .quant-col { 
    width: 10%; 
    text-align: center; 
}
.item-list .price-col { 
    width: 15%;
    text-align: right; 
}


.totals-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px; 
}
.totals-table td { padding: 2px 5px; font-size: 11pt; }
.totals-table .total-label { width: 70%; text-align: left; }
.totals-table .total-value { width: 30%; text-align: right; }
.totals-table .total-row-final td {
    font-size: 12pt; font-weight: bold; border-top: 1px dashed black; 
    padding-top: 8px;
}
</style>
</head>
<body>
<div class="center header">
************************************************
<h1>FORMULA 1 STORE</h1>
************************************************
<p>¡Velocidad y Estilo en Cada Compra!</p>
</div>

<div class="divider"></div>

<p class="info-p">
**Venta ID:** <?php echo htmlspecialchars($venta_info['id_venta']); ?><br>
**Cliente:** <?php echo htmlspecialchars($venta_info['cliente']); ?><br>
**Fecha:** <?php echo date('d/m/Y H:i:s', strtotime($venta_info['fecha'])); ?>
</p>

<div class="divider"></div>
<table class="item-list">
<thead>
<tr>
<th class="desc-col">DESCRIPCIÓN</th>
<th class="quant-col">CANT</th>
<th class="price-col">PRECIO UNIT.</th>
<th class="price-col">SUBTOTAL</th>
</tr>
</thead>
<tbody>
<?php foreach ($venta_info['items'] as $item): ?>
<tr>
    <td class="desc-col top"><?php echo htmlspecialchars($item['nombre']); ?></td> 
<td class="quant-col top"><?php echo $item['cantidad']; ?></td>
<td class="price-col top">$<?php echo number_format($item['precio'], 2); ?></td>
<td class="price-col top">$<?php echo number_format($item['subtotal_item'], 2); ?></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>

<div class="divider"></div>
<table class="totals-table"> 
<tr>
<td class="total-label">SUBTOTAL</td>
<td class="total-value">$<?php echo number_format($subtotal_calculado, 2); ?></td>
</tr>
<tr>
<td class="total-label">IMPUESTO (16%)</td>
<td class="total-value">$<?php echo number_format($impuesto_calculado, 2); ?></td>
</tr>
<tr class="total-row-final">
<td class="total-label">**TOTAL**</td>
<td class="total-value">$<?php echo number_format($venta_info['total'], 2); ?></td>
</tr>
</table>

<div class="divider"></div>

<div class="center">
    **GRACIAS POR SU PREFERENCIA**
    </div>
</body>
</html>
<?php
$html = ob_get_clean(); // Captura el HTML generado

// genera y envia el pdf a dompdf
$options = new Options();
$options->setIsRemoteEnabled(true);
$dompdf = new Dompdf($options);

$dompdf->loadHtml($html);

// tamaño de la hoja A4
$dompdf->setPaper('A4', 'portrait'); 

$dompdf->render();

// Enviar el archivo al navegador
$dompdf->stream('Recibo_F1_' . $id_venta . '.pdf', array("Attachment" => false));
exit;
?>