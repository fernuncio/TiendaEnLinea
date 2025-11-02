<?php
// iniciamos sesion
session_start();

// si esta logueado lo mandamos a inicio
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

    // validamos contraseña
    if(empty(trim($_POST["password"]))){
        $password_error = "Por favor ingrese su contraseña";
    } else {
        $password = trim($_POST["password"]);
    }

    // si no tenemos errores consultamos
    if(empty($email_error) && empty($password_error)){

        $sql = "SELECT id_usuario, nombre, email, contrasena, rol FROM usuarios WHERE email = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);

        // ver si existe el usuario
        if($stmt->rowCount() == 1){
            $fila = $stmt->fetch(PDO::FETCH_ASSOC);

            $id = $fila["id_usuario"];
            $nombre = $fila["nombre"];
            $email_db = $fila["email"];
            $hashed_password = $fila["contrasena"];
            $rol = $fila["rol"];

            // verifica contraseña
            if(password_verify($password, $hashed_password)){

                // variables de inicio de sesion 
                $_SESSION["loggedin"] = true;
                $_SESSION["id_usuario"] = $id;
                $_SESSION["nombre"] = $nombre;
                $_SESSION["email"] = $email_db;
                $_SESSION["rol"] = $rol;

                //lo mandamos depende de su rol
                if($rol == "admin"){
                    header("location: inventario.php");
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