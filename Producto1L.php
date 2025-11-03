<?php
    session_start();

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
    <title>Chamarra de Lluvia Red Bull X HYPEBEAST</title>
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
                        <a href="iniciarSesion.php">
                            <img src="img/user.png" class="logo-user" alt="Logo User">
                        </a>
                        <img src="img/bag.png" class="logo-user" alt="Logo Cart">
                        <div class="content-shopping-cart">
                            <span class="text">Carrito de Compras</span>
                            <span class="number">(<?php echo $numeroProd; ?>)</span>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <main class="product-detail">
            <div class="container-product">
                <div class="breadcrumbs">
                    <a href="index.php">INICIO</a> / 
                    <a href="#">RED BULL RACING</a>
                </div>

                <div class="product-layout">
                    <div class="product-image">
                        <img src="img/ul1.jpg" alt="Chamarra de Lluvia Red Bull X HYPEBEAST<" class="main-product-img"> 
                    </div>

                    <div class="product-info">
                        <form method="POST" action="agregarCarrito.php">
                            <input type="hidden" name="producto_id" value="10"> 
                            <input type="hidden" name="nombre" value="Chamarra de Lluvia Red Bull X HYPEBEAST">
                            <input type="hidden" name="precio" value="234.00"> 

                            <h1 class="product-title">Chamarra de Lluvia Red Bull X HYPEBEAST</h1>
                            <p class="product-price">234,00 US$</p>

                            <a href="tallas/guiaTallas.pdf" target="_blank" class="size-guide-link">
                                GUÍA DE TALLAS.
                            </a>
        
                            <div class="size-selector-group">
                                <label for="size-select">Talla</label>
                                <select id="size-select" class="size-select" name="talla" required>
                                    <option value="">Elige una opción</option>
                                    <option value="S">S</option>
                                    <option value="M">M</option>
                                    <option value="L">L</option>
                                    <option value="XL">XL</option>
                                </select>
                            </div>

                            <div class="add-to-cart-group">
                                <div class="quantity-control">
                                    <button class="qty-btn" id="decrease-qty" type="button">-</button>
                                    <input type="number" value="1" min="1" id="quantity" class="qty-input" name="cantidad">
                                    <button class="qty-btn" id="increase-qty" type="button">+</button>
                                </div>
                                <button type="submit" name="añadir_carrito" class="add-to-cart-btn">AÑADIR AL CARRITO</button>
                            </div>
                        </form>
                    </div>
                </div>

                <section class="product-description-section">
                    <div class="description-header">
                        <i class="fa-solid fa-angle-up"></i>
                        <h2>Descripción</h2>
                    </div>
                    <div class="description-content">
                        <p>Equipamiento esencial, un estilo fresco. Descubre la Chamarra de Lluvia Red Bull X HYPEBEAST: 
                           una colaboración exclusiva para arrasar en la pista. Con un elegante camuflaje digital y 
                           logotipos auténticos, esta cómoda chamarra impermeable de Castore es tu look ideal cuando el 
                           tiempo no acompaña.</p>
                        
                        <ul>
                            <li>Chamarra de lluvia Hypebeast de Castore</li>
                            <li>Diseño exclusivo con estampado de camuflaje digital y la marca Hypebeast</li>
                            <li>Logotipos de Oracle Red Bull Racing y sus socios termotransferidos</li>
                            <li>Resistente al agua</li>
                            <li>Capucha ajustable</li>
                            <li>Material: 100 % poliéster</li>
                        </ul>
                    </div>
                </section>
            </div>
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
