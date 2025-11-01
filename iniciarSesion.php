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
            <form class="formulario" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <fieldset>
                <legend>Inicia Sesión</legend>
                <p class="text-muted-foreground" style="text-align: center;">Inicia sesión para acceder a tu cuenta y continuar tu experiencia de carreras</p>
                <br>
                <br>
                <div class="campo">
                    
                    <label>Email</label>
                    <input class="input-text" type="email" placeholder="user@email.com" name="email">
                    <span class="msg-error" style="color: red; display: block;"><?php echo $email_error; ?></span>
                    <br><br>
                    <label>Contraseña</label>
                    <input class="input-text" type="password" placeholder="******" name="password">
                    <span class="msg-error" style="color: red; display: block;"><?php echo $password_error; ?></span>
                    
                    <br><br>
                    
                    
                    <div class="contenedor-boton">
                        <input type="submit" class="btn-crearCuenta" value="Iniciar Sesión">

                    </div>
                    
                   
                    <p class="text-muted-foreground" style="text-align: center;">
                        ¿No tienes cuenta? <a href="registro.php">Registrate aquí</a>
                    </p>
                </div>
             </fieldset>
            </form>
         </div>
    </section>
</body>
</html>