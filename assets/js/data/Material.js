$(document).ready(function () {
    // Registrar
    $('#register').submit(function (e) {
        e.preventDefault();
        // Getting form data
        var nombre_material = $('#nombre_material').val();
        var unidad_material = $('#unidad_material').val();
        var precio_material = $('#precio_material').val();
        var descripcion_material = $('#descripcion_material').val();
        // Sending data by AJAX
        $.ajax({
            method: "POST",
            dataType: "json",
            data: {
                nombre_material: nombre_material,
                unidad_material: unidad_material,
                precio_material: precio_material,
                descripcion_material: descripcion_material,
            },
            // url: "",
            beforeSend: function () {
                console.log("Sending data...");
            },
            success: function (data) {
                console.log(data);
                swal({
                        title: "¡Bien hecho!",
                        text: "Se ha registrado la tela " + nombre_material + " exitosamente.",
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
                        location.href = "Telas.php";
                    })
            },
            error: function (err) {
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
            title: "Eliminar Material ????",
            text: "¿Esta seguro que desea eliminar este material? Si lo hace, no podrá revertir los cambios.",
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