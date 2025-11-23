<?php
require_once 'Configuracion/database.php'; 
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
    // mostrar el mensaje en un div estilizado
    echo '<div class="alerta-exito">' . htmlspecialchars($_SESSION['mensaje_carrito']) . '</div>';
    
    // eliminar el mensaje de la sesión para que no aparezca de nuevo al recargar
    unset($_SESSION['mensaje_carrito']);
}



$productos = [];
try {
    $db = new Database();
    $pdo = $db->conectar();

    $sql = "SELECT id_producto, nombre, precio, stock, URLimg
            FROM productos 
            WHERE recienteL=1";
    
    $stmt = $pdo->query($sql);
    $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
} catch (PDOException $e) {
    echo "Error de conexión/consulta: " . $e->getMessage();
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>F1 Store</title>
    <link rel="stylesheet" href="style.css?v=2"/>
    <link rel="icon" type="image/x-icon" href="img/volante.png">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>

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
                        <li><a href="#">Navidad</a></li>
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
        <script>
        // Detectar scroll y agregar clase
            window.addEventListener('scroll', function() {
                const navbar = document.querySelector('.container-navbar');
                if (window.scrollY > 100) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
            });
        </script>

        <!--<section class="banner">
            <div class="content-banner">
                <p>Playera Piloto</p>
                <h2>COLECCIÓN<br>FERRARI 2025</h2>
                <a href="#">VER COLECCIÓN</a>
            </div>
        </section>-->

        

        <main class="content">
            <!-- Banner superior -->
    <div class="christmas-promo-bar">
        <span class="promo-arrow-nav left">‹</span>
        <a href="#">HASTA UN 60% DE DESCUENTO EN LÍNEAS SELECCIONADAS Use el código SALE60</a>
        <span class="promo-arrow-nav right">›</span>
    </div>

    <!-- Slider principal -->
    <div class="holiday-slider-box">
        <div class="xmas-slider-track">
            <!-- Slide 1 -->
            <div class="festive-slide-panel" style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('img/slide1.jpg') center/cover;">
                <div class="winter-slide-content">
                    <h1 class="christmas-main-heading">El regalo perfecto para cualquier edad</h1>
                    <div class="snow-label-tag">Regala LEGO esta navidad</div>
                    <!--<div class="festive-price-banner">DESCUENTO DE 50%</div>-->
                    <button class="holiday-cta-button">COMPRAR AHORA</button>
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="festive-slide-panel" style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('img/slide2.jpg') center/cover;">
                <div class="winter-slide-content">
                    <h1 class="christmas-main-heading">Alimenta su temporada festiva</h1>
                    <div class="snow-label-tag">Regala la pasión por la F1</div>
                    <button class="holiday-cta-button">COMPRAR AHORA</button>
                </div>
            </div>

            <!-- Slide 3 -->
            <div class="festive-slide-panel" style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('img/slider3.jpg') center/cover;">
                <div class="winter-slide-content">
                    <h1 class="christmas-main-heading">No dejes para el último momento tus compras navideñas</h1>
                    <div class="snow-label-tag">Ahorra un 30% en productos seleccionados</div>
                    <button class="holiday-cta-button">COMPRAR AHORA</button>
                </div>
            </div>
        </div>

        <!-- Botones de navegación -->
        <button class="snowflake-nav-btn prev">‹</button>
        <button class="snowflake-nav-btn next">›</button>

        <!-- Indicadores -->
        <div class="reindeer-dots-wrapper">
            <div class="santa-dot-indicator active" data-xmas-slide="0"></div>
            <div class="santa-dot-indicator" data-xmas-slide="1"></div>
            <div class="santa-dot-indicator" data-xmas-slide="2"></div>
        </div>
    </div>

    <!-- Botón de chat -->
    <div class="chat-widget">
        <span style="font-size: 20px;">💬</span>
        <span>Chatea con Nosotros</span>
    </div>


    <script>
        $(document).ready(function() {
            let slideActual = 0;
            const totalSlides = $('.festive-slide-panel').length;
            let temporizadorAutoplay;

            // Función para mover el slider
            function moverASlide(indice) {
                if (indice < 0) {
                    slideActual = totalSlides - 1;
                } else if (indice >= totalSlides) {
                    slideActual = 0;
                } else {
                    slideActual = indice;
                }

                const desplazamiento = -slideActual * 100;
                $('.xmas-slider-track').css('transform', `translateX(${desplazamiento}%)`);
                
                // Actualizar indicadores
                $('.santa-dot-indicator').removeClass('active');
                $(`.santa-dot-indicator[data-xmas-slide="${slideActual}"]`).addClass('active');
            }

            // Botones de navegación
            $('.snowflake-nav-btn.prev').click(function() {
                moverASlide(slideActual - 1);
                reiniciarAutoplay();
            });

            $('.snowflake-nav-btn.next').click(function() {
                moverASlide(slideActual + 1);
                reiniciarAutoplay();
            });

            // Indicadores
            $('.santa-dot-indicator').click(function() {
                const indiceSlide = parseInt($(this).data('xmas-slide'));
                moverASlide(indiceSlide);
                reiniciarAutoplay();
            });

            
            function iniciarAutoplay() {
                temporizadorAutoplay = setInterval(function() {
                    moverASlide(slideActual + 1);
                }, 5000);
            }

            function reiniciarAutoplay() {
                clearInterval(temporizadorAutoplay);
                iniciarAutoplay();
            }

            // Navegación con teclado
            $(document).keydown(function(evento) {
                if (evento.keyCode === 37) { // Flecha izquierda
                    moverASlide(slideActual - 1);
                    reiniciarAutoplay();
                } else if (evento.keyCode === 39) { // Flecha derecha
                    moverASlide(slideActual + 1);
                    reiniciarAutoplay();
                }
            });

            // Touch
            let toqueInicioX = 0;
            let toqueFinX = 0;

            $('.holiday-slider-box').on('touchstart', function(evento) {
                toqueInicioX = evento.touches[0].clientX;
            });

            $('.holiday-slider-box').on('touchend', function(evento) {
                toqueFinX = evento.changedTouches[0].clientX;
                manejarDeslizamiento();
            });

            function manejarDeslizamiento() {
                if (toqueFinX < toqueInicioX - 50) {
                    moverASlide(slideActual + 1);
                    reiniciarAutoplay();
                }
                if (toqueFinX > toqueInicioX + 50) {
                    moverASlide(slideActual - 1);
                    reiniciarAutoplay();
                }
            }

            // Pausar autoplay al hacer hover
            $('.holiday-slider-box').hover(
                function() {
                    clearInterval(temporizadorAutoplay);
                },
                function() {
                    iniciarAutoplay();
                }
            );

            // Iniciar autoplay
            iniciarAutoplay();

            // Animación botón de chat
            $('.gingerbread-chat-widget').click(function() {
                alert('¡La funcionalidad del chat se integraría aquí!');
            });
        });
    </script>

        <div class="contenedor-oferta-tiempo" id="contadorOfertaPrincipal">
    <h2 class="titulo-oferta"> OFERTA POR TIEMPO LIMITADO </h2>
    <p class="subtitulo-oferta">¡Aprovecha hasta 60% de descuento en productos seleccionados!</p>
    
    <div class="temporizador-grid">
        <div class="unidad-tiempo">
            <span class="numero-tiempo" id="dias">00</span>
            <span class="etiqueta-tiempo">Días</span>
        </div>
        <div class="unidad-tiempo">
            <span class="numero-tiempo" id="horas">00</span>
            <span class="etiqueta-tiempo">Horas</span>
        </div>
        <div class="unidad-tiempo">
            <span class="numero-tiempo" id="minutos">00</span>
            <span class="etiqueta-tiempo">Minutos</span>
        </div>
        <div class="unidad-tiempo">
            <span class="numero-tiempo" id="segundos">00</span>
            <span class="etiqueta-tiempo">Segundos</span>
        </div>
    </div>
    
    <p class="mensaje-urgencia" id="mensajeUrgencia">
         ¡Date prisa! La oferta está por terminar 
    </p>
    
    <button class="boton-oferta-ahora" onclick="window.location.href='#'">
        COMPRAR AHORA
    </button>
</div>


<script>
// config del contador
// establecer fecha final de la oferta 
const fechaFinOferta = new Date(2025, 11, 31, 23, 59, 59).getTime(); 

// una funcion para actualizar el contador
function actualizarContador() {
    const ahora = new Date().getTime();
    const tiempoRestante = fechaFinOferta - ahora;
    
    // calcular los dias,horas,min,seg
    const dias = Math.floor(tiempoRestante / (1000 * 60 * 60 * 24));
    const horas = Math.floor((tiempoRestante % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutos = Math.floor((tiempoRestante % (1000 * 60 * 60)) / (1000 * 60));
    const segundos = Math.floor((tiempoRestante % (1000 * 60)) / 1000);
    
    // actualizamos el contador iniciar
    actualizarElemento('dias', dias);
    actualizarElemento('horas', horas);
    actualizarElemento('minutos', minutos);
    actualizarElemento('segundos', segundos);
    
    
    // mostrar un msj si falta poco
    const mensajeUrgencia = document.getElementById('mensajeUrgencia');
    if (dias === 0 && horas < 24) {
        mensajeUrgencia.classList.add('activo');
    } else {
        mensajeUrgencia.classList.remove('activo');
    }
    
    // si el tiempo se ha acabado
    if (tiempoRestante < 0) {
        clearInterval(intervaloContador);
        document.getElementById('contadorOfertaPrincipal').innerHTML = `
            <h2 class="titulo-oferta">¡OFERTA FINALIZADA!</h2>
            <p class="subtitulo-oferta">Mantente atento a nuestras próximas promociones</p>
            <button class="boton-oferta-ahora" onclick="window.location.href='index.php'">
                VER PRODUCTOS
            </button>
        `;
    }
}

// actualizar cada elemento
function actualizarElemento(id, valor) {
    const elemento = document.getElementById(id);
    const valorFormateado = agregarCero(valor);
    
    if (elemento.textContent !== valorFormateado) {
        elemento.classList.add('pulso-numero');
        elemento.textContent = valorFormateado;
        
        setTimeout(() => {
            elemento.classList.remove('pulso-numero');
        }, 500);
    }
}

// agregar un cero si es menor a 10
function agregarCero(numero) {
    return numero < 10 ? '0' + numero : numero;
}

// actualiza el contador ca segundo
const intervaloContador = setInterval(actualizarContador, 1000);

// lo ejecuta a la hora de cargar
actualizarContador();
</script>

    <div class="christmas-bar-w">
        <h1></h1>
    </div>

    <div class="presents-grid-wrapper">
        <!-- Tarjeta 1-->
        <div class="ornament-gift-card red-theme" style="background-image: url('img/gift1.jpg');">
            <div class="mistletoe-overlay"></div>
            <div class="wreath-card-content">
                <h2 class="candy-cane-title">Regalos para ella</h2>
                <button class="stockings-cta-btn">Comprar ahora</button>
            </div>
        </div>

        <!-- Tarjeta 2 -->
        <div class="ornament-gift-card orange-theme" style="background-image: url('img/gift2.jpg');">
            <div class="mistletoe-overlay"></div>
            <div class="wreath-card-content">
                <h2 class="candy-cane-title">Regalos para él</h2>
                <button class="stockings-cta-btn">Comprar ahora</button>
            </div>
        </div>

        <!-- Tarjeta 3 -->
        <div class="ornament-gift-card green-theme" style="background-image: url('img/gift3.jpg');">
            <div class="mistletoe-overlay"></div>
            <div class="wreath-card-content">
                <h2 class="candy-cane-title">Regalos para niños</h2>
                <button class="stockings-cta-btn">Comprar ahora</button>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Click en los botones
            $('.stockings-cta-btn').click(function(evento) {
                evento.stopPropagation();
                const categoria = $(this).closest('.ornament-gift-card').find('.candy-cane-title').text();
                alert(`Navegando a: ${categoria}`);
            });

            // Click en toda la tarjeta
            $('.ornament-gift-card').click(function() {
                const categoria = $(this).find('.candy-cane-title').text();
                console.log(`Click en: ${categoria}`);
            });
        });
    </script>
            
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