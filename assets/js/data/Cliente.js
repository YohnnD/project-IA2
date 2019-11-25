$(document).ready(function () {
    // Registrar
    $('#cedula_cliente').blur(function () {
        var cedula_cliente = $('#cedula_cliente').val();
        $.ajax({
            method: "POST",
            dataType: "json",
            data: {
                cedula_cliente: cedula_cliente
            },

            url: "http://localhost/project-IA2/Cliente/verifyCedula",
            beforeSend: function() {
                $('#register :input').attr('disabled','disabled');
            },
            success: function(response) {
                console.log(response);
                if(response){
                    swal({
                        title: "Información",
                        text: "Esté cliente ya esta registrado en el sistema.",
                        icon: "info",
                        button: {
                            text: "Aceptar",
                            visible: true,
                            value: true,
                            className: "green",
                            closeModal: true
                        }
                    });
                    $('#cedula_cliente').val(" ");
                }
                $('#register :input').removeAttr('disabled','');
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
            url: "http://localhost/project-IA2/Cliente/register",
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
                }).then(function () {
                    window.location.href="http://localhost/project-IA2/Cliente/getAll";
                });
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
    $('#form-details-client').submit(function(e) {
        e.preventDefault();
        $('#form-details-client :input').removeAttr('disabled','');
        $('#modify').html("Guardar Cambios <i class='icon-save right'></i>");
        $('#form-details-client').attr('id','form-update');


        $('#form-update').submit(function (e) {
            e.preventDefault();
            // Getting form data
            var tipo_documento_cliente = $('#tipo_documento_cliente').val();
            var cedula_cliente = $('#documento_identidad').val();
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
                url: "http://localhost/project-IA2/Cliente/update",
                beforeSend: function() {
                    console.log("Sending data...");
                },
                success: function(data) {
                    swal({
                        title: "¡Bien hecho!",
                        text: "Se ha modicado el cliente " + nombre_cliente + " exitosamente.",
                        icon: "success",
                        button: {
                            text: "Aceptar",
                            visible: true,
                            value: true,
                            className: "green",
                            closeModal: true
                        },
                        timer: 3000
                    }).then(function () {
                        window.location.href="http://localhost/project-IA2/Cliente/details/"+cedula_cliente;
                    });
                },
                error: function(err) {
                    console.log(err.responseText);
                }
            });
        });
    });


    // Actualizar



    // Eliminar
    $('#delete').click(function () {
        swal({
            title: "Eliminar Cliente ",
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
        }).then(function (aceptar) {
            if(aceptar){
                var cedula_cliente = $('#documento_identidad').val();
                var nombre_cliente = $('#nombre_cliente').val();
                console.log(cedula_cliente);
                $.ajax({
                    method: "POST",
                    dataType: "json",
                    data: {cedula_cliente:cedula_cliente},
                    url: "http://localhost/project-IA2/Cliente/delete",
                    beforeSend: function() {
                        console.log("Sending data...");
                    },
                    success: function(data) {
                        swal({
                            title: "¡Bien hecho!",
                            text: "Se ha eliminado el cliente " + nombre_cliente + " exitosamente.",
                            icon: "success",
                            button: {
                                text: "Aceptar",
                                visible: true,
                                value: true,
                                className: "green",
                                closeModal: true
                            }
                        }).then(function () {
                            window.location.href="http://localhost/project-IA2/Cliente/getAll";
                        });
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
            }
        })
    });

    $('#clientes').DataTable({
        "pageLength": 5,
        "language": {
            "search": "Buscar:  ",
            "lengthMenu": "",
            "zeroRecords": "Upps, No Se Encontraron Datos",
            "info": "Pagina _PAGE_ de _PAGES_",
            "infoEmpty": "No Hay Registro Para Mostrar",
            "infoFiltered": "(Filtro De _MAX_ Resultado)",
            "paginate": {
                "first": "<i class='icon-first_page'></i>",
                "last": "<i class='icon-last_page'></i>",
                "next": "<i class='icon-navigate_next'></i>",
                "previous": "<i class='icon-navigate_before'></i>"
            },
        }
    });

});