<?php
session_start();

// checamos que se recibio la clave del producto
if (isset($_GET['clave'])) {
    
    $clave_a_eliminar = $_GET['clave'];
    
    // verificar si existe el carrito y la clave en el
    if (isset($_SESSION['carrito']) && array_key_exists($clave_a_eliminar, $_SESSION['carrito'])) {
        
        //eliminar elemento
        unset($_SESSION['carrito'][$clave_a_eliminar]);
        
        // agregar mensaje(no esta)
        $_SESSION['mensaje'] = "Producto eliminado del carrito.";
        
    } else {
        // si no existe mostar(no esta)
        $_SESSION['mensaje'] = "Error: El producto no se encontró en el carrito.";
    }
}

// volver al inicio
header('Location: verCarrito.php');
exit();
?>