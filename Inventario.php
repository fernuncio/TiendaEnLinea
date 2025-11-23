<?php require_once 'codigo-inventario.php'; 
?>
<?php 
require_once 'codigo-inventario.php'; 


// Calcular el número de productos en el carrito
if (!empty($_SESSION['carrito']) && is_array($_SESSION['carrito'])) {
    // Cuenta el número de productos (IDs únicos) en el carrito
    $numeroProd = count($_SESSION['carrito']); 
} else {
    // Si el carrito no existe o está vacío, es 0
    $numeroProd = 0; 
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor de Inventario - F1 Store</title>
    <link rel="stylesheet" href="style.css?v=2"/>
    <link rel="icon" type="image/x-icon" href="../img/volante.png">
</head>
<body class ="body-formulario">
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
                        Admin, <?php echo htmlspecialchars($_SESSION["nombre"]); ?>
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

    <div class="container-inv">
        <?php if($mensaje): ?>
            <div class="mensaje-inv <?php echo $tipo_mensaje; ?>">
                <?php echo $mensaje; ?>
            </div>
        <?php endif; ?>

        <div class="header-inv">
            <h1> Gestor de Inventario</h1>
            <div class="main-buttons">
                <a href="?agregar=1" class="btn btn-add">
                     Añadir Artículo
                </a>
               <button type="submit" form="form-eliminar" class="btn btn-delete" name="accion" value="eliminar">
                     Eliminar Seleccionados
                </button>
                <a href="index.php" class="btn btn-back">
                    ← Volver a Inicio
                </a>
            </div>
        </div>

        <form id="form-eliminar" method="POST">
            <input type="hidden" name="accion" value="eliminar">
        </form>
            <div class="inventory-list">
                <?php if(count($productos) > 0): ?>
                    <?php foreach($productos as $producto): ?>
                        <div class="inventory-item">
                            <div class="item-info">
                                <div class="item-name">
                                    <?php echo htmlspecialchars($producto['nombre']); ?>
                                    <?php if($producto['activo'] == 0): ?>
                                        <span class="badge-no-disponible">No Disponible</span>
                                    <?php else: ?>
                                        <span class="badge-disponible">Disponible</span>
                                    <?php endif; ?>
                                </div>
                                <div class="item-details">
                                     <?php echo $producto['stock']; ?> unidades | 
                                     $<?php echo number_format($producto['precio'], 2); ?>
                                    <?php if($producto['descripcion']): ?>
                                        |  <?php echo htmlspecialchars(substr($producto['descripcion'], 0, 50)); ?>...
                                    <?php endif; ?>
                                </div>
                                <div class="item-actions">
                                    <a href="?editar=<?php echo $producto['id_producto']; ?>" class="btn-action-inv btn-edit-inv">
                                         Editar
                                    </a>
                                    
                                    <!-- Controles de Stock -->
                                    <form method="POST" class="stock-control-inline">
                                        <input type="hidden" name="accion" value="aumentar_stock">
                                        <input type="hidden" name="id_producto" value="<?php echo $producto['id_producto']; ?>">
                                        <input type="number" name="cantidad" value="1" min="1" class="stock-input-inline">
                                        <button type="submit" class="btn-stock-inline btn-add-stock">+</button>
                                    </form>
                                    
                                    <form method="POST" class="stock-control-inline">
                                        <input type="hidden" name="accion" value="reducir_stock">
                                        <input type="hidden" name="id_producto" value="<?php echo $producto['id_producto']; ?>">
                                        <input type="number" name="cantidad" value="1" min="1" class="stock-input-inline">
                                        <button type="submit" class="btn-stock-inline btn-remove-stock">-</button>
                                    </form>
                                </div>
                            </div>
                            <input type="checkbox" name="productos_seleccionados[]" value="<?php echo $producto['id_producto']; ?>" class="checkbox" form="form-eliminar">
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="no-productos">
                        <p> No hay productos en el inventario</p>
                        <a href="?agregar=1" class="btn btn-add">Agregar primer producto</a>
                    </div>
                <?php endif; ?>
            </div>
        

        <!-- Modal para añadir -->
        <?php if(isset($_GET['agregar'])): ?>
        <div class="modal" style="display: flex;">
            <div class="modal-content">
                <h2> Añadir Producto</h2>
                <form method="POST">
                    <input type="hidden" name="accion" value="agregar">
                    
                    <div class="form-group">
                        <label for="nombre">Nombre del Producto</label>
                        <input type="text" id="nombre" name="nombre" required placeholder="Ej: Camiseta Ferrari 2025">
                    </div>
                    
                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <textarea id="descripcion" name="descripcion" rows="3" placeholder="Descripción del producto"></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="precio">Precio ($)</label>
                        <input type="number" id="precio" name="precio" min="0" step="0.01" required placeholder="0.00">
                    </div>
                    
                    <div class="form-group">
                        <label for="stock">Stock Inicial</label>
                        <input type="number" id="stock" name="stock" min="0" value="0" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="URLimage">URL de Imagen</label>
                        <input type="text" id="URLimage" name="URLimage" placeholder="https://ejemplo.com/imagen.jpg">
                    </div>

                    <div class="form-group">
                        <label for="equipo">Equipo</label>
                        <input type="text" id="equipo" name="equipo" placeholder="Código del equipo">
                    </div>
                    
                    <div class="form-group-checkbox">
                        <label>
                            <input type="checkbox" name="disponible" checked>
                            Producto disponible para la venta
                        </label>
                    </div>
                    
                    <div class="modal-buttons">
                        <button type="submit" class="btn-modal btn-save">Guardar</button>
                        <a href="inventario.php" class="btn-modal btn-cancel">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
        <?php endif; ?>

        <!-- Modal para editar -->
        <?php if($producto_editar): ?>
        <div class="modal" style="display: flex;">
            <div class="modal-content">
                <h2> Editar Producto</h2>
                <form method="POST">
                    <input type="hidden" name="accion" value="editar">
                    <input type="hidden" name="id_producto" value="<?php echo $producto_editar['id_producto']; ?>">
                    
                    <div class="form-group">
                        <label for="nombre">Nombre del Producto</label>
                        <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($producto_editar['nombre']); ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <textarea id="descripcion" name="descripcion" rows="3"><?php echo htmlspecialchars($producto_editar['descripcion'] ?? ''); ?></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="precio">Precio ($)</label>
                        <input type="number" id="precio" name="precio" min="0" step="0.01" value="<?php echo $producto_editar['precio']; ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="stock">Stock</label>
                        <input type="number" id="stock" name="stock" min="0" value="<?php echo $producto_editar['stock']; ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="URLimage">URL de Imagen</label>
                        <input type="text" id="URLimage" name="URLimage" value="<?php echo htmlspecialchars($producto_editar['URLimg'] ?? ''); ?>">
                    </div>

                    <div class="form-group">
                        <label for="equipo">Equipo</label>
                        <input type="text" id="equipo" name="equipo" placeholder="Código del equipo" value="<?php echo htmlspecialchars ($producto_editar['equipo'] ?? ''); ?>" required>
                    </div>
                    
                    <div class="form-group-checkbox">
                        <label>
                            <input type="checkbox" name="disponible" <?php echo $producto_editar['activo'] == 1 ? 'checked' : ''; ?>>
                            Producto disponible para la venta
                        </label>
                    </div>
                    
                    <div class="modal-buttons">
                        <button type="submit" class="btn-modal btn-save">Guardar Cambios</button>
                        <a href="inventario.php" class="btn-modal btn-cancel">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
        <?php endif; ?>
    </div>
</body>



</html>