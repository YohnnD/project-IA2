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
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/animate.min.css">
    <title>Consultar Pedidos - Inversiones A2</title>
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
                    <a href="<?php echo Helpers::url('Factura','FactuIndex'); ?>" class="breadcrumb">Facturación de Ventas</a>
                </div>
                <div class="col s12">
                    <h4 class="center-align">Listado de Facturas</h4>
                </div>
                <?php if ($allFactura == null): ?>
                        <h2 class="center-align">No Hay Ninguna Factura Registrada Aún.</h2>
                    <!-- Cards -->
                <div class="col s12">
                    <?php else: ?>
                    <table class="responsive-table centered striped">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Cliente</th>
                                <th>Estado</th>
                                <th>Fecha de Factura</th>
                                <th>Fecha de Entrega</th>
                                <th>Dolares</th>
                                <th>Bolivares</th>
                            </tr>
                        </thead>
                        
                            
                        <tbody>
                         <?php foreach ($allFactura as $factura): ?>   
                            <tr>
                                <td><?php echo $factura->codigo_factura?></td>
                                <td><?php echo $factura->nombre_cliente?></td>
                                <td><?php echo $factura->status_pedido?></td>
                                <td><?php echo $factura->fecha_factura?></td>
                                <td><?php echo $factura->fecha_entrega_pedido?></td>
                                <td><a href="<?php echo Helpers::url('Reporte','facturaById')."/".$factura->codigo_factura?>" class="btn btn-floating green waves-effect waves-light"><i class="icon-monetization_on"></i></a></td>
                                <td>
                                    <a href="<?php echo Helpers::url('Reporte','setDolar')."/".$factura->codigo_factura?>" class="btn btn-floating amber waves-effect waves-light"><i class="icon-money_off"></i></a></td> 
                           ?>
                            </tr>
                        <?php endforeach;?>
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
    <script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/data/Pedido.js"></script>
</body>
</html>
