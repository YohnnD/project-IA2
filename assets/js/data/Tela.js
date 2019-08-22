$(document).ready(function () {
    // Registrar
    $('#register').submit(function (e) {
        e.preventDefault();
        // Getting form data
        var nombre_tela = $('#nombre_tela').val();
        var unidad_med_tela = $('#unidad_med_tela').val();
        var tipo_tela = $('#tipo_tela').val();
        var descripcion_tela = $('#descripcion_tela').val();
        // Sending data by AJAX
        $.ajax({
            method: "POST",
            dataType: "json",
            data: {
                    nombre_tela: nombre_tela,
                    unidad_med_tela: unidad_med_tela,
                    tipo_tela: tipo_tela,
                    descripcion_tela: descripcion_tela,
                    },
            // url: "",
            beforeSend: function() {
                console.log("Sending data...");
            },
            success: function(data) {
                console.log(data);
                swal({
                    title: "¡Bien hecho!",
                    text: "Se ha registrado la tela " +  nombre_tela + " exitosamente.",
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
            title: "Eliminar Tela ????",
            text: "¿Esta seguro que desea eliminar este tipo de tela? Si lo hace, no podrá revertir los cambios.",
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