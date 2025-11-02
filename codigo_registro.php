<?php
require_once "Configuracion/database.php";  

$db = new Database();
$pdo = $db->conectar();

// VARIABLES
$user = $email = $password = $confi_password = "";
$username_error = $email_error = $password_err = $confi_password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    // VALIDA NOMBRE DE USUARIO
    if(empty(trim($_POST["user"]))){
        $username_error = "Por favor, ingrese un nombre de usuario";
    } else {
        $sql = "SELECT id_usuario FROM usuarios WHERE nombre = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([trim($_POST["user"])]);
        
        if($stmt->rowCount() == 1){
            $username_error = "Este nombre de usuario ya está registrado";
        } else {
            $user = trim($_POST["user"]);
        }
    }

    // VALIDA EMAIL
    if(empty(trim($_POST["email"]))){
        $email_error = "Por favor, ingrese un correo electrónico";
    } else {
        $sql = "SELECT id_usuario FROM usuarios WHERE email = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([trim($_POST["email"])]);
        
        if($stmt->rowCount() == 1){
            $email_error = "Este correo ya está en uso";
        } else {
            $email = trim($_POST["email"]);
        }
    }

    // VALIDA CONTRASEÑA
    if(empty(trim($_POST["password"]))){
        $password_err = "Por favor, ingrese una contraseña";
    } else if(strlen(trim($_POST["password"])) < 6){
        $password_err = "La contraseña debe tener mínimo 6 caracteres";
    } else {
        $password = trim($_POST["password"]);
    }

    // CONFIRMA CONTRASEÑA
    if(empty(trim($_POST["confi_password"]))){
        $confi_password_err = "Por favor, confirme su contraseña";
    } else {
        $confi_password = trim($_POST["confi_password"]);
        if($password != $confi_password){
            $confi_password_err = "Las contraseñas no coinciden";
        }
    }

    // SI NO HAY ERRORES → INSERTAR
    if(empty($username_error) && empty($email_error) && empty($password_err) && empty($confi_password_err)){
        $sql = "INSERT INTO usuarios (nombre, email, contrasena, rol) VALUES (?, ?, ?, 'cliente')";
        $stmt = $pdo->prepare($sql);
        
        if($stmt->execute([$user, $email, password_hash($password, PASSWORD_DEFAULT)])){
            header("location: iniciarSesion.php");
            exit;
        } else {
            echo "Algo salió mal, inténtalo más tarde.";
        }
    }

}
?>