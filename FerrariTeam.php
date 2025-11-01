<?php
    require 'Configuracion/database.php';
    $db = new Database();
    $con = $db->conectar();
    $sql = $con->prepare("SELECT id_producto,nombre,precio,URLimg FROM 
                          productos WHERE activo=1");
    $sql->execute();
    $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
    session_start();
    $usuario_logueado = isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mercancía Ferrari</title>
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
                            <span class="text">Soporte al cliente</span>
                            <span class="number">123-456</span>
                        </div>
                    </div>
                    <div class="container-logo">
                        <img src="img/flagle.png" class="logo" alt="Logo Tienda F1">
                        <h1 class="logo"><a>Formula 1 Store</a></h1>
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
                        <img src="img/bag.png" class="logo-user" alt="Logo Cart">
                        <div class="content-shopping-cart">
                            <span class="text">Carrito de Compras</span>
                            <span class="number">(0)</span>
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
                        <li><a href="#">Oferta</a></li>
                        <li><a href="#">Contacto</a></li>
                        <li><a href="iniciarSesion.php">Mi Cuenta</a></li>
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

        <!--Imagen Banner del equipo-->
        <div class="hero-banner">
            <div class="hero-content">
                <div class="hero-text-box">
                    <div class="team-text">Ferrari Team</div>
                </div>
            </div>
        </div>

        <main class="main-container"> 
            <section class="product-grid-area">
                <p style="font-size: 12px; margin-bottom: 10px;">Elementos 9</p>
                <div class="product-grid">
                    <?php
                        foreach($resultado as $row){
                            $imagen = $row['URLimg'];
                    ?>
                    <article class="product-card">
                    <div class="product-image product-<?php echo $imagen?>"></div>
                    <div class="product-name"><?php echo $row['nombre']?></div>
                    <div class="product-price"><?php echo $row['precio']?> US$</div>
                    <span class="add-cart">
                        <img src="img/add-to-cart.png" class="logo-elements" alt="Logo Add">
                    </span>
                    </article>

                    <?php } ?>
                    
                </div>
                <section class="banner-last">
                    <div class="content-banner-last">
                        <h2>FORZA FERRARI</h2>
                    </div>
                </section>
            </section>
            
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