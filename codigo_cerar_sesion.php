<?php
session_start();

// DestruYe todas las variables de sesión
$_SESSION = array();

// DestruYe la sesión
session_destroy();

// Redirige a la página principal
header("location: index.php");
exit;
?>