$(document).ready(function(){
    // Registrar
    $('#register').submit(function(e) {
        e.preventDefault(); // Disable submit event
        // Getting form data
        var nombre_usuario = $('#nombre_usuario').val();
        var apellido_usuario = $('#apellido_usuario').val();
        var email_usuario = $('#email_usuario').val();
        var nick_usuario = $('#nick_usuario').val();
        var password_usuario = $('#password_usuario').val();
        var repeat_password_usuario = $('#repeat_password_usuario').val();
        // var url_imagen = $('#url_imagen').val();
        var id_rol = $('#id_rol').val();
        // Sending data by AJAX
        $.ajax({
            method: "POST",
            dataType: "json",
            data: {
                    nombre_usuario: nombre_usuario,
                    apellido_usuario: apellido_usuario,
                    email_usuario: email_usuario,
                    nick_usuario: nick_usuario,
                    password_usuario: password_usuario,
                    repeat_password_usuario: repeat_password_usuario,
                    id_rol: id_rol
                    },
            // url: "",
            beforeSend: function() {
                console.log("Sending data...");
            },
            success: function(data) {
                console.log(data);
                swal({
                    title: "¡Bien hecho!",
                    text: "Se ha registrado el usuario " + nick_usuario + " exitosamente.",
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
                    location.href = "Usuarios.php";
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
    $('#modify').click(function(e) {
        $("#nombre_usuario").removeAttr("disabled", "disabled");
        $("#apellido_usuario").removeAttr("disabled", "disabled");
        $("#email_usuario").removeAttr("disabled", "disabled");
        $("#nick_usuario").removeAttr("disabled", "disabled");
        $("#password_usuario").removeAttr("disabled", "disabled");
        $("#id_rol").removeAttr("disabled", "disabled");
        // $('#passwordUsuario').removeAttr('disabled', 'disabled');

    });

    $('#update').submit(function(e) {
        e.preventDefault();
    });

    // Eliminar
    $('#delete').click(function() {
        swal({
            title: "Eliminar Usuario codeslator",
            text: "¿Esta seguro que desea eliminar este usuario? Si lo hace, no podrá revertir los cambios.",
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

    $('#repeat_password_usuario').blur(function () {
        var password_usuario = $('#password_usuario').val();
        var repeat_password_usuario = $('#repeat_password_usuario').val();
        if (password_usuario !== repeat_password_usuario) {
            swal({
                title: "¡Oh no!",
                text: "¡Las contraseñas no coinciden! Vuelve a intentarlo.",
                icon: "warning"
            });
        }
        else {
            swal({
                title: "¡Genial!",
                text: "¡Las contraseñas coinciden!",
                icon: "success"
            });
        }
    });
});