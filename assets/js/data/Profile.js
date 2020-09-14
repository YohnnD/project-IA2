
$(document).ready(function(){
    var url = "http://localhost/project-IA2/Auth/";

    // Modificar
    $('#modify').click(function(e) {
        $('#update :input').removeAttr('disabled','disabled');
        // $("#nick_usuario").removeAttr("disabled", "disabled");
        // $("#nombre_usuario").removeAttr("disabled", "disabled");
        // $("#apellido_usuario").removeAttr("disabled", "disabled");
        // $("#email_usuario").removeAttr("disabled", "disabled");
        // $("#contrasenia_usuario").removeAttr("disabled", "disabled");
        $("#id_rol").removeAttr("readonly", "false");
        $(".select-wrapper").removeClass('disabled');
        $('select').formSelect();
        $('#modify-btn').hide();
        $('#delete-btn').hide();
        $('#update-btn').show();
        // $('#passwordUsuario').removeAttr('disabled', 'disabled');

    });

    $('#update').submit(function(e) {
        e.preventDefault(); // Disable submit event
        // Getting form data

        var nick_usuario = $('#nick_usuario').val();
        var nombre_usuario = $('#nombre_usuario').val();
        var apellido_usuario = $('#apellido_usuario').val();
        var email_usuario = $('#email_usuario').val();
        var contrasenia_usuario = $('#contrasenia_usuario').val();
      //  var id_rol = $('#id_rol').val();

        $.ajax({
            method: "POST",
            dataType: "json",
            data: {
                nick_usuario: nick_usuario,
                nombre_usuario: nombre_usuario,
                apellido_usuario: apellido_usuario,
                email_usuario: email_usuario,
                contrasenia_usuario: contrasenia_usuario,
                // repeat_password_usuario: repeat_password_usuario,
                id_rol: 3
            },
            url: "http://localhost/project-IA2/Usuario/update",
            beforeSend: function() {
                console.log("Sending data...");
                $('#update :input').attr('disabled', 'disabled');
            },
            success: function(data) {
                console.log(data);
                swal({
                    title: "¡Bien hecho!",
                    text: "Se ha modificado el usuario '" + nick_usuario + "' exitosamente.",
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
                        location.reload();
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


    $('#repeat_contrasenia_usuario').blur(function () {
        var contrasenia_usuario = $('#contrasenia_usuario').val();
        var repeat_contrasenia_usuario = $('#repeat_contrasenia_usuario').val();
        if (contrasenia_usuario !== repeat_contrasenia_usuario) {
            swal({
                title: "¡Oh no!",
                text: "¡Las contraseñas no coinciden! Vuelve a intentarlo.",
                icon: "warning",
                button: {
                    text: "Vale",
                    className: "red"
                }
            });
        }
        else {


            var nick_usuario = $('#nick_usuario').val();
            var contrasenia_usuario = $('#contrasenia_usuario').val();

            $.ajax({
                method: "POST",
                dataType: "json",
                data: {
                    nick_usuario: nick_usuario,
                    contrasenia_usuario: contrasenia_usuario,
                },
                url: url + "passwordRestore",
                beforeSend: function() {
                    console.log("Sending data...");
                    $('#update :input').attr('disabled', 'disabled');
                },
                success: function(data) {
                    if(data){
                        swal({
                            title: "¡Oh no!",
                            text: "Error no puede utilizar la contraseña utilizada anteriormente.",
                            icon: "error",
                            button: {
                                text: "Aceptar",
                                visible: true,
                                value: true,
                                className: "green",
                                closeModal: true
                            }
                        });
                        $('#contrasenia_usuario').val('');
                        $('#repeat_contrasenia_usuario').val('');
                    }

                    $('#update :input').removeAttr('disabled','');

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

    });

    $('#nick_usuario').blur(function() {
        var nick_usuario = $('#nick_usuario').val();
        $.ajax({
            method: "POST",
            dataType: 'json',
            data: { nick_usuario: nick_usuario },
            url: url + "checkNickUsuario",
            beforeSend: function() {
                console.log('Send data');
                $('#register :input').attr('disabled','disabled');
            },
            success: function(resp) {
                console.log(resp);
                if(resp){
                    swal({
                        title: "Información",
                        text: "El nick '" + nick_usuario + "' ya se encuentra registrado en el sistema.",
                        icon: "info",
                        button: {
                            text: "Aceptar",
                            visible: true,
                            value: true,
                            className: "green",
                            closeModal: true
                        }
                    });
                    $('#nick_usuario').val('');
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

    $('#email_usuario').blur(function() {
        var email_usuario = $('#email_usuario').val();
        $.ajax({
            method: "POST",
            dataType: 'json',
            data: { email_usuario: email_usuario },
            url: url + "checkEmailUsuario",
            beforeSend: function() {
                console.log('Send data');
                $('#register :input').attr('disabled','disabled');
            },
            success: function(resp) {
                console.log(resp);
                if(resp){
                    swal({
                        title: "Información",
                        text: "El E-mail '" + email_usuario + "' ya se encuentra registrado en el sistema.",
                        icon: "info",
                        button: {
                            text: "Aceptar",
                            visible: true,
                            value: true,
                            className: "green",
                            closeModal: true
                        }
                    });
                    $('#email_usuario').val('');
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


});