<?php
session_start();

// Verificar si está logueado
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: iniciarSesion.php");
    exit;
}

require_once "Configuracion/database.php";
$db = new Database();
$pdo = $db->conectar();

$id_usuario = $_SESSION["id_usuario"];

// Inicializar valores
$total_pedidos = 0;
$total_gastado = 0;

// ✅ Obtener estadísticas del usuario
$sql = "SELECT COUNT(*) AS total_pedidos, IFNULL(SUM(total), 0) AS total_gastado 
        FROM ventas 
        WHERE id_usuario = ?";

$stmt = $pdo->prepare($sql);
$stmt->execute([$id_usuario]);

if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $total_pedidos = $row['total_pedidos'];
    $total_gastado = $row['total_gastado'];
}

// ✅ Obtener últimas 5 compras
$sql_compras = "SELECT id_venta, total, fecha, estado 
                FROM ventas 
                WHERE id_usuario = ? 
                ORDER BY fecha DESC 
                LIMIT 5";

$stmt = $pdo->prepare($sql_compras);
$stmt->execute([$id_usuario]);

$ultimas_compras = $stmt->fetchAll(PDO::FETCH_ASSOC);

// ✅ Inicial del nombre
$inicial = strtoupper(substr($_SESSION["nombre"], 0, 1));

// ✅ Determinar membresía
if ($total_gastado >= 5000) {
    $membresia = "Platinum";
} elseif ($total_gastado >= 2000) {
    $membresia = "Gold";
} elseif ($total_gastado >= 500) {
    $membresia = "Silver";
} else {
    $membresia = "Bronze";
}

// ✅ Calcular puntos F1
$puntos_f1 = $total_pedidos * 10;

?>