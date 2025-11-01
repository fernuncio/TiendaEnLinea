<?php
session_start();

// Verificar si está logueado
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: iniciarSesion.php");
    exit;
}

require_once "conexion.php";

$id_usuario = $_SESSION["id_usuario"];

// Obtener estadísticas del usuario
$total_pedidos = 0;
$total_gastado = 0;

$sql = "SELECT COUNT(*) as total_pedidos, IFNULL(SUM(total), 0) as total_gastado 
        FROM ventas 
        WHERE id_usuario = ?";
        
if($stmt = mysqli_prepare($link, $sql)){
    mysqli_stmt_bind_param($stmt, "i", $id_usuario);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    if($row = mysqli_fetch_assoc($resultado)){
        $total_pedidos = $row['total_pedidos'];
        $total_gastado = $row['total_gastado'];
    }
    mysqli_stmt_close($stmt);
}

// Obtener últimas 5 compras
$sql_compras = "SELECT id_venta, total, fecha, estado 
                FROM ventas 
                WHERE id_usuario = ? 
                ORDER BY fecha DESC 
                LIMIT 5";
                
$ultimas_compras = [];
if($stmt = mysqli_prepare($link, $sql_compras)){
    mysqli_stmt_bind_param($stmt, "i", $id_usuario);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    while($row = mysqli_fetch_assoc($resultado)){
        $ultimas_compras[] = $row;
    }
    mysqli_stmt_close($stmt);
}

mysqli_close($link);

// Obtener inicial del nombre
$inicial = strtoupper(substr($_SESSION["nombre"], 0, 1));

// Calcular membresía
if($total_gastado >= 5000) {
    $membresia = "Platinum";
} elseif($total_gastado >= 2000) {
    $membresia = "Gold";
} elseif($total_gastado >= 500) {
    $membresia = "Silver";
} else {
    $membresia = "Bronze";
}

// Calcular puntos F1
$puntos_f1 = $total_pedidos * 10;
?>