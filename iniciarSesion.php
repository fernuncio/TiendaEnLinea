<?php

    require "codigo_iniciarSesion.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
    
    <body class="body-formulario">
    <header>
        <div class="container-hero">
                
                    <div class="container-logo">
                        <img src="img/flagle.png" class="logo" alt="Logo Tienda F1">
                        <h1 class="logo"><a>Formula 1 Store</a></h1>
                    </div>
                
            </div>

    </header>
    
    <section>
         <div class="contenedor-formulario">
             <a href="index.php" class="btn-volver">Volver</a>
            <form class="formulario"  name="formularioLogin"action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <fieldset>
                <legend>Inicia Sesión</legend>
                <p class="text-muted-foreground" style="text-align: center;">Inicia sesión para acceder a tu cuenta y continuar tu experiencia de carreras</p>
                <br>
                <br>
                <div class="campo">
                    
                    <label>Email</label>
                    <input class="input-text" type="email" placeholder="user@email.com" name="email" id="email">
                    <span id="error-correo" class="msg-error" style="color: red; display: block;">
                    <?php echo $email_error; ?>
                    </span>
                    <br><br>
                    <label>Contraseña</label>
                     <input class="input-text" type="password" placeholder="******" name="password" id="password">
                    <span id="error-contraseña" class="msg-error" style="color: red; display: block;">
                    <?php echo $password_error; ?>
                    </span>
                    <br><br>
                    
                    
                    <div class="contenedor-boton">
                        <input type="submit" class="btn-crearCuenta" value="Iniciar Sesión" onclick="return validarLogin();">

                    </div>
                    
                   
                    <p class="text-muted-foreground" style="text-align: center;">
                        ¿No tienes cuenta? <a href="registro.php">Registrate aquí</a>
                    </p>
                </div>
             </fieldset>
            </form>
         </div>
    </section>
    
    <!-- Botón de chat -->
    <div class="chat-widget">
        <span style="font-size: 20px;">💬</span>
        <span>Chatea con Nosotros</span>
    </div>
    <script>
    function validarLogin() {
    document.getElementById('error-correo').textContent = '';
    document.getElementById('error-contraseña').textContent = '';
    
    var correo = document.formularioLogin.email.value;
    var contraseña = document.formularioLogin.password.value;

    if (correo.length == 0) {
        document.getElementById('error-correo').textContent = 'Por favor ingrese su email';
        return false;
    }

    if (contraseña.length == 0) {
        document.getElementById('error-contraseña').textContent = 'Por favor ingrese su contraseña';
        return false;
    }

    var expresionCorreo = /^[^@\s]+@[^@\.\s]+(\.[^@\.\s]+)+$/;

    if (!expresionCorreo.test(correo)) {
        document.getElementById('error-correo').textContent = 'El formato del email no es válido';
        return false;
    }

    if (contraseña.length < 6) {
        document.getElementById('error-contraseña').textContent = 'La contraseña debe tener al menos 6 caracteres';
        return false;
    }

    return true;
}

// Limpiar errores al escribir
    document.getElementById('email').addEventListener('input', function() {
        document.getElementById('error-correo').textContent = '';
    });

    document.getElementById('password').addEventListener('input', function() {
        document.getElementById('error-contraseña').textContent = '';
    });
    </script>
</body>
</html>