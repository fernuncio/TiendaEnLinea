<?php
session_start();

if (isset($_POST['añadir_rapido'])) {
    
    // datos del producto
    $producto_id = htmlspecialchars($_POST['producto_id']);
    $nombre = htmlspecialchars($_POST['nombre']);
    $precio = (float) $_POST['precio'];
    $cantidad = (int) $_POST['cantidad']; //es 1 
    $talla = htmlspecialchars($_POST['talla']); // por defecto que esta declarada

    // se inicializa el carrito si es que no exite
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }
    
    // 3. creamos una clave unica
    $clave_unica = $producto_id . '_' . $talla;

    // añadir
    if (array_key_exists($clave_unica, $_SESSION['carrito'])) {
        $_SESSION['carrito'][$clave_unica]['cantidad'] += $cantidad;
    } else {
        $_SESSION['carrito'][$clave_unica] = [
            'id_producto' => $producto_id, 
            'nombre' => $nombre,
            'precio' => $precio,
            'talla' => $talla,
            'cantidad' => $cantidad
        ];
    }
    
    // lo regresamos al inicio nuevamente
    $_SESSION['mensaje_carrito'] = "Producto añadido al carrito.";
    header('Location: index.php'); // Redirige a la página anterior
    exit();
}
//si se quiere acceder directamente al archivo se manda al inicio
header('Location: index.php');
exit();
?>