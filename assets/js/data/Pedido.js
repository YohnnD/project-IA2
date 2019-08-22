$(document).ready(function () {
    // Registrar
    $('#register').submit(function (e) {
        e.preventDefault();
        // Getting form data
        var cedula_cliente = $('#cedula_cliente').val();
        var status_pedido = $('#status_pedido').val();
        var fecha_pedido = $('#fecha_pedido').val();
        var descripcion_pedido = $('#descripcion_pedido').val();
        var id_servicio = $('#id_servicio').val();
        var cantidad_prenda = $('#cantidad_prenda').val();
        var cantidad_medida = $('#cantidad_medida').val();
        var precio_servi_pedido = $('#precio_servi_pedido').val();

        // Sending data by AJAX
        $.ajax({
            method: "POST",
            dataType: "json",
            data: {
                    cedula_cliente: cedula_cliente,
                    status_pedido: status_pedido,
                    fecha_pedido: fecha_pedido,
                    descripcion_pedido: descripcion_pedido,
                    id_servicio: id_servicio,
                    cantidad_prenda: cantidad_prenda,
                    cantidad_medida: cantidad_medida,
                    precio_servi_pedido: precio_servi_pedido
                    },
            // url: "",
            beforeSend: function() {
                console.log("Sending data...");
            },
            success: function(data) {
                console.log(data);
                swal({
                    title: "¡Bien hecho!",
                    text: "Se ha registrado el pedido con el ID " + '1234' + " exitosamente.",
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
                    location.href = "Pedidos.php";
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

    });
});