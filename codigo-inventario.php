<?php
session_start();

 // Verifica que sea admin
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["rol"] != "admin"){
    header("location: ../perfil.php");
    exit;
}

require_once "Configuracion/database.php";
$db = new Database();
$pdo = $db->conectar();

$mensaje = "";
$tipo_mensaje = "";


if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $accion = $_POST['accion'] ?? '';
    
    // AGREGA PRODUCTO
    if($accion == 'agregar'){
        $nombre = trim($_POST['nombre']);
        $descripcion = trim($_POST['descripcion']);
        $precio = floatval($_POST['precio']);
        $stock = intval($_POST['stock']);
        $disponible = isset($_POST['disponible']) ? 1 : 0;
        $url_img = trim($_POST['URLimg']);
        $equipo = trim($_POST['equipo']);
        
       $sql = "INSERT INTO productos (nombre, descripcion, precio, stock, activo, URLimg, equipo) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        
        if($stmt->execute([$nombre, $descripcion, $precio, $stock, $disponible, $url_img, $equipo])){
            $mensaje = " Producto agregado correctamente";
            $tipo_mensaje = "success";
        } else {
            $mensaje = " Error al agregar el producto";
            $tipo_mensaje = "error";
        }
    }
    
    // EDITA PRODUCTO
    if($accion == 'editar'){
        $id = intval($_POST['id_producto']);
        $nombre = trim($_POST['nombre']);
        $descripcion = trim($_POST['descripcion']);
        $precio = floatval($_POST['precio']);
        $stock = intval($_POST['stock']);
        $disponible = isset($_POST['disponible']) ? 1 : 0;
        $url_img = trim($_POST['URLimg']);
        $equipo = trim($_POST['equipo']);
        
       $sql = "UPDATE productos SET nombre = ?, descripcion = ?, precio = ?, stock = ?, activo = ?, URLimg = ?, equipo = ? WHERE id_producto = ?";
        $stmt = $pdo->prepare($sql);
        
        if($stmt->execute([$nombre, $descripcion, $precio, $stock, $disponible, $url_img, $equipo, $id])){
            $mensaje = " Producto actualizado correctamente";
            $tipo_mensaje = "success";
        } else {
            $mensaje = " Error al actualizar el producto";
            $tipo_mensaje = "error";
        }
    }
    
    // ELIMINA PRODUCTO(S)
    if($accion == 'eliminar'){
        if(isset($_POST['productos_seleccionados']) && is_array($_POST['productos_seleccionados'])){
            $ids = $_POST['productos_seleccionados'];
            $placeholders = str_repeat('?,', count($ids) - 1) . '?';
            
            $sql = "DELETE FROM productos WHERE id_producto IN ($placeholders)";
            $stmt = $pdo->prepare($sql);
            
            if($stmt->execute($ids)){
                $mensaje = " Producto(s) eliminado(s) correctamente";
                $tipo_mensaje = "success";
            } else {
                $mensaje = " Error al eliminar";
                $tipo_mensaje = "error";
            }
        } else {
            $mensaje = " Selecciona al menos un producto para eliminar";
            $tipo_mensaje = "warning";
        }
    }
    
    // AUMENTA STOCK
    if($accion == 'aumentar_stock'){
        $id = intval($_POST['id_producto']);
        $cantidad = intval($_POST['cantidad']);
        
        $sql = "UPDATE productos SET stock = stock + ? WHERE id_producto = ?";
        $stmt = $pdo->prepare($sql);
        
        if($stmt->execute([$cantidad, $id])){
            $mensaje = " Stock aumentado";
            $tipo_mensaje = "success";
        }
    }
    
    // REDUCE STOCK
    if($accion == 'reducir_stock'){
        $id = intval($_POST['id_producto']);
        $cantidad = intval($_POST['cantidad']);
        
        $sql = "UPDATE productos SET stock = GREATEST(stock - ?, 0) WHERE id_producto = ?";
        $stmt = $pdo->prepare($sql);
        
        if($stmt->execute([$cantidad, $id])){
            $mensaje = " Stock reducido";
            $tipo_mensaje = "success";
        }
    }
}

// OBTIENE TODOS LOS PRODUCTOS
$sql = "SELECT * FROM productos ORDER BY id_producto DESC";
$stmt = $pdo->query($sql);
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// OBTIENE PRODUCTO PARA EDITAR
$producto_editar = null;
if(isset($_GET['editar'])){
    $id_editar = intval($_GET['editar']);
    $sql = "SELECT * FROM productos WHERE id_producto = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_editar]);
    $producto_editar = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>