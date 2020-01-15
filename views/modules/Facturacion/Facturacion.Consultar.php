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
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/datatables.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/animate.min.css">
    <link rel="shortcut icon" href="<?php echo BASE_URL; ?>assets/images/logo-trasparente.png">
    <title> - Inversiones A2</title>
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
                    <a href="<?php echo Helpers::url('Factura','index'); ?>" class="breadcrumb">Facturación de Ventas</a>
                    <a href="<?php echo Helpers::url('Factura','getAll'); ?>" class="breadcrumb">Consultar Facturas</a>
                </div>
                <div class="col s12">
                    <h4 class="center-align">Servicios Disponibles</h4>
                </div>
                <div class="col s12">
                    <table class="striped centered responsive-table" id="Factura">
                        <thead>
                            <tr>
                                <th>Codigo</th>
                                <th>Fecha</th>
                                <th>Modo de Pago</th>
                                <th>Porcentaje</th>
                                <th>Detalles</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($factura as $value):?>
                            <tr>
                                <td><?php echo $value['codigo_factura']?></td>
                                <td><?php echo $value['fecha_factura']?></td>
                                <td><?php echo $value['modo_pago_factura']?></td>
                                <td><?php echo $value['porcentaje_venta_factura']?></td>
                                <?php if (Helpers::hasPermissions('6','5')): ?>
                                <td>
                                    <a href="<?php echo Helpers::url('Factura','details');?>/<?php echo $value['codigo_factura'];?>" class="btn btn-small btn-floating pink waves-effect effect-light"><i class="icon-pageview"></i></a>
                                </td>
                            </tr>
                            <?php endif; ?>
                        <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <?php require_once "views/layouts/footer.php"; ?>


    <script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/jquery-3.2.1.min.js"></script>
    <script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/datatables.js">
    </script>
    <script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/materialize.min.js"></script>
    <script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/plugins/sweetalert.min.js"></script>
    <script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/owner.js"></script>
    <script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/data/Factura.js"></script>
</body>
</html>