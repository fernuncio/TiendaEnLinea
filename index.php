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

    if (isset($_SESSION['mensaje_carrito'])) {
    // 1. Mostrar el mensaje en un div estilizado
    echo '<div class="alerta-exito">' . htmlspecialchars($_SESSION['mensaje_carrito']) . '</div>';
    
    // 2. Eliminar el mensaje de la sesión para que no aparezca de nuevo al recargar
    unset($_SESSION['mensaje_carrito']);
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>F1 Store</title>
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
                            <span class="text" style="margin-left: 5px; color: #ffffffff;">
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
                        <li><a href="#">Inicio</a></li>
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
        <section class="banner">
            <div class="content-banner">
                <p>Playera Piloto</p>
                <h2>COLECCIÓN<br>FERRARI 2025</h2>
                <a href="#">VER COLECCIÓN</a>
            </div>
        </section>
        <main class="content">
            <section class="container container-features">
                <!--Caracteristucas-->
                <div class="card-feature">
                    <img src="img/plane.png" class="logo-feature" alt="Logo Plane">
                    <div class="feature-content">
                        <span>Envío Gratuito a nivel mundial</span>
                        <p>Que tu pedido cruce la meta sin pagar envío: $2000 o más.</p>
                    </div>
                </div>
                <div class="card-feature">
                    <img src="img/return.png" class="logo-feature" alt="Logo Plane">
                    <div class="feature-content">
                        <span>Devoluciones y Cambios Gratuitos</span>
                        <p>Si algo no encaja, lo ajustamos sin costo. Así de rápido como en los pits</p>
                    </div>
                </div>
                <div class="card-feature">
                    <img src="img/gift-card.png" class="logo-feature" alt="Logo Plane">
                    <div class="feature-content">
                        <span>Tarjeta de Regalo Especial</span>
                        <p>Regala velocidad, pasión y estilo con una tarjeta F1</p>
                    </div>
                </div>
            </section>
            <!--Colecciones-->
            <section class="container top-collections">
                <h1 class="heading-1">COLECCIONES EN TENDENCIA</h1>
                <div class="container-collections">
                    <div class="card-collections collections-f1">
                        <p>Colecciones F1</p>
                        <span>Ver más</span>
                    </div>
                    <div class="card-collections collections-team">
                        <p>Ropa de equipo 2025</p>
                        <span>Ver más</span>
                    </div>
                    <div class="card-collections collections-helmets">
                        <p>Cascos de modelos coleccionables</p>
                        <span>Ver más</span>
                    </div>
                </div>
            </section>
                        <!--LANZAMIENTOS-->
            <section class="container latest-releases">
                <h1 class="heading-1">ULTIMOS LANZAMIENTOS</h1>
                <div class="container-products">
                    <div class="card-product">
                        <!--Lanzamiento 1-->
                            
                        <div class="container-img">
                            <img src="img/ul1.jpg" class="latest" alt="Lan 1">
                            <div class="button-group">
                                <span>
                                    <a href="ProductoUnoL.php">
                                    <img src="img/view.png" class="logo-elements" alt="Logo Vista">
                                    </a>
                                </span>
                                <span>
                                    <img src="img/fav.png" class="logo-elements" alt="Logo Fav">
                                </span>
                            </div>
                        </div>
                        
                        <form method="POST" action="agregarCarritoDef.php">
                
                            <input type="hidden" name="producto_id" value="10"> 
                            <input type="hidden" name="nombre" value="Chamarra de Lluvia Red Bull X HYPEBEAST">
                            <input type="hidden" name="precio" value="234.00">
                            <input type="hidden" name="cantidad" value="1">
                            <input type="hidden" name="talla" value="S"> <div class="content-card-product">
                            <h3>Chamarra de Lluvia Red Bull X HYPEBEAST Talla S</h3>
                    
                            <button type="submit" name="añadir_rapido" class="add-cart">
                                <img src="img/add-to-cart.png" class="logo-elements" alt="Logo Add">
                            </button>
                    
                            <p class="price">234,00 US$</p>
                        </form>
                    </div>    
                </div>

                <div class="card-product">
            <div class="container-img">
                <img src="img/ul2.jpg" class="latest" alt="Lan 1">
                <div class="button-group">
                    <span>
                        <img src="img/view.png" class="logo-elements" alt="Logo Vista">
                    </span>
                    <span>
                        <img src="img/fav.png" class="logo-elements" alt="Logo Fav">
                    </span>
                </div>
            </div>
            
            <form method="POST" action="agregarCarritoDef.php">
                <input type="hidden" name="producto_id" value="11"> 
                <input type="hidden" name="nombre" value="Polo de chándal de réplica de Red Bull Racing X Hypebeast">
                <input type="hidden" name="precio" value="137.00">
                <input type="hidden" name="cantidad" value="1">
                <input type="hidden" name="talla" value="XL"> <div class="content-card-product">
                    <h3>Polo de chándal de réplica de Red Bull Racing X Hypebeast Talla XL</h3>
                    
                    <button type="submit" name="añadir_rapido" class="add-cart">
                        <img src="img/add-to-cart.png" class="logo-elements" alt="Logo Add">
                    </button>
                    
                    <p class="price">137,00 US$</p>
                </div>
            </form>
            </div>

        <div class="card-product">
            <div class="container-img">
                <img src="img/ul3.jpg" class="latest" alt="Lan 1">
                <div class="button-group">
                    <span>
                        <img src="img/view.png" class="logo-elements" alt="Logo Vista">
                    </span>
                    <span>
                        <img src="img/fav.png" class="logo-elements" alt="Logo Fav">
                    </span>
                </div>
            </div>
            
            <form method="POST" action="agregarCarritoDef.php">
                <input type="hidden" name="producto_id" value="12"> 
                <input type="hidden" name="nombre" value="Sudadera con capucha extragrande McLaren New Era Worldmark - Negra">
                <input type="hidden" name="precio" value="108.00">
                <input type="hidden" name="cantidad" value="1">
                <input type="hidden" name="talla" value="M"> <div class="content-card-product">
                    <h3>Sudadera con capucha extragrande McLaren New Era Worldmark - Negra Talla M</h3>
                    
                    <button type="submit" name="añadir_rapido" class="add-cart">
                        <img src="img/add-to-cart.png" class="logo-elements" alt="Logo Add">
                    </button>
                    
                    <p class="price">108,00 US$</p>
                </div>
            </form>
            </div>

        <div class="card-product">
            <div class="container-img">
                <img src="img/ul4.jpg" class="latest" alt="Lan 1">
                <div class="button-group">
                    <span>
                        <img src="img/view.png" class="logo-elements" alt="Logo Vista">
                    </span>
                    <span>
                        <img src="img/fav.png" class="logo-elements" alt="Logo Fav">
                    </span>
                </div>
            </div>
            
            <form method="POST" action="agregarCarritoDef.php">
                <input type="hidden" name="producto_id" value="13> 
                <input type="hidden" name="nombre" value="Sudadera con capucha McLaren New Era lavada - Negro">
                <input type="hidden" name="precio" value="120.00">
                <input type="hidden" name="cantidad" value="1">
                <input type="hidden" name="talla" value="L"> <div class="content-card-product">
                    <h3>Sudadera con capucha McLaren New Era lavada - Negro Talla L</h3>
                    
                    <button type="submit" name="añadir_rapido" class="add-cart">
                        <img src="img/add-to-cart.png" class="logo-elements" alt="Logo Add">
                    </button>
                    
                    <p class="price">120,00 US$</p>
                </div>
            </form>
            </div>    

                </div>
            </section>

            <!--Collage Imagenes-->
            <section class="gallery">
                <img src="img/g2.jpg" alt="gallery Img1" class="gallery-img-1">
                <img src="img/g2.jpeg" alt="gallery Img2" class="gallery-img-2">
                <img src="img/g5.jpg" alt="gallery Img3" class="gallery-img-3">
                <img src="img/g4.jpg" alt="gallery Img4" class="gallery-img-4">
                <img src="img/g3.jpg" alt="gallery Img5" class="gallery-img-5">
            </section>
            <!--Comprar por equipo-->
            <!--Colecciones-->
            <section class="container buy-team">
                <h1 class="heading-1">COMPRAR POR EQUIPO</h1>
                <div class="container-team">
                    <div class="container-img-team">
                            <img src="img/mercedes.jpg" class="team-img" alt="Logo Team">
                    </div>
                    <div class="container-img-team">
                            <img src="img/hass.jpg" class="team-img" alt="Logo Team">
                    </div>
                    <a href="FerrariTeam.html">
                        <div class="container-img-team">
                            <img src="img/ferrari.jpg" class="team-img" alt="Logo Team">
                        </div>
                    </a>
                    <div class="container-img-team">
                            <img src="img/sauber.jpg" class="team-img" alt="Logo Team">
                    </div>
                    <div class="container-img-team">
                            <img src="img/williams.jpg" class="team-img" alt="Logo Team">
                    </div>
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
    </body>
</html>