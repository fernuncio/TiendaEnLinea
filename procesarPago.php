<?php

ob_start(); 

session_start();

header('Content-Type: application/json');

ini_set('display_errors', 0); 
//incluimos nuestra clase conexión y manejamos nuestro error 
if (!file_exists('Configuracion/database.php')) {
    echo json_encode(['status' => 'error', 'message' => 'Fallo interno: No se encontró el archivo de conexión.']);
    // como se usa ob_start() se debe limpiar y enviar la salida antes de exit.
    ob_end_flush(); 
    exit();
}
require_once 'Configuracion/database.php'; 

// instanciar la clase y obtener la conexión
try {
    $db = new Database();
    $pdo = $db->conectar();
} catch (PDOException $e) {
    // si la conexión falla se detiene y devuelve un error
    echo json_encode(['status' => 'error', 'message' => 'Fallo en la conexión a la base de datos: ' . $e->getMessage()]);
    ob_end_flush(); 
    exit();
}

// validamos los datos del carrito
if (!isset($_SESSION['carrito']) || empty($_SESSION['carrito'])) {
    echo json_encode(['status' => 'error', 'message' => 'El carrito de compras está vacío.']);
    ob_end_flush();
    exit();
}

// obtenemos los datos del cliente y total
$total_general = 0; 
foreach ($_SESSION['carrito'] as $item) {
    $precio = $item['precio'] ?? 0;
    $cantidad = $item['cantidad'] ?? 0;
    $total_general += $precio * $cantidad;
}

$id_usuario = isset($_SESSION["id_usuario"]) ? $_SESSION["id_usuario"] : NULL;
$nombre_cliente = isset($_SESSION["nombre"]) ? $_SESSION["nombre"] : "Cliente Invitado";
$email_cliente = isset($_SESSION["email"]) ? $_SESSION["email"] : "invitado_" . time() . "@ejemplo.com"; 

//iniciar la transaccion
$pdo->beginTransaction();

try {
    // insertamos en ventas
    $sql_venta = "INSERT INTO ventas (id_usuario, nombre_cliente, email_cliente, total, estado) 
                  VALUES (?, ?, ?, ?, 'completado')";
    $stmt_venta = $pdo->prepare($sql_venta);
    $stmt_venta->execute([$id_usuario, $nombre_cliente, $email_cliente, $total_general]);
    $id_venta = $pdo->lastInsertId();

    if (!$id_venta) {
        throw new Exception("Error al obtener el ID de la venta.");
    }
    
    //Binsertamos en detalle venta y actualizamos nuestro inventario(producto)
    foreach ($_SESSION['carrito'] as $item) {

       //
       if (!isset($item['id_producto'], $item['cantidad'], $item['precio'])) {
            throw new Exception("Datos de producto incompletos o corruptos encontrados en el carrito. La venta se cancela.");
       }

        $id_producto = (int) $item['id_producto']; 
        $cantidad = $item['cantidad'];
        $precio_unitario = $item['precio'];
        
        if ($id_producto === 0) {
            throw new Exception("El ID de producto ('" . $item['id_producto'] . "') no es un número válido. Venta cancelada.");
        }


        // insertamos detalle de la venta
        $sql_detalle = "INSERT INTO detalle_venta (id_venta, id_producto, cantidad, precio_unitario) 
                        VALUES (?, ?, ?, ?)";
        $stmt_detalle = $pdo->prepare($sql_detalle);
        $stmt_detalle->execute([$id_venta, $id_producto, $cantidad, $precio_unitario]);
        
        // descontamos el producto de nuestro inventario
        $sql_stock = "UPDATE productos SET stock = stock - ? WHERE id_producto = ? AND stock >= ?";
        $stmt_stock = $pdo->prepare($sql_stock);
        $stmt_stock->execute([$cantidad, $id_producto, $cantidad]); 

        // checar si el stock se actualizo
        if ($stmt_stock->rowCount() === 0) {
            throw new Exception("Stock insuficiente o el producto ID " . $id_producto . " ya no existe.");
        }
    }

    // si no hay error realizamos la transaccion
    $pdo->commit();
    
    // vaciamos el carro
    unset($_SESSION['carrito']); 

    // regresamos la respuesta al js
    echo json_encode(['status' => 'success', 'message' => 'Venta registrada con éxito.', 'venta_id' => $id_venta]);

} catch (Exception $e) {
    // si hay un error cancelamos nuestra tranaccion
    $pdo->rollBack();
    // devolvemos una respuesta de error al frontend
    echo json_encode(['status' => 'error', 'message' => 'Error de la DB: ' . $e->getMessage()]);

} finally {
    ob_end_flush(); 
}
?>