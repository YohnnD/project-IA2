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
    <title>Registrar Rol - Inversiones A2</title>
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
                    <a href="<?php echo Helpers::url('Seguridad', 'index'); ?>" class="breadcrumb">Seguridad</a>
                    <a href="<?php echo Helpers::url('Seguridad', 'roles'); ?>" class="breadcrumb">Gestionar Roles y Permisos</a>
                    <a href="<?php echo Helpers::url('Seguridad', 'create'); ?>" class="breadcrumb">Registrar Rol</a>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <form action="" method="post" class="card">
                <div class="card-header center-align">
                    <h5>Registrar Rol</h5>
                </div>
                <div class="card-content row">
                    <div class="input-field col s12 m6">
                        <i class="icon-assignment prefix"></i>
                        <input type="text" name="nombre_rol" id="nombre_rol" class="validate"   required>
                        <label for="nombre_rol">Nombre</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <i class="icon-directions prefix"></i>
                        <textarea name="descripcion_rol" id="descripcion_rol" cols="30" rows="10" class="materialize-textarea" required></textarea>
                        <label for="descripcion_rol">Descripción</label>
                    </div>
                    <table class="striped centered">
                        <thead>
                            <tr>
                                <th>Módulo</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <p>
                                        <label>
                                            <input type="checkbox" id="" name=""/>
                                            <span>Gestionar Usuario</span>
                                        </label>
                                    </p>
                                </td>
                                <td>
                                    <div class="input-field col s12 m6 left-align">
                                        <p>
                                            <label>
                                                <input type="checkbox" id="" name=""/>
                                                <span>Registrar</span>
                                            </label>
                                        </p>
                                        <p>
                                            <label>
                                                <input type="checkbox" id="" name=""/>
                                                <span>Consultar</span>
                                            </label>
                                        </p>
                                        <p>
                                            <label>
                                                <input type="checkbox" id="" name=""/>
                                                <span>Modificar</span>
                                            </label>
                                        </p>
                                        <p>
                                            <label>
                                                <input type="checkbox" id="" name=""/>
                                                <span>Eliminar</span>
                                            </label>
                                        </p>
                                    </div>
                                </td>
                            </tr>   
                            <tr>
                                <td>
                                    <p>
                                        <label>
                                            <input type="checkbox" id="" name=""/>
                                            <span>Gestionar Usuario</span>
                                        </label>
                                    </p>
                                </td>
                                <td>
                                    <div class="input-field col s12 m6 left-align">
                                        <p>
                                            <label>
                                                <input type="checkbox" id="" name=""/>
                                                <span>Registrar</span>
                                            </label>
                                        </p>
                                        <p>
                                            <label>
                                                <input type="checkbox" id="" name=""/>
                                                <span>Consultar</span>
                                            </label>
                                        </p>
                                        <p>
                                            <label>
                                                <input type="checkbox" id="" name=""/>
                                                <span>Modificar</span>
                                            </label>
                                        </p>
                                        <p>
                                            <label>
                                                <input type="checkbox" id="" name=""/>
                                                <span>Eliminar</span>
                                            </label>
                                        </p>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>
                                        <label>
                                            <input type="checkbox" id="" name=""/>
                                            <span>Gestionar Usuario</span>
                                        </label>
                                    </p>
                                </td>
                                <td>
                                    <div class="input-field col s12 m6 left-align">
                                        <p>
                                            <label>
                                                <input type="checkbox" id="" name=""/>
                                                <span>Registrar</span>
                                            </label>
                                        </p>
                                        <p>
                                            <label>
                                                <input type="checkbox" id="" name=""/>
                                                <span>Consultar</span>
                                            </label>
                                        </p>
                                        <p>
                                            <label>
                                                <input type="checkbox" id="" name=""/>
                                                <span>Modificar</span>
                                            </label>
                                        </p>
                                        <p>
                                            <label>
                                                <input type="checkbox" id="" name=""/>
                                                <span>Eliminar</span>
                                            </label>
                                        </p>
                                    </div>
                                </td>
                            </tr>                   
                        </tbody>
                    </table>
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
</body>
</html>