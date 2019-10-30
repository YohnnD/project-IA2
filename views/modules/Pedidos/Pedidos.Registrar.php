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
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/styles.css">
    <title>Registrar Pedido - Inversiones A2</title>
</head>


<body>
<!-- Header -->
<?php require_once "views/layouts/header.php"; ?>

<!-- Main Container -->
<main>
    <div class="container-fluid">
        <div class="row">
            <div class="col s12 breadcrumb-nav left-align">
                <a href="<?php echo Helpers::url('Home', 'index'); ?>" class="breadcrumb">Inicio</a>
                <a href="<?php echo Helpers::url('Pedido', 'index'); ?>" class="breadcrumb">Gestionar Pedidos</a>
                <a href="<?php echo Helpers::url('Pedido', 'create'); ?>" class="breadcrumb">Registrar Pedido</a>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="row">
            <div class="section">
                <h3 class="center-align black-text">Registrar Pedido</h3>
            </div>
            <div class="row">
                <ul id="tabs-swipe-demo" class="tabs center-align">
                    <li class="tab col m3 "><a class="active" href="#one">PEDIDO-CLIENTE</a></li>
                    <li class="tab col m3 "><a href="#two" class="disabled">SERVICIOS</a></li>
                    <li class="tab col m3 "><a href="#three" >PRODUCTOS</a></li>
                    <li class="tab col m3 "><a href="#four" class="four">PAGOS</a></li>
                </ul>
            </div>
            <!-- Tab 1 -->
            <div class="row p-5x" id="one">
                <div class="col s12">
                    <form method="get" action="" class="row" id="form-consul-client">
                        <div class="col s12">
                            <h4 class="center-align"></h4>
                        </div>
                        <div class="input-field col s12 m6">
                            <i class="icon-person prefix"></i>
                            <input type="text" name="cedula_cliente" id="cedula_cliente" class="validate" minlength="5"
                                   maxlength="15" pattern="[VvJjEe0-9]+"
                                   title="Solo puede usar números del 0-9 y V, J ó E" required>
                            <label for="cedula_cliente">Cedula o RIF del Cliente</label>
                        </div>
                        <div class="input-field col s12 m6">
                            <i class="icon-person prefix"></i>
                            <input type="text" name="nombre_cliente" id="nombre_cliente" class="validate" minlength="5"
                                   maxlength="15" pattern="[VvJjEe0-9]+"
                                   title="Solo puede usar números del 0-9 y V, J ó E" required disabled>
                            <label for="nombre_cliente">Nombre</label>
                        </div>

                        <div class="input-field col s12 m12">
                            <i class="icon-person prefix"></i>
                            <input type="text" name="representante_cliente" id="representante_cliente" class="validate"
                                   minlength="5" maxlength="15" pattern="[VvJjEe0-9]+"
                                   title="Solo puede usar números del 0-9 y V, J ó E" required disabled>
                            <label for="representante_cliente">Representante</label>
                        </div>
                    </form>
                </div>

                <div class="col l12">
                    <form method="get" action="" class="row" id="form-pedido">
                        <div class="input-field col s12 m6">
                            <i class="icon-insert_invitation prefix"></i>
                            <input type="text" name="fecha_pedido" id="fecha_pedido" class="datepicker">
                            <label for="fecha_pedido">Fecha del Pedido</label>
                        </div>

                        <div class="input-field col s12 m6">
                            <i class="icon-event_available prefix"></i>
                            <input type="text" name="fecha_entrega_pedido" id="fecha_entrega_pedido" class="datepicker">
                            <label for="fecha_entrega_pedido">Fecha de Entrega</label>
                        </div>


                        <div class="input-field col s12 m12">
                            <i class="icon-description prefix"></i>
                            <textarea name="descripcion_pedido" id="descripcion_pedido"
                                      class="materialize-textarea"></textarea>
                            <label for="descripcion_pedido">Descripción</label>

                        </div>

                        <input type="hidden" name="codigo_pedido" id="codigo_pedido" value="">


                        <div class="input-field col s12 center-align">
                            <button type="submit" class="btn a2-green waves-effect waves-light col s12">
                                <i class="icon-send right"></i>
                                SIGUIENTE(1/4)
                            </button>
                        </div>

                    </form>
                </div>
            </div>
            <!-- Tab 2 -->
            <div id="two" class="row p-5x">
                <div class="col s12">
                    <form action="" method="post" class="row" id="register-service">
                        <div class="input-field col s12 m6" id="id_servicio">
                            <?php foreach ($services as $service): ?>
                                <p class="">
                                    <label>
                                        <input type="checkbox" value="<?php echo $service->id_servicio; ?>"
                                               name="<?php echo $service->nombre_servicio; ?>"
                                               id="<?php echo substr($service->nombre_servicio, 0, 4) ?>">
                                        <span><?php echo $service->nombre_servicio ?></span>
                                    </label>

                                </p>
                            <?php endforeach; ?>


                            <!--
                            <i class="icon-star prefix"></i>
                            <select name="id_servicio" id="id_servicio" multiple>
                                <option value="null" disabled>Elige una opción</option>
                               <?php foreach ($services as $service): ?>
                                <option value="<?php echo $service->id_servicio ?>" id="<?php echo substr($service->nombre_servicio, 0, 4) ?>"><?php echo $service->nombre_servicio ?></option>
                                <?php endforeach; ?>
                            </select>
                            <label for="id_servicio">Servicio</label>
                            -->

                        </div>

                        <div class="input-field col s12 m6">
                            <button type="button" class="btn a2-green waves-effect waves-light col s12"
                                    id="add-services">
                                <i class="icon-add right"></i>
                                Añadir
                                <i class="icon-receipt left"></i>
                            </button>
                        </div>

                        <div id="services">

                        </div>


                        <div class="input-field col s12 center-align">
                            <button type="submit" class="btn a2-green waves-effect waves-light col s12">
                                <i class="icon-send right"></i>
                                SIGUIENTE(2/4)
                            </button>
                        </div>


                    </form>

                </div>
            </div>

            <div class="row p-5x" id="three">
                <form method="#" action="#" id="register-product">
                    <div class="row">
                        <div class="input-field col s12">
                            <i class="material-icons prefix icon-search"></i>
                            <input type="text" id="search" class="autocomplete" autocomplete="off">
                            <label for="autocomplete-input">Buscar</label>
                        </div>
                        <table class="responsive-table striped">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Producto</th>
                                    <th>Cant Pedida</th>
                                    <th>Precio</th>
                                </tr>
                            </thead>


                            <tbody id="product-list">

                            </tbody>
                        </table>

                        <div class="input-field col s12 center-align">
                            <button type="submit" class="btn a2-green waves-effect waves-light col s12">
                                <i class="icon-send right"></i>
                                SIGUIENTE(3/4)
                            </button>
                        </div>
                </form>
            </div>
        </div>

            <div class="row p-5x" id="four">
                <form method="#" action="#" id="register-factura">
                    <div class="input-field col s12">
                        <i class="icon-star prefix"></i>
                        <select name="forma_de_pago" id="forma_pago">
                            <option value="null" disabled selected>Elige una opción</option>
                            <option value="transferencia">Tranferencia</option>
                            <option value="efectivo">Efectivo</option>
                            <option value="debito">Debito</option>
                            <option value="credito">Credito</option>
                        </select>
                        <label for="forma_pago">Forma de pago</label>
                    </div>

                    <div class="input-field col s12 m12">
                        <i class="icon-person prefix"></i>
                        <input type="text" name="porcentaje" id="porcentaje" class="validate"  pattern="[VvJjEe0-9]+" value="0"
                               title="Solo puede usar números del 0-9 y V, J ó E" required>
                        <label for="porcentaje">Porcentaje</label>
                    </div>
                                       <div class="input-field col s12 m12">
                                           <i class="icon-person prefix"></i>
                                           <input type="text" name="total_servicios" id="total_servicios" class="validate money"
                                                  minlength="5" maxlength="15" pattern="[VvJjEe0-9]+"
                                                  title="Solo puede usar números del 0-9 y V, J ó E" required readonly>
                                           <label for="total_servicios">Precio de Servicios</label>
                                       </div>

                    <div class="input-field col s12 m12">
                        <i class="icon-person prefix"></i>
                        <input type="text" name="total_producto" id="total_producto" class="validate money"
                               minlength="5" maxlength="15" pattern="[VvJjEe0-9]+"
                               title="Solo puede usar números del 0-9 y V, J ó E" required readonly>
                        <label for="total_producto">Precio de productos</label>
                    </div>



                  <div class="input-field col s12 m12">
                      <i class="icon-person prefix"></i>
                      <input type="text" name="total_pagar" id="total_pagar" class="validate money"
                             minlength="5" maxlength="15" pattern="[VvJjEe0-9]+"
                             title="Solo puede usar números del 0-9 y V, J ó E" required readonly>
                      <label for="total_pagar">Total a Pagar:</label>
                  </div>

                    <div class="input-field col s12 center-align">
                        <button type="submit" class="btn a2-green waves-effect waves-light col s12">
                            <i class="icon-send right"></i>
                            TERMINAR(3/4)
                        </button>
                    </div>
                </form>
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