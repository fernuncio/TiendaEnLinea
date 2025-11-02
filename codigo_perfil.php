<?php
session_start();

// Verifica si está logueado
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: iniciarSesion.php");
    exit;
}

require_once "Configuracion/database.php";
$db = new Database();
$pdo = $db->conectar();

$id_usuario = $_SESSION["id_usuario"];

// Inicializa valores
$total_pedidos = 0;
$total_gastado = 0;

//  Obtiene las estadísticas del usuario
$sql = "SELECT COUNT(*) AS total_pedidos, IFNULL(SUM(total), 0) AS total_gastado 
        FROM ventas 
        WHERE id_usuario = ?";

$stmt = $pdo->prepare($sql);
$stmt->execute([$id_usuario]);

if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $total_pedidos = $row['total_pedidos'];
    $total_gastado = $row['total_gastado'];
}

// Obtiene las últimas 5 compras
$sql_compras = "SELECT id_venta, total, fecha, estado 
                FROM ventas 
                WHERE id_usuario = ? 
                ORDER BY fecha DESC 
                LIMIT 5";

$stmt = $pdo->prepare($sql_compras);
$stmt->execute([$id_usuario]);

$ultimas_compras = $stmt->fetchAll(PDO::FETCH_ASSOC);

//  Inicial del nombre
$inicial = strtoupper(substr($_SESSION["nombre"], 0, 1));

//  Switch para determinar la membresía
if ($total_gastado >= 5000) {
    $membresia = "Platino";
} elseif ($total_gastado >= 2000) {
    $membresia = "Oro";
} elseif ($total_gastado >= 500) {
    $membresia = "Plata";
} else {
    $membresia = "Bronce";
}

//  Calcular puntos F1
$puntos_f1 = $total_pedidos * 10;

?>