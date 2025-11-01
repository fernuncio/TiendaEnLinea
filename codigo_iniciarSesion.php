<?php

    //INICIALIZAR LA SESION
    session_start();

    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true){
        header("location: index.php");
        exit;
    }


    require_once "conexion.php";

    $email = $password = "";
    $email_error = $password_error = "";

    if($_SERVER["REQUEST_METHOD"] === "POST"){

        if(empty(trim($_POST["email"]))){
            $email_error = "Por favor, ingrese el correo electronico";
        }else{
            $email = trim($_POST["email"]);
        }

        if(empty(trim($_POST["password"]))){
            $password_error = "Por favor, ingrese una contraseña";
        }else{
            $password = trim($_POST["password"]);
        }


        ///VALIDAR CREDENCIALES
        if(empty($email_error) && empty(trim($password_error))){
            $sql = "SELECT id_usuario, nombre, email, contrasena, rol FROM usuarios where email = ?";

            if($stmt = mysqli_prepare($link, $sql)){
                mysqli_stmt_bind_param($stmt, "s", $param_email);

                $param_email = $email;

                if(mysqli_stmt_execute($stmt)){
                    mysqli_stmt_store_result($stmt);
                }

                 // VERIFICAR SI EL EMAIL EXISTE
                    if(mysqli_stmt_num_rows($stmt) == 1){ 
                        mysqli_stmt_bind_result($stmt, $id, $nombre, $email_db, $hashed_password, $rol); 
                        
                        if(mysqli_stmt_fetch($stmt)){
                            // VERIFICAR CONTRASEÑA
                            if(password_verify($password, $hashed_password)){
                                

                                //ALMACENAR DATOS EN VARIABLE DE SESION
                                $_SESSION["loggedin"] = true;
                                $_SESSION["id_usuario"] = $id;
                                $_SESSION["nombre"] = $nombre; 
                                $_SESSION["email"] = $email_db; 
                                $_SESSION["rol"] = $rol; 

                                // REDIRIGIR SEGÚN ROL
                                if($rol == "admin"){
                                    header("location: admin/dashboard.php");
                                } else {
                                    header("location: index.php");
                                }
                                exit(); 
                            }else{
                                $password_error = "La contraseña es incorrecta";
                            }
                        }
                    }else{
                        $email_error = "No se ha encontrado ninguna cuenta con ese correo";
                    }
                }else{
                    echo "UPS! algo salió mal, inténtalo más tarde";
                }
            }
         if(isset($stmt) && $stmt !== false){
        mysqli_stmt_close($stmt);
        }
    }

?>