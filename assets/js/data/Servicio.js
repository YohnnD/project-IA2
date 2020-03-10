var deleteMaterial=false;
$(document).ready(function () {

    $('#unidad_medida').attr('disabled', 'disabled');
    $('#costo_servicio').attr('disabled', 'disabled');
    $('#precio_servicio').attr('disabled', 'disabled');
    $('#descripcion_servicio').attr('disabled', 'disabled');

    $('#nombre_servicio').blur(function () {
        var nombre_servicio = $('#nombre_servicio').val();
        $.ajax({
            method: "post",
            dataType: "json",
            url: "http://localhost/project-IA2/Servicio/verificarServicio",
            data: {
                nombre_servicio: nombre_servicio
            },
            beforeSend: function () {
                console.log('estoy en el beforeSend');
            },
            success: function (data) {
                console.log('estoy en el success');
                console.log(data);
                if (data == true) {
                    swal({
                        title: "¡Upps!",
                        text: "Ya se encuentra un Servicio registrado con este nombre" + nombre_servicio,
                        icon: "warning",
                        button: {
                            text: "Aceptar",
                            visible: true,
                            value: true,
                            className: "red",
                            closeModal: true
                        },
                        timer: 3000
                    });

                    $('#unidad_medida').attr('disabled', 'disabled');
                    $('#costo_servicio').attr('disabled', 'disabled');
                    $('#precio_servicio').attr('disabled', 'disabled');
                    $('#descripcion_servicio').attr('disabled', 'disabled');
                } else {

                    swal({
                        title: "Servicio No Registrado",
                        text: "Puedes continuar con el registro del servicio",
                        icon: "success",
                        button: {
                            text: "Aceptar",
                            visible: true,
                            value: true,
                            className: "green",
                            closeModal: true
                        },
                        timer: 8000
                    });

                    $('#unidad_medida').removeAttr('disabled', 'disabled');
                    $('#costo_servicio').removeAttr('disabled', 'disabled');
                    $('#precio_servicio').removeAttr('disabled', 'disabled');
                    $('#descripcion_servicio').removeAttr('disabled', 'disabled');
                }
            },
            error: function (err) {
                console.log(err);
            }
        });
    });


    // Registrar
    $('#register').on('submit', function (e) {
        e.preventDefault();
        var nombre_servicio=$('#nombre_servicio').val()

        $.ajax({
            method: "POST",
            dataType: "json",
            cache: false,
            contentType: false,
            processData: false,
            url: "http://localhost/project-IA2/Servicio/save",
            data: new FormData(this),
            // url: "",
            beforeSend: function () {
                console.log("Sending data...");
            },
            success: function (data) {
                console.log(data);
                if (data == true) {
                    swal({
                        title: "¡Bien hecho!",
                        text: "Se ha registrado el servicio exitosamente.",
                        icon: "success",
                        button: {
                            text: "Aceptar",
                            visible: true,
                            value: true,
                            className: "green",
                            closeModal: true
                        },
                        timer: 3000
                    }).then(redirect => {
                        location.href = "http://localhost/project-IA2/Servicio/getMateriales";
                    });
                }
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

    if (deleteMaterial==false) {
        $('#deleteMaterial').on('click',function(event) {

            $('.materiales').removeAttr('disabled','');
           // $(this).addAttr('disabled','disabled');
            deleteMaterial=true;


        });
    }

    //if (deleteMaterial==true){
      //  $('#deleteMaterial').on('click',function(event) {
        //    console.log('hola');
          //      console.log(deleteMaterial);

      //      $('.materiales').addAttr('disabled','disabled');
        //    $(this).text('Eliminar Materiales');
          //  deleteMaterial=false;

        //});
    //}




    // Registrar material
    $('#MaterialServi').on('submit', function (e) {
        e.preventDefault();
        console.log('holaa');
        var cantidad = $('#cantidad').val();
        var id = $('#id_material').val();


        $.ajax({
            method: "POST",
            dataType: "json",

            url: "http://localhost/project-IA2/Servicio/saveMaterial",
            data: {
                cantidad: cantidad,
                id: id
            },
            // url: "",
            beforeSend: function () {
                console.log("Sending data...");
            },
            success: function (data) {
                console.log(data);
                if (data == true) {
                    swal({
                        title: "¡Bien hecho!",
                        text: "Se ha registrado el material al servicio exitosamente./n+" +
                                "¿Deseas Añadir otro material?",
                        icon: "success",
                        button: {
                            text: "Aceptar",
                            visible: true,
                            value: true,
                            className: "green",
                            closeModal: true
                        },
                        timer: 7000
                    }).then(redirect => {
                        location.href = "http://localhost/project-IA2/Servicio/getMateriales";
                    });
                }
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
    var click = false;
    $('#modify').on('click', function (e) {
        e.preventDefault();

        if (click == true) {

            // Getting form data
            var id_servicio = $('#id_servicio').val();
            var nombre_servicio = $('#nombre_servicio').val();
            var unidad_medida = $('#unidad_medida').val();
            var precio_servicio = $('#precio_servicio').val();
            var costo_servicio = $('#costo_servicio').val();
            var descripcion_servicio = $('#descripcion_servicio').val();

            swal({
                title: "Actualizar Servicio",
                text: "¿Está seguro que desea actualizar el Servicio? Una vez Actualizado, no podra revertir los cambios.",
                icon: "warning",
                buttons: {
                    confirm: {
                        text: "Actualizar",
                        value: true,
                        visible: true,
                        className: "red-45"

                    },
                    cancel: {
                        text: "Cancelar",
                        value: false,
                        visible: true,
                        className: "grey lighten-2"
                    }
                }
            }).then(function (d) {
                $.ajax({
                    method: "POST",
                    dataType: "json",
                    url: "http://localhost/project-IA2/Servicio/update",
                    data: {
                        id_servicio: id_servicio,
                        nombre_servicio: nombre_servicio,
                        unidad_medida: unidad_medida,
                        precio_servicio: precio_servicio,
                        costo_servicio: costo_servicio,
                        descripcion_servicio: descripcion_servicio,
                    },
                    beforeSend: function () {
                        console.log("Sending data...");
                    },
                    success: function (data) {
                        console.log(data);
                        if (data == true) {
                            swal({
                                title: "¡Bien hecho!",
                                text: "Se ha Actualizado el servicio " + nombre_servicio + " exitosamente.",
                                icon: "success",
                                button: {
                                    text: "Aceptar",
                                    visible: true,
                                    value: true,
                                    className: "green",
                                    closeModal: true
                                },
                                timer: 3000
                            }).then(redirect => {
                                        location.reload();
                                    });

                        }
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
        }
        if (click == false) {
            $('#nombre_servicio').removeAttr('disabled', 'disabled');
            $('#unidad_medida').removeAttr('disabled');
            $('#precio_servicio').removeAttr('disabled');
            $('#costo_servicio').removeAttr('disabled');
            $('#descripcion_servicio').removeAttr('disabled');

            click = true;
        }
    });


    // Eliminar

    $('#delete').on('click', function () {

        // Getting form data
        var id_servicio = $('#id_servicio').val();
        var nombre_servicio = $('#nombre_servicio').val();

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
        }).then(function (terminar) {
            $.ajax({
                method: "POST",
                dataType: "json",
                url: "http://localhost/project-IA2/Servicio/delete",
                data: {
                    id_servicio: id_servicio,
                }
            });
            console.log(terminar);
            if (terminar) {
                swal({
                    title: "¡Bien hecho!",
                    text: "Se ha Actualizado el servicio " + nombre_servicio + " exitosamente.",
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
                            location.href = "http://localhost/project-IA2/Servicio/getAll";
                        });
            } else {
                swal({
                    text: "Acción cancelada.",
                    icon: "info",
                    button: {
                        text: "Aceptar",
                        className: "blue-45deg-gradient-1"
                    }
                });
            }
        });
    });

    //Consultar servicios DataTables
    $('#Servicio').DataTable({
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


    $('#Materiales').DataTable({
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