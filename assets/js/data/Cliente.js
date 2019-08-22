$(document).ready(function () {
    // Registrar
    $('#register').submit(function (e) {
        e.preventDefault();
        // Getting form data
        var tipo_documento_cliente = $('#tipo_documento_cliente').val();
        var cedula_cliente = $('#cedula_cliente').val();
        var nombre_cliente = $('#nombre_cliente').val();
        var descripcion_cliente = $('#descripcion_cliente').val();
        var direccion_cliente = $('#direccion_cliente').val();
        var telefono_cliente = $('#telefono_cliente').val();
        var representante_cliente = $('#representante_cliente').val();

        // Sending data by AJAX
        $.ajax({
            method: "POST",
            dataType: "json",
            data: {
                    tipo_documento_cliente: tipo_documento_cliente,
                    cedula_cliente: cedula_cliente,
                    nombre_cliente: nombre_cliente,
                    descripcion_cliente: descripcion_cliente,
                    direccion_cliente: direccion_cliente,
                    telefono_cliente: telefono_cliente,
                    representante_cliente: representante_cliente
                    },
            // url: "",
            beforeSend: function() {
                console.log("Sending data...");
            },
            success: function(data) {
                console.log(data);
                swal({
                    title: "¡Bien hecho!",
                    text: "Se ha registrado el cliente " + nombre_cliente + " exitosamente.",
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
                    location.href = "Clientes.php";
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
    $('#modify').click(function() {
        
    });


    // Actualizar
    $('#update').submit(function (e) {
        e.preventDefault();
    });


    // Eliminar
    $('#delete').click(function () {
        swal({
            title: "Eliminar Cliente ???",
            text: "¿Esta seguro que desea eliminar este cliente? Si lo hace, no podrá revertir los cambios.",
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