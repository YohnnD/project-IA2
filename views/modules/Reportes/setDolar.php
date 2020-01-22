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
    <link rel="shortcut icon" href="<?php echo BASE_URL; ?>assets/images/logo-trasparente.png">
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
                    <a href="<?php echo Helpers::url('Factura','setDolar'); ?>" class="breadcrumb">Facturación en Bolivares</a>
                </div>
                <div class="col s12">
                    <h4 class="center-align">Precio del Dolar</h4>
                </div>
                <?php if (empty($allFactura)){ ?>
                        <h2 class="center-align">No Hay Ninguna Factura Registrada Aún.</h2>
                    <!-- Cards -->
               
                <div class="col s12">
                    <?php }else ?>
                   
                        
<div class="row">
    <div class="col s12 m6">
      <div class="card-panel">
        <span>
            <?php foreach ($allFactura as $factura): ?> 
        <form action="<?php echo Helpers::url('Reporte','facturaBolivares')."/".$factura->codigo_factura?>" method="post">
        <input type="hidden" name="id" value="<?php echo $factura->codigo_factura?>"> 
            <?php endforeach;?>
          <div class="input-field">                     
          <i class="icon-attach_money prefix"></i>
          <input type="number" id="dolar" name="dolar" value="" class="validate">
          <label for="dolar">Precio Dolar</label>
          </div>
        <div>
            <button type="submit" class="btn-large waves-effect waves-light green"><i class="icon-money_off"></i>Imprimir PDF</a></button>
            
        </div>
        </form>       
                           
        
        
        </span>
      </div>
    </div>
  </div>
                            
                     
                         
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
