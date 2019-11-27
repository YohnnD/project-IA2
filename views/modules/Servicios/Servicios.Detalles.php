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
    <title>Detalles - Inversiones A2</title>
</head>
<body>
    <!-- Header -->
    <?php require_once "views/layouts/header.php"; ?>

    <!-- Main Container -->
    <main>
        <div class="container">
            <form action="" class="row">
                <div class="col s12 breadcrumb-nav left-align">
                    <a href="<?php echo Helpers::url('Home','index'); ?>" class="breadcrumb">Inicio</a>
                    <a href="<?php echo Helpers::url('Configuracion','index'); ?>" class="breadcrumb">Configuración</a>
                    <a href="<?php echo Helpers::url('Servicio','index'); ?>" class="breadcrumb">Gestionar Servicios</a>
                    <a href="<?php echo Helpers::url('Servicio','create'); ?>" class="breadcrumb">Consultar Servicios</a>
                    <!--<a href="<?php echo Helpers::url('Servicio','create'); ?>" class="breadcrumb">Detalles</a>-->
                </div>
                <?php foreach($detalles as $value):?>
                <div class="col s12">
                    <h4 class="center-align">Detalles del Servicio</h4>
                </div>
                <div class="input-field col s12 m6 xl6">
                    <i class="icon-stars prefix"></i>
                    <input type="hidden" name="id_servicio" id="id_servicio" value="<?php echo $value['id_servicio']?>" disabled>
                    <input type="text" name="nombre_servicio" id="nombre_servicio" value="<?php echo $value['nombre_servicio']?>" disabled>
                    <label for="nombre_servicio">Nombre Del Servicio</label>
                </div>
                <div class="input-field col s12 m6 xl6">
                    <i class="icon-attach_money prefix"></i>
                    <input type="text" name="precio_servicio" id="precio_servicio" value="<?php echo $value['precio_servicio']?>" disabled>
                    <label for="precio_servicio">Precio del Servicio</label>
                </div>
                <div class="input-field col s12 m6 xl6">
                    <i class="icon-monetization_on prefix"></i>
                    <input type="text" name="costo_servicio" id="costo_servicio" value="<?php echo $value['costo_servicio']?>" disabled>
                    <label for="costo_servicio">Costo del Servicio</label>
                </div>
                <div class="input-field col s12 m6 xl6">
                    <i class="icon-open_with prefix"></i>
                    <input type="text" name="unidad_medida" id="unidad_medida" value="<?php echo $value['unidad_medida']?>" disabled>
                    <label for="unidad_medida">Und de Medida</label>
                </div>
                
                <div class="input-field col s12 m12 xl12">
                    <i class="icon-description prefix"></i>
                    <textarea name="descripcion" id="descripcion_servicio" cols="30" rows="10" class="materialize-textarea" disabled><?php echo $value['descripcion_servicio']?></textarea>
                    <label for="descripcion">Descripción</label>
                </div>
                
            <?php endforeach?>
            <h5 class="center">Materiales</h5>
                <hr>
             <?php if(!empty($materiales)): 
             foreach ($materiales as $resul):?>
                <div class="input-field col s12 m6 xl6">
                    <i class="icon-map prefix"></i>
                    <input type="text" name="unidad_medida" id="unidad_medida" value="<?php echo $resul->nombre_material?>" disabled>
                    <label for="unidad_medida">Material</label>
                </div>
                <div class="input-field col s12 m4 xl4 ">
                    <i class="icon-open_with prefix"></i>
                    <input type="text" name="unidad_medida" id="unidad_medida" value="<?php echo $resul->cant_mat_servicio?>" disabled>
                    <label for="unidad_medida">Cantidad</label>
                </div>
                <div class="input-field col s12 m2 l2 " >
                    <a href="<?php echo Helpers::url('Servicio','deleteMaterial');?>/<?php echo $resul->id_material?>" class="btn red waves-effect waves-light col s12 materiales" disabled>
                        <i class="icon-delete right"></i>
                    </a>
                </div>
                <?php endforeach;endif;?>
                <div class="input-field col s12 m6 center-align">
                    <a href="#" class=" materiales btn blue waves-effect waves-light col s12" id="modify">
                        <i class="icon-update right"></i>
                        Modificar
                    </a>
                </div>
                <div class="input-field col s12 m6 center-align">
                    <a href="#" class="btn red waves-effect waves-light col s12" id="delete">
                        <i class="icon-delete right"></i>
                        Eliminar
                    </a>                
                </div>
                <div class="input-field col s12 m6 center-align">
                    <a href="<?php echo Helpers::url('Servicio','getMateriales');?>/<?php echo $value['id_servicio']?>" class="btn green waves-effect waves-light col s12" id="addMaterial">
                        <i class="icon-add right"></i>
                        Añadir Material
                    </a>
                </div>
                <div class="input-field col s12 m6 center-align">
                    <a href="#" class="btn red waves-effect waves-light col s12" id="deleteMaterial">
                        <i class="icon-delete right"></i>
                        Eliminar Material
                    </a>
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