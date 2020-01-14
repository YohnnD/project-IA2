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
        <link rel="shortcut icon" href="<?php echo BASE_URL; ?>assets/images/logo-trasparente.png">

        <title>Detalles - Inversiones A2</title>
    </head>
    <body>
        <!-- Header -->
        <?php require_once "views/layouts/header.php"; ?>

        <!-- Main Container -->
        <main>
            <div class="container">
                <form action="" id="MaterialServi" class="row">
                    <div class="col s12 breadcrumb-nav left-align">
                        <a href="<?php echo Helpers::url('Home', 'index'); ?>" class="breadcrumb">Inicio</a>
                        <a href="<?php echo Helpers::url('Configuracion', 'index'); ?>" class="breadcrumb">Configuración</a>
                        <a href="<?php echo Helpers::url('Servicio', 'index'); ?>" class="breadcrumb">Gestionar Servicios</a>
                        <a href="<?php echo Helpers::url('Servicio', 'create'); ?>" class="breadcrumb">Añadir Material</a>
                        <!--<a href="<?php echo Helpers::url('Servicio', 'create'); ?>" class="breadcrumb">Detalles</a>-->
                    </div>
                    <?php foreach ($materiales as $value): ?>
                        <div class="col s12">
                            <h4 class="center-align">Añadir Material Al Servicio</h4>
                        </div>
                        <div class="input-field col s12 m6 xl6">
                            <i class="icon-stars prefix"></i>
                            <input type="hidden" name="id" id="id_material" value="<?php echo $value['id_material'] ?>" disabled>
                            <input type="text"disabled name="nombre_material" id="nombre_material" value="<?php echo $value['nombre_material'] ?>" disabled>
                            <label for="nombre_material">Material</label>
                        </div>
                        <div class="input-field col s12 m6 xl6">
                            <i class="icon-attach_money prefix"></i>
                            <input type="text" name="cantidad" id="cantidad" value="">
                            <label for="cantidad">Cantidad</label>
                        </div>

                    <?php endforeach ?>
                    <div class="input-field col s12 m6 center-align">
                        <button type="submit" class="btn blue waves-effect waves-light col s12">
                            <i class="icon-update right"></i>
                            Registrar
                        </button>
                    </div>
                </form>
            </div>
        </main>

        <!-- Footer -->
        <?php require_once "views/layouts/footer.php"; ?>


        <script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/jquery-3.2.1.min.js"></script>
        <script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/materialize.min.js"></script>
        <script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/plugins/sweetalert.min.js"></script>
        <script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/owner.js"></script>
        <script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/data/servicio.js"></script>
    </body>
</html>