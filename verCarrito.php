<?php
session_start();
$usuario_logueado = isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tu Carrito de Compras</title>
    <link rel="stylesheet" href="style.css"/>
    <link rel="icon" type="image/x-icon" href="img/volante.png">
</head>

<body>
    <header>
            <div class="container-hero">
                <div class="container hero">
                    <div class="customer-support">
                         <img src="img/suport.png" class="logo-user" alt="Logo Soporte">
                        <div class="content-customer-support">
                            <span class="text">Soporte al clinte</span>
                            <span class="number">123-456</span>
                        </div>
                    </div>
                    <div class="container-logo">
                        <img src="img/flagle.png" class="logo" alt="Logo Tienda F1">
                        <h1 class="logo"><a href="index.php">Formula 1 Store</a></h1>
                    </div>
                    <div class="container-user">
                        <?php if($usuario_logueado): ?>
                            <a href="perfil.php" title="Mi Perfil">
                                <img src="img/user.png" class="logo-user" alt="Logo User">
                            </a>
                            <span class="text" style="margin-left: 5px; color: #666;">
                                Hola, <?php echo htmlspecialchars($_SESSION["nombre"]); ?>
                            </span>
                        <?php else: ?>
                            <a href="iniciarSesion.php" title="Iniciar Sesión">
                                <img src="img/user.png" class="logo-user" alt="Logo User">
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="container-navbar">
                <nav class="navbar container">
                    <img src="img/barsM.png" class="logo-menu" alt="Logo Menu" width="15" height="auto">
                    <ul class="menu">
                        <li><a href="index.php">Inicio</a></li>
                        <li class="dropdown"><a href="#">Comprar por Equipo</a>
                             <ul class="dropdown-content">
                                <li><a href="#">Mercedes</a></li>
                                <li><a href="FerrariTeam.php">Ferrari</a></li>
                                <li><a href="#">Hass</a></li>
                                <li><a href="#">Kick Sauber</a></li>
                                <li><a href="#">Williams</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Coleccionables</a></li>
                        <li><a href="#">Ofertas</a></li>
                        <li><a href="#">Contacto</a></li>
                        <li><a href="perfil.php">Mi Cuenta</a></li>
                    </ul>
                    <form class="search-form">
                        <input type="search" placeholder="Buscar..."/>
                        <button class="btn-search">
                            <img src="img/search.png" class="logo-user" alt="Logo Search">
                        </button>
                    </form>
                </nav>
            </div>
        </header>

   <main class="body-cart">
    <h1>Carrito de Compras</h1>

    <?php
    // Verifica si el carrito está vacío o no está inicializado
    if (empty($_SESSION['carrito'])) {
        echo '<p class="empty-message">Tu carrito está vacío. ¡Añade algunos productos!</p>';
    } else {
        $total_general = 0; // Inicializa el total para toda la compra
        ?>

        <table class="carrito-tabla">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Talla</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario (US$)</th>
                    <th>Subtotal (US$)</th>
                    <th>Eliminar</th> 
                </tr>
            </thead>
            <tbody>
            
            <?php
            // Itera sobre cada producto en el array de la sesión
            foreach ($_SESSION['carrito'] as $clave_unica => $item) {
                // Calcula el subtotal para el item actual
                $subtotal = $item['precio'] * $item['cantidad'];
                // Suma el subtotal al total general
                $total_general += $subtotal;
                ?>
                
                <tr>
                    <td><?php echo htmlspecialchars($item['nombre']); ?></td>
                    <td><?php echo htmlspecialchars($item['talla']); ?></td>
                    <td><?php echo htmlspecialchars($item['cantidad']); ?></td>
                    <td><?php echo number_format($item['precio'], 2); ?></td>
                    <td><?php echo number_format($subtotal, 2); ?></td>
                    <td>
                        <a href="eliminarProducto.php?clave=<?php echo urlencode($clave_unica); ?>" 
                           class="btn-eliminar"
                           onclick="return confirm('¿Estás seguro de que quieres eliminar este producto?');">
                            <img src="img/delete.png" class="logo-user" alt="Logo Delete">
                        </a>
                    </td>
                </tr>

            <?php
            } // Fin del bucle foreach
            ?>
            
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" style="text-align: right; font-weight: bold;">Total de la Compra:</td>
                    <td style="font-weight: bold;"><?php echo number_format($total_general, 2); ?></td>
                    <td></td> </tr>
            </tfoot>
        </table>

        <div class="cart-actions">
            <a href="index.php" class="btn-cart btn-seguir">Seguir Comprando</a>
            <a href="pago.php" class="btn-cart btn-pago">Finalizar Compra</a>
        </div>

    <?php
    } // Fin del if/else para el carrito vacío
    ?>
</main>

    <footer class="footer">
            <div class="container container-footer">
                <div class="menu-footer">
                    <div class="contact-info">
                        <p class="title-footer">Información de Contacto</p>
                        <ul>
                            <li>Dirección: Calle Colonia Mexico</li>
                            <li>Telefono: 123-456</li>
                            <li>Email: f1store@support.com</li>
                        </ul>
                        <div class="social-icons">
                            <span class="face"><img src="img/facebook.png" class="logo-contac" alt="Logo facebook"></span>
                            <span class="insta"><img src="img/instagram.png" class="logo-contac" alt="Logo instagram"></span>
                            <span class="twitter"><img src="img/twitter.png" class="logo-contac" alt="Logo twitter"></span>
                            <span class="tiktok"><img src="img/tiktok.png" class="logo-contac" alt="Logo tiktok"></span>
                        </div>
                    </div>
                    <div class="information">
                        <p class="title-footer">Información</p>
                        <ul>
                            <li><a href="perfil.php">Mi Cuenta</a></li>
							<li><a href="SobreNosotros.php">Sobre Nosotros</a></li>
                        </ul>
                    </div>
                    <div class="customer-service">
						<p class="title-footer">Atención al Cliente</p>
						<ul>
							<li><a href="#">Ayuda</a></li>
							<li><a href="#">Guía de tallas</a></li>
						</ul>
					</div>
                    <div class="newsletter">
						<p class="title-footer">Formula 1 Tienda</p>

						<div class="content">
							<p>
								Bienvenido a la tienda en línea oficial de Fórmula Uno, el único lugar para el 
                                deporte de alta velocidad de F1, especializado en distribuir lo último y lo mejor 
                                en mercancía de F1 y Gran Premio, almacenando una gama inigualable de ropa de equipo 
                                auténtica y licenciada, gorras, ropa de aficionados y accesorios. 
							</p>
						</div>
					</div> 
                </div>
                <div class="copyright">
					<p>
						Desarrollado por Tienda Formula 1 2025
					</p>
					<img src="img/payment.png" alt="Pagos">
				</div>
            </div>
        </footer>
</body>
</html>