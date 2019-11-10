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
                <div class="col s12 m3">
                    <a href="<?php echo Helpers::url('Usuario','index'); ?>" class="btn-app blue">
                        <i class="icon-group_add"></i>
                        <span class="truncate">Gestionar Usuarios</span>
                    </a>
                </div>
                <div class="col s12 m3">
                    <a href="<?php echo Helpers::url('Producto','index'); ?>" class="btn-app green">
                        <i class="icon-loyalty"></i>
                        <span class="truncate">Gestionar Producto Terminado</span>
                    </a>
                </div>
                <div class="col s12 m3">
                    <a href="<?php echo Helpers::url('Cliente','index'); ?>" class="btn-app purple">
                        <i class="icon-contact_phone"></i>
                        <span class="truncate">Gestionar Clientes</span>
                    </a>
                </div>
                <div class="col s12 m3">
                    <a href="<?php echo Helpers::url('Pedido','index'); ?>" class="btn-app">
                        <i class="icon-library_books"></i>
                        <span class="truncate">Gestionar Pedidos</span>
                    </a>
                </div>
                <div class="col s12 m3">
                    <a href="<?php echo Helpers::url('Factura','index'); ?>" class="btn-app red">
                        <i class="icon-event_available"></i>
                        <span class="truncate">Facturación de Ventas</span>
                    </a>
                </div>
                <div class="col s12 m3">
                    <a href="<?php echo Helpers::url('Configuracion','index'); ?>" class="btn-app yellow">
                        <i class="icon-build"></i>
                        <span class="truncate">Configuración</span>
                    </a>
                </div>
                <div class="col s12 m3">
                    <a href="<?php echo Helpers::url('Reporte','index'); ?>" class="btn-app cyan">
                        <i class="icon-report"></i>
                        <span class="truncate">Reportes</span>
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
            <div class="divider"></div>
            <!-- Widgets -->
            <div class="row">
                <div class="col s12 m4">
                    <div class="widget bootstrap-widget stats">
                        <div class="widget-stats-icon red white-text">
                            <i class="icon-group_add"></i>
                        </div>
                        <div class="widget-stats-content">
                            <span class="widget-stats-title">Clientes Registrados</span>
                            <?php foreach($cliente as $clientes): ?>
                            <span class="timer widget-stats-number" data-from="0" data-to="<?php echo $clientes->total ?>"></span>
                            <?php endforeach; ?>
                        </div>
                    </div> 
                </div>
                <div class="col s12 m4">
                    <div class="widget bootstrap-widget stats">
                        <div class="widget-stats-icon purple white-text">
                            <i class="icon-attach_money"></i>
                        </div>
                        <div class="widget-stats-content">
                            <span class="widget-stats-title">Ganancias del mes</span>
                            <span class="widget-stats-number">
                                <?php /* foreach($ganancia as $ganancias):*/ ?>
                                <span class="timer" data-from="0" data-to="50"></span>
                                <?php /*endforeach;*/ ?>
                                <span>$</span>
                            </span>
                        </div>
                        <div class="widget-progress">
                            <div class="progress purple lighten-3">
                                <div class="determinate purple" style="width:45%"></div>
                            </div>
                        </div>
                        <div class="widget-description">
                            Incremento de un 45% en este mes.
                        </div>
                    </div> 
                </div>
                <div class="col s12 m4">
                    <div class="widget bootstrap-widget stats">
                        <div class="widget-stats-icon blue white-text">
                            <i class="icon-equalizer"></i>
                        </div>
                        <div class="widget-stats-content">
                            <span class="widget-stats-title">Ventas facturadas</span>
                            <?php foreach($factura as $facturas): ?>
                            <span class="widget-stats-number"><?php echo $facturas->total ?></span>
                            <?php endforeach; ?>
                        </div>
                    </div> 
                </div>
            </div>
            <!-- Row para gráficos -->
            <div class="row">
                <div class="col s12 m12 xl6">
                    <div class="card">
                        <div class="card-content">
                            <canvas id="ventas"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col s12 m12 xl6">
                    <div class="card">
                        <div class="card-content">
                            <canvas id="ganancias"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Row para tablas -->
            <div class="row">
                <div class="col s12 m4">
                    <ul class="collection with-header">
                        <li class="collection-header"><h4>Pedidos Pendientes</h4></li>
                        <?php if($pedido==null){  ?>
                            <li class="collection-item">
                            
                            <div> 
                                <span class="title"></b>No hay Pedidos En Proceso</span><br>
                                
                            </div>
                        </li>
                        <?php }else{foreach($pedido as $pedidos): ?>
                        <li class="collection-item">
                            
                            <span class="new badge red" data-badge-caption="Pendiente"></span>
                            <span class="title"><b>Cliente: </b> <?php echo $pedidos->nombre_cliente; ?></span><br>
                            <span class=""><b>Contacto: </b><?php echo $pedidos->telefono_cliente; ?></span><br>
                            <span class=""><b>Fecha Entrega: </b><?php echo $pedidos->fecha_entrega_pedido; ?></span>
                            
                        </li>
                        <?php endforeach;}?>
                    </ul>
                </div>
                <div class="col s12 m4">
                    <ul class="collection with-header">
                        <li class="collection-header"><h4>Productos Vendidos</h4></li> 
                        <?php if($producto==null){  ?>
                            <li class="collection-item">
                            
                            <div> 
                                <span class="title"></b>No hay Productos Vendidos</span><br>
                                
                            </div>
                        </li>
                             
                        <?php  }else{foreach($producto as $productos): ?>
                        <li class="collection-item">
                            
                            <div> 
                                <span class="title"><b>Producto: </b><?php echo $productos->nombre_producto ?></span><br>
                                <span><b>Codigo: </b><?php echo $productos->codigo_producto; ?></span><br>
                                <span><b>Precio: </b><?php echo $productos->precio_producto; ?></span><br>
                                <span><b>Ventas por Pedidos: </b><?php echo $productos->total; ?></span>
                                <!-- <a href="#!" class="secondary-content" style="font-size:28px"><i class="icon-find_in_page"></i></a> -->
                            </div>
                        </li>
                            <?php endforeach;}?>
                    </ul>
                </div>

                <div class="col s12 m4">
                    <ul class="collection with-header">
                        <li class="collection-header"><h4>Sevicios Vendidos</h4></li> 
                        <?php if($servicio==null){  ?>
                            <li class="collection-item">
                            
                            <div> 
                                <span class="title"></b>No hay Servicios Vendidos</span><br>
                                
                            </div>
                        </li>
                             
                        <?php  
                        }else{foreach($servicio as $servicios): ?>
                        <li class="collection-item">
                            
                            <div> 
                                <span class="title"><b>Servicio: </b><?php echo $servicios->nombre_servicio ?></span><br>
                                <span><b>Descripción: </b><?php echo $servicios->descripcion_servicio; ?></span><br>
                                <span><b>Precio: </b><?php echo $servicios->precio_servicio; ?></span><br>
                                <span><b>Ventas por Pedidos: </b><?php echo $servicios->total; ?></span>
                                <!-- <a href="#!" class="secondary-content" style="font-size:28px"><i class="icon-find_in_page"></i></a> -->
                            </div>
                        </li>
                            <?php endforeach;}?>
                    </ul>
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
    <script type="application/javascript" src="<?php echo BASE_URL; ?>assets/js/data/dashboard.js"></script>
</body>
</html>