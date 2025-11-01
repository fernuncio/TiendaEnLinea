<?php

    require_once "conexion.php";

    //VARIABLES
    $user = $email = $password = $confi_password = "";
    $username_error = $email_error = $password_err = $confi_password_err = ""; 

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        //VALIDANDO INPUT DE NOMBRE DE USUARIO
       if(empty(trim($_POST["user"]))){
        $username_error = "Por favor, ingrese un nombre de usuario";
       }else{
        //Prepara una declaración de selección
        $sql = "SELECT id_usuario FROM usuarios WHERE nombre = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_user);

            $param_user = trim($_POST["user"]);

            if(mysqli_stmt_execute($stmt)){ 
                mysqli_stmt_store_result($stmt); 

                if(mysqli_stmt_num_rows($stmt) == 1){ 
                    $username_error = "Este nombre de usuario ya esta registrado"; 
                }else{
                    $user = trim($_POST["user"]);
                }
            }else{
                echo "Ups! Algo salió mal, inténtalo más tarde."; 
            }
            mysqli_stmt_close($stmt); 
        }
       }
       
        //VALIDANDO INPUT DE EMAIL
       if(empty(trim($_POST["email"]))){
        $email_error = "Por favor, ingrese un correo electronico";
       }else{
        //Prepara una declaración de selección
        $sql = "SELECT id_usuario FROM usuarios WHERE email = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_email);

            $param_email = trim($_POST["email"]);

            if(mysqli_stmt_execute($stmt)){ 
                mysqli_stmt_store_result($stmt); 

                if(mysqli_stmt_num_rows($stmt) == 1){
                    $email_error = "Este correo ya esta en uso"; 
                }else{
                    $email = trim($_POST["email"]);
                }
            }else{
                echo "Ups! Algo salió mal, inténtalo más tarde.";
            }
            mysqli_stmt_close($stmt); 
        }
       }
       
       //VALIDAR CONTRASEÑA
       if(empty(trim($_POST["password"]))){
        $password_err = "Por favor, ingrese una contraseña";
       }else if(strlen(trim($_POST["password"])) < 6){
        $password_err = "La contraseña debe de tener al menos 6 caracteres";
       }else{
        $password = trim($_POST["password"]);
       }


       // Validar confirmación de contraseña
       if(empty(trim($_POST["confi_password"]))){
            $confi_password_err = "Por favor, confirme su contraseña";
       } else {
            $confi_password = trim($_POST["confi_password"]);
            if($password != $confi_password){
                $confi_password_err = "Las contraseñas no coinciden";
            }
       }



       //COMPROBANDO LOS ERRORES DE ENTRADA ANTES DE INSERTAR LOS DATOS EN LA BASE DE DATOS
       if(empty($username_error) && empty($email_error) && empty($password_err) && empty($confi_password_err)){

        $sql = "INSERT INTO usuarios (nombre, email, contrasena, rol) VALUES (?, ?, ?, 'cliente')"; // ✅ Corregido usuario → nombre y 'cliente )

        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "sss", $param_user, $param_email, $param_password); // ✅ Corregido msqly → mysqli

            //ESTABLECIENDO PARAMETROS
            $param_user = $user;
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT); //ENCRIPTANDO CONTRASEÑA

            if(mysqli_stmt_execute($stmt)){
                header("location: iniciarSesion.html");
                exit(); 
            }else{
                echo "Algo Salio mal, intentalo más tarde";
            }
            mysqli_stmt_close($stmt); 
        }
       }

       mysqli_close($link); 
        
    }

?>