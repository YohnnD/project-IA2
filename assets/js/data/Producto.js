var url = "http://localhost/project-ia2/Producto/";
$(document).ready(function(){
    // Registrar
    $('#register').submit(function(e) {
        e.preventDefault();
        // Getting form data
        var nombre_producto = $('#nombre_producto').val();
        var descripcion_producto = $('#descripcion_producto').val();
        var tipo_producto = $('#tipo_producto').val();
        var modelo_producto = $('#modelo_producto').val();
        var precio_producto = $('#precio_producto').val();
        var stock_min_producto = $('#stock_min_producto').val();
        var stock_max_producto = $('#stock_max_producto').val();
        var talla = $('#talla').val();
        var stock_pro_talla = $('#stock_pro_talla').val();

        // Sending data by AJAX
        $.ajax({
            method: "POST",
            dataType: "json",
            data: {
                    nombre_producto: nombre_producto,
                    descripcion_producto: descripcion_producto,
                    tipo_producto: tipo_producto,
                    modelo_producto: modelo_producto,
                    precio_producto: precio_producto,
                    stock_min_producto: stock_min_producto,
                    stock_max_producto: stock_max_producto,
                    talla: talla,
                    stock_pro_talla: stock_pro_talla
                },
            url: url + "register",
            beforeSend: function() {
                console.log("Sending data...");
            },
            success: function(data) {
                console.log(data);
                swal({
                    title: "¡Bien hecho!",
                    text: "Se ha registrado el producto '" + nombre_producto + "' exitosamente.",
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
                    location.href = url + "index";
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


    // Eliminar
    $('#delete').click(function (){
        swal({
            title: "Eliminar Producto",
            text: "¿Esta seguro que desea eliminar este producto? Si lo hace, no podrá revertir los cambios.",
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