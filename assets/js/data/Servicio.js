$(document).ready(function () {
    // Registrar
    $('#register').submit(function (e) {
        e.preventDefault();
        // Getting form data
        var nombre_servicio = $('#nombre_servicio').val();
        var unidad_medida = $('#unidad_medida').val();
        var precio_servicio = $('#precio_servicio').val();
        var costo_servicio = $('#costo_servicio').val();
        var descripcion_servicio = $('#descripcion_servicio').val();
        // Sending data by AJAX
        $.ajax({
            method: "POST",
            dataType: "json",
            data: {
                    nombre_servicio: nombre_servicio,
                    unidad_medida: unidad_medida,
                    precio_servicio: precio_servicio,
                    costo_servicio: costo_servicio,
                    descripcion_servicio: descripcion_servicio,
                    },
            // url: "",
            beforeSend: function() {
                console.log("Sending data...");
            },
            success: function(data) {
                console.log(data);
                swal({
                    title: "¡Bien hecho!",
                    text: "Se ha registrado el servicio " + nombre_servicio + " exitosamente.",
                    icon: "success",
                    button: {
                        text: "Aceptar",
                        visible: true,
                        value: true,
                        className: "green",
                        closeModal: true
                    },
                    timer: 3000
                })
                .then(redirect => {
                    location.href = "Servicios.php";
                })
            },
            error: function(err) {
                console.log(err);
                swal({
                    title: "¡Oh no!",
                    text: "Ha ocurrido un error inesperado, refresca la página e intentalo de nuevo.",
                    icon: "error",
                    button: {
                        text: "Aceptar",
                        visible: true,
                        value: true,
                        className: "green",
                        closeModal: true
                    }
                });
            }
        });
    });

    // Modificar


    // Actualizar
    $('#update').submit(function (e) {
        e.preventDefault();
    });


    // Eliminar
    $('#delete').click(function () {
        swal({
            title: "Eliminar Servicio ????",
            text: "¿Esta seguro que desea eliminar este servicio? Si lo hace, no podrá revertir los cambios.",
            icon: "warning",
            buttons: {
                confirm: {
                    text: "Eliminar",
                    value: true,
                    visible: true,
                    className: "red"

                },
                cancel: {
                    text: "Cancelar",
                    value: false,
                    visible: true,
                    className: "grey lighten-2"
                }
            }
        })
    });
});