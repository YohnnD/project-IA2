$(document).ready(function () {
    // Registrar

    $('#add-services').click(function () {
        var texto = '';
        $.ajax({
            method: "POST",
            dataType: "json",
            url: "http://localhost/project-IA2/Pedido/getTelas",
            beforeSend: function () {

            },
            success: function (data) {
                console.log(data);
                $('input[type=checkbox]:checked').each(function () {
                    var name = $(this).attr('name');
                    var name_str = name.substr(0, 4);
                    var id_servicio=$(this).val();
                    var price_service=0;
                    console.log(id_servicio);

                    data['services'].forEach(function (services,index) {
                        if(services['id_servicio']==id_servicio){
                            price_service=services['precio_servicio'];
                            console.log(price_service);
                        }

                    });


                    texto += `<div>
                     <div class="col s12">
                                <h4 class="center-align d-inline-block title-service">${name}</h4> <i
                                        class="icon-close right close-service" id="${name}"></i>
                            </div>
                            <div class="input-field col s12 m4">
                                <i class="icon-plus_one prefix"></i>
                                <input type="number" name="cantidad_prenda_${name_str}" id="cantidad_prenda_${name_str}"
                                       class="validate" pattern="[0-9]+" title="Solo puede usar números." value="1">
                                <label for="cantidad_prenda_${name_str}">Cantidad de Prendas</label>
                            </div>
                            
                            <div class="input-field col s12 m4">
                                <i class="icon-star_border prefix"></i>
                                <input type="number" name="cantidad_medida_${name_str}" id="cantidad_medida_${name_str}"
                                       class="validate" pattern="[0-9]+" title="Solo puede usar números." value="1">
                                <label for="cantidad_prenda_${name_str}">Cantidad de Medida</label>
                            </div>
                            
                            <div class="input-field col s12 m4">
                                <i class="icon-star_border prefix"></i>
                                <input type="number" name="precio_servicio_${name_str}" id="precio_servicio_${name_str}"
                                       class="validate" pattern="[0-9]+" title="Solo puede usar números." value="${price_service}" disabled>
                                <label for="cantidad_prenda_${name_str}">Precio Servicio</label>
                            </div>
                             
                            
                            <div class="input-field col s12 m12">
                          
                                <select name="id_tela" multiple id="id_tela_${name_str}" class="browser-default">
                                    ${data['telas'].map(tela => `
                                       <option value="${tela.id_tela}" >${tela.nombre_tela}</option>
                                       `)}; 
                                </select>
                                
                            </div>
                    </div>`;});
                $('#services').html(texto);
                M.updateTextFields();


                $('.close-service').click(function () {
                    var service=$(this).attr('id');
                    $('input[type=checkbox]:checked').each(function () {
                        if($(this).attr('name')===service){
                            $(this).prop("checked",false);
                        }
                    });
                    $(this).parent().parent().html("");
                });


            },
            error: function (err) {
                console.log(err.responseText);
            }
        });

    });




    $('#register-service').submit(function (e) {
        e.preventDefault();
        var servicios_seleted = [];
        var id_servicios = [];
        $('input[type=checkbox]:checked').each(function () {
            servicios_seleted.push($(this).attr('id').toLowerCase());
            id_servicios.push($(this).val());
        });

        console.log(servicios_seleted);
        var servicio = [];
        for (var i = 0; i < servicios_seleted.length; i++) {

            servicio.push({
                id: id_servicios[i], servicio: servicios_seleted[i],
                codigo_pedido: document.querySelector('#codigo_pedido').value,
                cant_prenda: document.querySelector('#cantidad_prenda_' + servicios_seleted[i]).value,
                cant_medida: document.querySelector('#cantidad_medida_' + servicios_seleted[i]).value,
                id_tela: $('#id_tela_' + servicios_seleted[i]).val()
            });
        }


        var json_text = JSON.stringify(servicio);
        var json = JSON.parse(json_text);

        $.ajax({
            method: "POST",
            dataType: "json",
            data: {json: json},
            url: "http://localhost/project-IA2/Pedido/saveServiPedido",
            beforeSend: function () {
                console.log("Sending data...");
            },
            success: function (data) {
                swal({
                    title: "¡Bien hecho!",
                    text: "Servicios agregados al pedido  con éxito, añade los materiales que utilizaras para este pedido (2/4).",
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
                    $('#register-service :input').attr('disabled', 'disabled');
                    $('ul.tabs').tabs();
                    $('ul.tabs').tabs("select", "three");
                });
            },
            error: function (err) {
                console.log(err.responseText);
            }
        });


    });


    $('#cedula_cliente').blur(function () {
        var cedula_cliente = $('#cedula_cliente').val();
        $.ajax({
            method: "POST",
            dataType: "json",
            data: {
                cedula_cliente: cedula_cliente
            },

            url: "http://localhost/project-IA2/Pedido/verifyCedula",
            beforeSend: function () {
                $('#cedula_cliente').attr('disabled', 'disabled');
            },
            success: function (response) {
                if (response !== null) {
                    $('#cedula_cliente').val(response.cedula_cliente);
                    $('#nombre_cliente').val(response.nombre_cliente);
                    $('#representante_cliente').val(response.representante_cliente);

                    $('#cedula_cliente').removeAttr('disabled', '');
                    M.updateTextFields();
                } else {
                    swal({
                        title: "¡Oh no!",
                        text: "Cliente no encontrado,registadolo para comenzar hacer pedidos.",
                        icon: "error",
                        buttons: {
                            confirm: {
                                text: "Registrarlo",
                                value: true,
                                visible: true,
                                className: "red"

                            },
                            cancel: {
                                text: "Mejor no",
                                value: false,
                                visible: true,
                                className: "grey lighten-2"
                            }
                        }

                    }).then(function (registrar) {
                        if (registrar) {
                            location.href = "http://localhost/project-IA2/Cliente/create";
                        }
                        $('#cedula_cliente').removeAttr('disabled', '');
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
                $('#cedula_cliente').removeAttr('disabled', '');
            }

        });
    });


    $('.material-button').children(':input').click(function () {

        //colocar color
        CheckIcons(this);
        $(this).blur(function () {
            if (this.value === "") {
                CheckIcons(this);
            }
        });


    });


    $('#register-material').submit(function (e) {
        e.preventDefault();
        var data=[];
        $('#three a.btn-app > :input.cant_material').each(function () {
            if($(this).val()!==""){
                data.push({id_material:$(this).siblings(':input.id_material').val(),
                    cant_material:$(this).val()});
            }
        });

        var json_text = JSON.stringify(data);
        var json = JSON.parse(json_text);

        console.log(json);

        $.ajax({
            method: "POST",
            dataType: "json",
            data: {json:json},
            url: "http://localhost/project-IA2/Pedido/registerMateriales",
            beforeSend: function () {

            },
            success: function (response) {
                swal({
                    title: "¡Bien hecho,Ya casi terminamos!",
                    text: "Materiales agregados al pedido  con éxito. incluye la forma de pago.(3/4).",
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
                    $('#register-material :input').attr('disabled', 'disabled');
                    $('ul.tabs').tabs();
                    $('ul.tabs').tabs("select", "four");
                });
            },
            error: function (err) {
                console.log(err.responseText);
            }
        });
    });





    $('#form-pedido').submit(function (e) {
        e.preventDefault();


        // Getting form data

        var cedula_cliente = $('#cedula_cliente').val();
        var status_pedido = 'En proceso';
        var fecha_pedido = $('#fecha_pedido').val();
        var fecha_entrega_pedido = $('#fecha_entrega_pedido').val();
        var descripcion_pedido = $('#descripcion_pedido').val();


        /* var id_servicio = $('#id_servicio').val();
         var cantidad_prenda = $('#cantidad_prenda').val();
         var cantidad_medida = $('#cantidad_medida').val();
         var precio_servi_pedido = $('#precio_servi_pedido').val();

          id_servicio: id_servicio,
                     cantidad_prenda: cantidad_prenda,
                     cantidad_medida: cantidad_medida,
                     precio_servi_pedido: precio_servi_pedido
 */

        // Sending data by AJAX
        $.ajax({
            method: "POST",
            dataType: "json",
            data: {
                cedula_cliente: cedula_cliente,
                status_pedido: status_pedido,
                fecha_pedido: fecha_pedido,
                descripcion_pedido: descripcion_pedido,
                fecha_entrega_pedido: fecha_entrega_pedido
            },
            url: "http://localhost/project-IA2/Pedido/register",
            beforeSend: function () {

                console.log("Sending data...");
            },
            success: function (data) {
                $('#codigo_pedido').val(data);
                swal({
                    title: "¡Bien hecho!",
                    text: "Datos generales del pedidos se han registrado con el codigo" + data + " exitosamente.(1/4)",
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
                    $('#form-consul-client :input').attr('disabled', 'disabled');
                    $('#form-pedido :input').attr('disabled', 'disabled');

                    $('ul.tabs').tabs();
                    $('ul.tabs').tabs("select", "two");
                });
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



    $('.four').click(function () {
        //servicio
        var total_service=0;
        var cont=0;
        var temp=1;
        //material

        var total_material=0;



        $('#services').find('input').each(function () {
            temp=temp*$(this).val();
            cont++;

            if(cont===3){
                total_service+=temp;
                cont=0;
                temp=1;
            }


        });



        $('#register-material a.select').find('input:visible').each(function () {
            temp=temp*$(this).val();
            cont++;

            if(cont===2){
                console.log(temp);
                total_material+=temp;
                cont=0;
                temp=1;
            }
        });


        $('#total_servicios').val(total_service);
        $('#total_materiales').val(total_material);

        M.updateTextFields();
    });


    $('#search').keydown(function () {
        var search = $(this).val();

        console.log(search);

        if(search!==" "){


        $.ajax({
            method: "GET",
            dataType: "json",
            url: "http://localhost/project-IA2/Pedido/productosFind/"+search,
            beforeSend: function () {

            },
            success: function (response) {

                var product = response;
                var product_array = [];


                if(response!==null) {


                    for (var i = 0; i < response.length; i++) {
                        //console.log(countryArray[i].name);
                        product_array.push({
                            text:  product[i].nombre_producto,
                            id: product[i].codigo_producto,
                        });
                    }








                    console.log(product_json);
                    $('input.autocomplete').autocomplete({
                        data: product_json,
                        onAutocomplete: function (val) {
                            console.log(val);
                        }

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
        }
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