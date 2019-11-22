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
    <title>Servicios - Inversiones A2</title>
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
                    <a href="<?php echo Helpers::url('Configuracion','index'); ?>" class="breadcrumb">Configuración</a>
                    <a href="<?php echo Helpers::url('Servicio','index'); ?>" class="breadcrumb">Gestionar Servicios</a>
                    <a href="<?php echo Helpers::url('Servicio','create'); ?>" class="breadcrumb">Añadir Material</a>
                </div>
                <div class="col s12">
                    <h4 class="center-align">Añadir Material</h4>
                </div>
                <div class="col s12">
                    <table class="striped centered responsive-table" id="Materiales">
                        <thead>
                            <tr>
                                <th>Materiales</th>
                                <th>Añadir</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($materiales as $value):?>
    
                            <tr>
                                <td><?php echo $value->nombre_material?></td>
                                <td>
                                    <a href="<?php echo Helpers::url('Servicio','searchMateriales');?>/<?php echo $idServicio.'-'.$value->id_material?>" class="btn btn-small btn-floating pink waves-effect effect-light"><i class="icon-add"></i></a>
                                </td>
                            </tr>

                        <?php endforeach ?>
                        </tbody>
                    </table>
                    <div class="col s12 m6">
                        <a class="btn blue waves-light waves-effect col s12" href="<?php echo Helpers::url('Servicio','getAll')?>"><i class="icon-refresh"></i>Volver A Servicios</a>
                    </div>
                    <div class="col s12 m6">
                        <a class="btn blue waves-light waves-effect col s12" href="<?php echo Helpers::url('Material','create')?>"><i class="icon-add"></i>Registrar Material</a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <?php require_once "views/layouts/footer.php"; ?>


    <script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/jquery-3.2.1.min.js"></script>
    <script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/datatables.js"></script>
    <script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/materialize.min.js"></script>
    <script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/plugins/sweetalert.min.js"></script>
    <script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/owner.js"></script>
    <script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/data/Servicio.js"></script>
</body>
</html>