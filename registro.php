<?php
    include 'codigo_registro.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="style.css"/>
</head>
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
            
            <form class="formulario" name="formularioRegistro"
            action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"
            method="post" onsubmit="return validarRegistro()">

                <fieldset>
                    <legend>ÚNETE A Formula 1 Store</legend>
                    <p class="text-muted-foreground" style="text-align: center;">
                        Crea tu cuenta y accede a beneficios exclusivos
                    </p>
                    <br><br>

                    <div class="campo">
                        <label>Nombre</label>
                        <input class="input-text" type="text" placeholder="Nombre" name="user" id="user">
                        <span id="error-usuario" class="msg-error" style="color:red;display:block;">
                        <?php echo $username_error; ?>
                        </span>
                        <br>

                        <label>Email</label>
                        <input class="input-text" type="email" placeholder="user@email.com" name="email" id="email">
                        <span id="error-correo" class="msg-error" style="color:red;display:block;">
                        <?php echo $email_error; ?>
                        </span>

                        <br><br>

                        <label>Contraseña</label>
                        <input class="input-text" type="password" placeholder="******" name="password" id="password">
                        <span id="error-contraseña" class="msg-error" style="color:red;display:block;">
                        <?php echo $password_err; ?>
                        </span>
                        <br><br>

                        <label>Confirmar contraseña</label>
                        <input class="input-text" type="password" placeholder="******" name="confi_password" id="confi_password">
                        <span id="error-confirmar-contraseña" class="msg-error" style="color:red;display:block;">
                        <?php echo $confi_password_err; ?>
                        </span>
                        <br><br>

                        <div class="contenedor-boton">
                            <input type="submit" class="btn-crearCuenta" value="Crear Cuenta">
                        </div>

                        <p class="text-muted-foreground" style="text-align: center;">
                            ¿Ya tienes cuenta? <a href="iniciarSesion.php">Iniciar Sesión</a>
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

    <!-- SCRIPT CORREGIDO -->
    <script>
        function validarRegistro() {
    // Asegúrate que los elementos existan
    var eUsuario = document.getElementById('error-usuario');
    var eCorreo = document.getElementById('error-correo');
    var ePass = document.getElementById('error-contraseña');
    var ePassConf = document.getElementById('error-confirmar-contraseña');
    if (!eUsuario || !eCorreo || !ePass || !ePassConf) {
        // Si faltan elementos, permitimos submit para evitar bloquear la página
        return true;
    }

    // Limpiar
    eUsuario.textContent = '';
    eCorreo.textContent = '';
    ePass.textContent = '';
    ePassConf.textContent = '';

    var usuario = document.formularioRegistro.user.value.trim();
    var correo = document.formularioRegistro.email.value.trim();
    var contraseña = document.formularioRegistro.password.value;
    var confirmarContraseña = document.formularioRegistro.confi_password.value;
    var hayErrores = false;

    // regex letras Unicode y espacios
    var expresionNombre = /^[\p{L}\s]+$/u;

    if (usuario.length === 0) {
        eUsuario.textContent = 'Por favor ingrese su nombre';
        hayErrores = true;
    } else if (!expresionNombre.test(usuario)) {
        eUsuario.textContent = 'El nombre solo debe contener letras y espacios';
        hayErrores = true;
    }

    var expresionCorreo = /^[^@\s]+@[^@\.\s]+(\.[^@\.\s]+)+$/;
    if (correo.length === 0) {
        eCorreo.textContent = 'Por favor ingrese su email';
        hayErrores = true;
    } else if (!expresionCorreo.test(correo)) {
        eCorreo.textContent = 'El formato del email no es válido';
        hayErrores = true;
    }

    if (contraseña.length === 0) {
        ePass.textContent = 'Por favor ingrese una contraseña';
        hayErrores = true;
    } else if (contraseña.length < 6) {
        ePass.textContent = 'La contraseña debe tener al menos 6 caracteres';
        hayErrores = true;
    }

    if (confirmarContraseña.length === 0) {
        ePassConf.textContent = 'Por favor confirme su contraseña';
        hayErrores = true;
    } else if (contraseña !== confirmarContraseña) {
        ePassConf.textContent = 'Las contraseñas no coinciden';
        hayErrores = true;
    }

    return !hayErrores;
}

// listeners para limpiar
        document.getElementById('user')?.addEventListener('input', () => document.getElementById('error-usuario').textContent = '');
        document.getElementById('email')?.addEventListener('input', () => document.getElementById('error-correo').textContent = '');
        document.getElementById('password')?.addEventListener('input', () => document.getElementById('error-contraseña').textContent = '');
        document.getElementById('confi_password')?.addEventListener('input', () => document.getElementById('error-confirmar-contraseña').textContent = '');
    </script>

</body>
</html>
