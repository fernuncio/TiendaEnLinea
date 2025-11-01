<?php
// INICIALIZAR SESION
session_start();

// SI YA ESTÁ LOGEADO, REDIRIGIR
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;
}

require_once "Configuracion/database.php";
$db = new Database();
$pdo = $db->conectar();

$email = $password = "";
$email_error = $password_error = "";

if($_SERVER["REQUEST_METHOD"] === "POST"){

    // VALIDAR EMAIL
    if(empty(trim($_POST["email"]))){
        $email_error = "Por favor ingrese su correo electrónico";
    } else {
        $email = trim($_POST["email"]);
    }

    // VALIDAR CONTRASEÑA
    if(empty(trim($_POST["password"]))){
        $password_error = "Por favor ingrese su contraseña";
    } else {
        $password = trim($_POST["password"]);
    }

    // SI NO HAY ERRORES → CONSULTAR
    if(empty($email_error) && empty($password_error)){

        $sql = "SELECT id_usuario, nombre, email, contrasena, rol FROM usuarios WHERE email = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);

        // ¿EXISTE EL USUARIO?
        if($stmt->rowCount() == 1){
            $fila = $stmt->fetch(PDO::FETCH_ASSOC);

            $id = $fila["id_usuario"];
            $nombre = $fila["nombre"];
            $email_db = $fila["email"];
            $hashed_password = $fila["contrasena"];
            $rol = $fila["rol"];

            // VERIFICAR CONTRASEÑA
            if(password_verify($password, $hashed_password)){

                // ASIGNAR VARIABLES DE SESIÓN
                $_SESSION["loggedin"] = true;
                $_SESSION["id_usuario"] = $id;
                $_SESSION["nombre"] = $nombre;
                $_SESSION["email"] = $email_db;
                $_SESSION["rol"] = $rol;

                // REDIRECCIÓN SEGÚN ROL
                if($rol == "admin"){
                    header("location: admin/dashboard.php");
                } else {
                    header("location: index.php");
                }
                exit;

            } else {
                $password_error = "La contraseña es incorrecta";
            }

        } else {
            $email_error = "No se encontró ninguna cuenta con ese correo";
        }
    }
}
?>