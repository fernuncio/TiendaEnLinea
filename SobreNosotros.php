<?php
    session_start();
    $usuario_logueado = isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true;

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
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acerca de Nosotros</title>
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
                        <li><a href="navidad.php">Navidad</a></li>
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
        <main class="content-about-us"> 
            <section class="about-us">
                <div class="content-about-us">
                    <h1 class ="title">Acerca de Nosotros</h1>
					    		<p>
						    		La administración de nuestra web se encuentra a cargo de Fanatics (International) Ltd.
                                    Como líder global en merchandising deportivo oficial, Fanatics ofrece sus servicios en más de 180 países. Tiene tiendas en más de 12 idiomas de muchos de los equipos y ligas más famosas del mundo. Y cuenta con un servicio de atención al cliente en 11 idiomas. En febrero de 2016, Fanatics expandió el alcance del mercado en licencias deportivas gracias a la adquisición de Kitbag, empresa internacional con sede en Reino Unido, especializada en la venta internacional online de material deportivo. Actualmente, Kitbag apoya y complementa las fructuosas operaciones que, desde EEUU, están centradas en establecer sólidas relaciones con grandes equipos y organizaciones deportivas alrededor del mundo.
                                    Desde su base en Manchester, bastión deportivo del Reino Unido, Fanatics ofrece sus servicios y soluciones desde el principio hasta el final del proceso a casi 30 socios de diferentes deportes a escala internacional. Fanatics destaca por sus relaciones con organizaciones mundialmente conocidas como La Liga, la Premier League, la Bundesliga, Ligue 1 y el SPL, además de representar a las grandes ligas de EEUU, al golf, rugby, Fórmula 1 y tenis.
                                    A nivel internacional, Fanatics ejerce su liderazgo en la gestión de diferentes eventos, siendo proveedor de merchandising para diferentes acontecimientos además de tiendas físicas. Destaca igualmente por su experiencia en los principales estadios de rugby, fútbol y golf. El servicio de infraestructura y compromiso de Fanatics también se han expandido a nivel internacional, integrándose con sus ya establecidas soluciones de marketing y tecnología, usadas tradicionalmente por Fanatics y sus socios en EEUU y ayudando a Fanatics a extender su pericia y experiencia a escala global.
                                    Fanatics gestiona F1 Store™ en Formula1.com con licencia.
							    </p>
                    <h1 class ="title"><br>Ponte en contacto con nosotros a través de correo postal</h1>
					    		<p>
						    		También puedes escribir a nuestro equipo cuando lo necesites a la siguiente dirección postal:
                                    <br>
                                    F1 Store<br>
                                    c/o Fanatics International<br>
                                    Touchet Hall Road<br>
                                    Middleton<br>
                                    Manchester<br>
                                    M24 2FL
							    </p>
			    </div>
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
        <!-- Botón de chat -->
    <div class="chat-widget">
        <span style="font-size: 20px;">💬</span>
        <span>Chatea con Nosotros</span>
    </div>
    </body>
</html>