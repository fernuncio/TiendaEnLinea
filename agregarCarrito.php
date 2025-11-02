<?php
session_start();

// se verifica si se ha dado clic a nuestro boton
if (isset($_POST['añadir_carrito'])) {
    
    // datos del formulario
    $producto_id = htmlspecialchars($_POST['producto_id']);
    $nombre = htmlspecialchars($_POST['nombre']);
    // convetir el precio y la cantidad a números flotantes/enteros
    $precio = (float) $_POST['precio']; 
    $talla = htmlspecialchars($_POST['talla']);
    $cantidad = (int) $_POST['cantidad'];
    
    // que los atributos talla tenga algo y cantidad no sea negativa o 0
    if (empty($talla) || $cantidad < 1) {
        // Manejar el error
        header('Location: index.php?error=selecciona_talla_o_cantidad');
        exit();
    }
    
    // 5. Inicializar el carrito si no existe
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }
    
    // crear una clave unica para identificr nuestro produc
    $clave_unica = $producto_id . '_' . $talla;

    // if para ver si el producto se añade o se suma a lo que ya esta
    if (array_key_exists($clave_unica, $_SESSION['carrito'])) {
        // si el producto y su talla esta en el carro solo lo suma
        $_SESSION['carrito'][$clave_unica]['cantidad'] += $cantidad;
    } else {
        // si no lo agrega
        $_SESSION['carrito'][$clave_unica] = [
            'id' => $producto_id,
            'nombre' => $nombre,
            'precio' => $precio,
            'talla' => $talla,
            'cantidad' => $cantidad
        ];
    }

    //evitar que se reencie en formulario
    header('Location: verCarrito.php'); 
    exit();
    
} else {
    //si se intenta acceder a este php lo devuelve al inicio
    header('Location: index.php');
    exit();
}
?>