<?php require_once 'codigo_perfil.php'; 

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
    //iniciar el carrito si no existe
    if(!isset($_SESSION['carrito'])){
        $_SESSION['carrito'] = [];
    }

    $numeroProd = 0;

    // Si el carrito no está vacío, sumamos las cantidades
    if (!empty($_SESSION['carrito'])) {
        foreach ($_SESSION['carrito'] as $item) {
            // Suma la cantidad de cada ítem al contador total
            $numeroProd += $item['cantidad'];
        }
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil - F1 Store</title>
    <link rel="stylesheet" href="style.css?v=2"/>
    <link rel="icon" type="image/x-icon" href="img/volante.png">
</head>
<body class="body-formulario">
    <header>
        <div class="container-hero">
            <div class="container hero">
                <div class="customer-support">
                    <img src="img/suport.png" class="logo-user" alt="Logo Soporte">
                    <div class="content-customer-support">
                        <span class="text">Soporte al cliente</span>
                        <span class="number">123-456</span>
                    </div>
                </div>
                <div class="container-logo">
                    <img src="img/flagle.png" class="logo" alt="Logo Tienda F1">
                    <h1 class="logo"><a href="index.php">Formula 1 Store</a></h1>
                </div>

                <div class="container-user">
                    <a href="perfil.php" title="Mi Perfil">
                        <img src="img/user.png" class="logo-user" alt="Logo User">
                    </a>
                    <span class="text" style="margin-left: 5px; color: #fff;">
                        Hola, <?php echo htmlspecialchars($_SESSION["nombre"]); ?>
                    </span>
                    <a href="verCarrito.php">
                        <img src="img/bag.png" class="logo-user" alt="Logo Cart">
                        </a>
                    <div class="content-shopping-cart">
                        <span class="text">Carrito de Compras</span>
                        <span class="number">(<?php echo $numeroProd; ?>)</span>
                    </div>
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

    <!-- Contenido del Perfil -->
    <section>
        <br>
        <br>
        <div class="profile-container">
            <!-- Header del Perfil -->
            <div class="profile-header">
                <div class="user-initial"><?php echo $inicial; ?></div>
                <div class="user-details">
                    <div class="user-name"><?php echo htmlspecialchars($_SESSION["nombre"]); ?></div>
                    <div class="user-email"><?php echo htmlspecialchars($_SESSION["email"]); ?></div>
                   
                </div>
            </div>

            <!-- Información Básica -->
            <div class="info-grid">
                
                <div class="info-card">
                    <div class="info-label">Estado</div>
                    <div class="info-value" style="color: #22c55e;">Activo</div>
                </div>
            </div>

            <!-- Estadísticas -->
            <div class="stats-section">
                <div class="stats-title"> Estadísticas de Compra</div>
                <div class="stats-grid">
                    <div class="stat-item">
                        <div class="stat-number"><?php echo $total_pedidos; ?></div>
                        <div class="stat-label">Pedidos Totales</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">$<?php echo number_format($total_gastado, 2); ?></div>
                        <div class="stat-label">Total Gastado</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number"><?php echo $puntos_f1; ?></div>
                        <div class="stat-label">Puntos F1</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number"><?php echo $membresia; ?></div>
                        <div class="stat-label">Membresía</div>
                    </div>
                </div>
            </div>

            <!-- Últimas Compras -->
            <div class="compras-section">
                <div class="compras-title"> Últimas Compras</div>
                
                <?php if(count($ultimas_compras) > 0): ?>
                    <?php foreach($ultimas_compras as $compra): ?>
                        <div class="compra-item">
                            <div>
                                <div class="compra-info">Orden</div>
                                <div class="compra-value">#<?php echo $compra['id_venta']; ?></div>
                            </div>
                            <div>
                                <div class="compra-info">Total</div>
                                <div class="compra-value">$<?php echo number_format($compra['total'], 2); ?></div>
                            </div>
                            <div>
                                <div class="compra-info">Fecha</div>
                                <div class="compra-value"><?php echo date('d/m/Y', strtotime($compra['fecha'])); ?></div>
                            </div>
                            <div>
                                <span class="estado-badge estado-<?php echo $compra['estado']; ?>">
                                    <?php echo ucfirst($compra['estado']); ?>
                                </span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="no-compras">
                        <p> Aún no has realizado ninguna compra</p>
                        <p style="font-size: 14px; margin-top: 10px;">¡Empieza a comprar productos de F1 ahora!</p>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Botones de Acción -->
            <div class="buttons-section">
                <a href="index.php" class="btn-action btn-secondary">← Volver a la Tienda</a>
                <a href="codigo_cerar_sesion.php" class="btn-action">Cerrar Sesión →</a>
            </div>
        </div>
        <br>
        <br>
    </section>

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
                <p>Desarrollado por Tienda Formula 1 2025</p>
                <img src="img/payment.png" alt="Pagos">
            </div>
        </div>
    </footer>
</body>
</html>