
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
                            <span class="number">(0)</span>
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
                        <h1 class="product-title">Chamarra de Lluvia Red Bull X HYPEBEAST<</h1>
                        <p class="product-price">234,00 US$</p>

                        <p class="size-guide-link">GUÍA DE TALLAS.</p>

                        <div class="size-selector-group">
                            <label for="size-select">Talla</label>
                            <select id="size-select" class="size-select">
                                <option>Elige una opción</option>
                                <option value="s">S</option>
                                <option value="m">M</option>
                                <option value="l">L</option>
                                <option value="xl">XL</option>
                            </select>
                        </div>

                        <div class="add-to-cart-group">
                            <div class="quantity-control">
                                <button class="qty-btn" id="decrease-qty">-</button>
                                <input type="text" value="1" id="quantity" class="qty-input">
                                <button class="qty-btn" id="increase-qty">+</button>
                            </div>
                            <button class="add-to-cart-btn">AÑADIR AL CARRITO</button>
                        </div>
                    </div>
                </div>

                <section class="product-description-section">
                    <div class="description-header">
                        <i class="fa-solid fa-angle-up"></i>
                        <h2>Descripción</h2>
                    </div>
                    <div class="description-content">
                        <p>Vive el estilo de Texas con la Sudadera McLaren F1 GP Austin 2025. Esta sudadera con capucha luce gráficos serigrafiados, lo que la convierte en una forma elegante de mostrar tu apoyo al equipo McLaren F1. Además, con un bolsillo frontal tipo canguro y una confección de peso medio, es práctica y cómoda para temperaturas moderadas.</p>
                        
                        <ul>
                            <li>Bolsillo frontal tipo cangurera</li>
                            <li>Sudadera con capucha de peso medio adecuada para temperaturas moderadas.</li>
                            <li>Material: 70% algodón/30% poliéster</li>
                            <li>Manga larga</li>
                            <li>Pull-over</li>
                            <li>Con licencia oficial</li>
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
                            <li><a href="iniciarSesion.php">Mi Cuenta</a></li>
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
