<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/materialize.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/material-gradient.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/material-components.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/icons/style.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/owner.css">
    <title>Ver Productos - Inversiones A2</title>
</head>
<body>
    <!-- Header -->
    <?php require_once "views/layouts/header.php"; ?>

    <!-- Main Container -->
    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col s12 breadcrumb-nav left-align">
                    <a href="<?php echo Helpers::url('Home','index'); ?>" class="breadcrumb">Inicio</a>
                    <a href="<?php echo Helpers::url('Producto','index'); ?>" class="breadcrumb">Gestionar Productos</a>
                    <a href="<?php echo Helpers::url('Producto','getAll'); ?>" class="breadcrumb">Consultar Productos</a>
                </div>
                <div class="col s12">
                    <h4 class="center-align">Productos</h4>
                </div>
                <div class="col s12">
                    <?php if($allProductos == null): ?>
                        <h4 class="center-align">No hay productos para mostrar.</h4>
                    <?php else: ?>
                        <table class="centered highlight responsive-table">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Costo</th>
                                    <th>Precio</th>
                                    <th>Cant. Disp</th>
                                    <th>Detalles</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($allProductos as $producto): ?>
                                <tr>
                                    <td><?php echo $producto->codigo_producto; ?></td>
                                    <td><?php echo $producto->nombre_producto; ?></td>
                                    <td><?php echo $producto->descripcion_producto; ?></td>
                                    <td><?php echo $producto->costo_producto; ?>$</td>
                                    <td><?php echo $producto->precio_producto; ?>$</td>
                                    <td><?php echo $producto->stock_max_producto; ?></td>
                                    <td><a href="<?php echo Helpers::url('Producto','details'); ?>/<?php echo $producto->codigo_producto; ?>" class="btn btn-small btn-floating pink waves-effect effect-light"><i class="icon-find_in_page"></i></a></td>
                                </tr>
                                <?php endforeach; ?>        
                            </tbody>
                        </table>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <?php require_once "views/layouts/footer.php"; ?>


    <script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/jquery-3.2.1.min.js"></script>
    <script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/materialize.min.js"></script>
    <script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/plugins/sweetalert.min.js"></script>
    <script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/owner.js"></script>
    <script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/data/Producto.js"></script>
</body>
</html>