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
    <title>Inicio - Inversiones A2</title>
</head>
<body>
    <!-- Header -->
    <?php require_once "views/layouts/header.php" ?>

    <!-- Main Container -->
    <main>
        <div class="container-fluid">
            <!-- Enlaces rapidos -->
            <div class="row">
                <div class="col s12 breadcrumb-nav left-align">
                    <a href="#!" class="breadcrumb">Inicio</a>
                </div>
                <!-- <div class="col s12">
                    <h4>Enlaces rápidos</h4>
                </div> -->
                <?php if($_SESSION): ?>
                <div class="col s12">
                    <div class="alert alert-success">
                        <?php var_dump($_SESSION); ?>
                    </div>
                </div>
                <?php endif; ?>
                <?php if(isset($_SESSION['permissions']) && $_SESSION['permissions']['id_modulo'] == 2): ?>

                <div class="col s12 m3">
                    <a href="<?php echo Helpers::url('Producto','index'); ?>" class="btn-app green">
                        <i class="icon-loyalty"></i>
                        <span class="truncate">Gestionar Producto</span>
                    </a>
                </div>
                <?php endif; ?>
                <?php if(isset($_SESSION['permissions']) && $_SESSION['permissions']['id_modulo'] == 4): ?>
                <div class="col s12 m3">
                    <a href="<?php echo Helpers::url('Cliente','index'); ?>" class="btn-app purple">
                        <i class="icon-contact_phone"></i>
                        <span class="truncate">Gestionar Clientes</span>
                    </a>
                </div>
                <?php endif; ?>
                <?php if(isset($_SESSION['permissions']) && $_SESSION['permissions']['id_modulo'] == 3): ?>
                <div class="col s12 m3">
                    <a href="<?php echo Helpers::url('Pedido','index'); ?>" class="btn-app">
                        <i class="icon-library_books"></i>
                        <span class="truncate">Gestionar Pedidos</span>
                    </a>
                </div>
                <?php endif; ?>
                <?php if(isset($_SESSION['permissions']) && $_SESSION['permissions']['id_modulo'] == 6): ?>
                <div class="col s12 m3">
                    <a href="<?php echo Helpers::url('Factura','index'); ?>" class="btn-app red">
                        <i class="icon-event_available"></i>
                        <span class="truncate">Facturación de Ventas</span>
                    </a>
                </div>
                <?php endif; ?>
                <?php if(isset($_SESSION['permissions']) && ($_SESSION['permissions']['id_modulo'] == 5 || $_SESSION['permissions']['id_modulo'] == 8 || $_SESSION['permissions']['id_modulo'] == 9)): ?>
                <div class="col s12 m3">
                    <a href="<?php echo Helpers::url('Configuracion','index'); ?>" class="btn-app yellow">
                        <i class="icon-build"></i>
                        <span class="truncate">Configuración</span>
                    </a>
                </div>
                <?php endif ?>
                <?php if(isset($_SESSION['permissions']) && $_SESSION['permissions']['id_modulo'] == 7): ?>
                <div class="col s12 m3">
                    <a href="<?php echo Helpers::url('Reporte','reporteIndex'); ?>" class="btn-app cyan">
                        <i class="icon-report"></i>
                        <span class="truncate">Reportes</span>
                    </a>
                </div>
            <?php endif; ?>
            </div>
            <div class="row">
                <div class="col s12 m3">
                    <a href="<?php echo Helpers::url('Usuario','index'); ?>" class="btn-app blue">
                        <i class="icon-group_add"></i>
                        <span class="truncate">Gestionar Usuarios</span>
                    </a>
                </div>
                <div class="col s12 m3">
                    <a href="<?php echo Helpers::url('Seguridad','index'); ?>" class="btn-app green">
                        <i class="icon-security"></i>
                        <span class="truncate">Seguridad</span>
                    </a>
                </div>
                <div class="col s12 m3">
                    <a href="<?php echo Helpers::url('Mantenimiento','index'); ?>" class="btn-app orange">
                        <i class="icon-perm_data_setting"></i>
                        <span class="truncate">Mantenimiento</span>
                    </a>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <?php require_once "views/layouts/footer.php"; ?>

    <script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/jquery-3.2.1.min.js"></script>
    <script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/materialize.min.js"></script>
    <script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/owner.js"></script>
    <script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/plugins/Chart.min.js"></script>
    <script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/plugins/sweetalert.min.js"></script>
    <script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/plugins/bootstrap-notify.min.js"></script>
    <script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/plugins/jquery.countTo.js"></script>
</body>
</html>