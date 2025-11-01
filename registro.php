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
             
            <form class="formulario" action= "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> " method="post">
            <fieldset>
                <legend>ÚNETE A Formula 1 Store</legend>
                <p class="text-muted-foreground" style="text-align: center;">Crea tu cuenta y accede a beneficios exclusivos</p>
                <br>
                <br>
                <div class="campo">
                    <label>Nombre </label>
                    <input class="input-text" type="text" placeholder="Nombre" name="user" >
                    
                     <span class="msg-error" style="color: red; display: block;"><?php echo $username_error; ?></span>
                    <br>
                    
                    <label>Email</label>
                    <input class="input-text" type="email" placeholder="user@email.com" name="email">
                    <span class="msg-error" style="color: red; display: block;"><?php echo $email_error; ?></span>
                    <br><br>
                    <label>Contraseña</label>
                    <input class="input-text" type="password" placeholder="******" name="password">
                    <span class="msg-error" style="color: red; display: block;"><?php echo $password_err; ?></span>
                    <br><br>
                    <label>Confirmar contraseña</label>
                    <input class="input-text" type="password" placeholder="******" name="confi_password">
                    <span class="msg-error" style="color: red; display: block;"><?php echo $confi_password_err; ?></span>
                    <br><br>
                    
                    <!-- Botón Crear Cuenta -->
                     <div class="contenedor-boton">
                        <input type="submit" class="btn-crearCuenta" value="Crear Cuenta">
                    </div>
                    
                    <!-- Párrafo de iniciar sesión -->
                    <p class="text-muted-foreground" style="text-align: center;">
                        ¿Ya tienes cuenta? <a href="iniciarSesion.php">Iniciar Sesión</a>
                    </p>
                </div>
             </fieldset>
            </form>
         </div>
    </section>
    
</body>
</html>