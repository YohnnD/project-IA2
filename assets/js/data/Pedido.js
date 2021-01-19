$(document).ready(function () {
    // Registrar

    var url = localStorage.getItem('url');

    $('#add-services').click(function () {
        var texto = '';
        $.ajax({
            method: "POST",
            dataType: "json",
            url: url+"Pedido/getTelas",
            beforeSend: function () {

            },
            success: function (data) {
                console.log(data);
                $('input[type=checkbox]:checked').each(function () {
                    var name = $(this).attr('name');
                    var name_str = name.substr(0, 4);
                    var id_servicio=$(this).val();
                    var price_service=0;


                    data['services'].forEach(function (services,index) {
                        if(services['id_servicio']==id_servicio){
                            price_service=services['precio_servicio'];

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
                                       class="validate" pattern="[0-9]+" title="Solo puede usar números." value="${price_service}">
                                <label for="cantidad_prenda_${name_str}">Precio Servicio</label>
                            </div>
                             
                            
                            <div class="input-field col s12 m12">
                          
                                <select name="id_tela" id="id_tela_${name_str}" class="browser-default">
                                    ${data['telas'].map(tela => `
                                       <option value="${tela.id_tela}" >${tela.nombre_tela}</option>
                                       `)}
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
            servicios_seleted.push($(this).attr('id'));
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
                precio_servicio:document.querySelector('#precio_servicio_' + servicios_seleted[i]).value,
                id_tela: $('#id_tela_' + servicios_seleted[i]).val()
            });
        }


        var json_text = JSON.stringify(servicio);
        var json = JSON.parse(json_text);

        $.ajax({
            method: "POST",
            dataType: "json",
            data: {json: json},
            url: url+"Pedido/saveServiPedido",
            beforeSend: function () {
                console.log("Sending data...");
            },
            success: function (data) {
                swal({
                    title: "¡Bien hecho!",
                    text: "Servicios agregados al pedido  con éxito(2/4).",
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
                    $('#four-tabs').removeClass('disabled');
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
        console.log(url);
        var cedula_cliente = $('#cedula_cliente').val();
        $.ajax({
            method: "POST",
            dataType: "json",
            data: {
                cedula_cliente: cedula_cliente
            },

            url: url+"Pedido/verifyCedula",
            beforeSend: function () {
                $('#cedula_cliente').attr('disabled', 'disabled');
            },
            success: function (response) {
                if (response !== null) {
                    swal({
                        title: "¡Bien hecho!",
                        text: "Cliente encontrado con éxito.",
                        icon: "success",
                        timer: 3000
                    });

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
                            location.href = url+"Cliente/create";
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







    $('#porcentaje').blur(function () {
        var porcentaje=0;
        var total=0;
        var porcen=0;
        porcentaje=$(this).val();
        total=$('#total_pagar').val();

        porcen=total*porcentaje/100;

        total=porcen+ parseInt(total);
        $('#total_pagar').val(total);


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
            url: url+"Pedido/register",
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
                    $('#two-tabs').removeClass('disabled');
                    $('#three-tabs').removeClass('disabled');
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
        var total_producto=0;



        $('#services').find('input').each(function () {
            temp=temp*$(this).val();
            cont++;

            if(cont===3){
                total_service+=temp;
                cont=0;
                temp=1;
            }
        });


        $('#register-product').find('input.calc').each(function () {
            temp=temp*$(this).val();
            cont++;

            if(cont===2){
                total_producto+=temp;
                cont=0;
                temp=1;
            }

        });



        $('#total_servicios').val(total_service);
        $('#total_producto').val(total_producto);
        $('#total_pagar').val(total_producto+total_service);


        M.updateTextFields();
    });


    $('#search').keydown(function () {
        var search = $(this).val();

        console.log(search);

        if(search!==" "){


        $.ajax({
            method: "GET",
            dataType: "json",
            url: url+"Pedido/productosFind/"+search,
            beforeSend: function () {

            },
            success: function (response) {

                var product = response;
                var product_array = {};


                if(response!==null) {


                    for (var i = 0; i < response.length; i++) {
                        //console.log(countryArray[i].name);
                        product_array[product[i].codigo_producto+'|'+product[i].nombre_producto+'|'+product[i].nombre_talla]= null;
                    }


                    console.log(product_array);

                    $('input.autocomplete').autocomplete({
                        data: product_array,
                        onAutocomplete: function (val) {

                            var codigo_producto=val.substr(0,1);
                            addProducto(response,codigo_producto);
                            $('#search').val('');
                        }

                    });
                    $('input.autocomplete').click();
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


    $('#register-factura').submit(function (e) {
       e.preventDefault();
       var codigo_pedido=$('#codigo_pedido').val();
       var forma_pago=$('#forma_pago').val();
       var porcentaje=$('#porcentaje').val();


        $.ajax({
            method: "POST",
            dataType: "json",
            data: {
                codigo_pedido: codigo_pedido,
                modo_pago_factura: forma_pago,
                porcentaje_pago_factura:porcentaje,
            },
            url: url+"Pedido/registerFactura",
            beforeSend: function () {

                console.log("Sending data...");
            },
            success: function (data) {
                $('#codigo_pedido').val(data);
                swal({
                    title: "¡Bien hecho!",
                    text: "Pedido facturado y registrado con éxito.",
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
                    window.location.href=url+"Pedido/getAll";
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


    $('#register-product').submit(function (e) {
        e.preventDefault();

        var codigo_productos=[];
        var cant_pro_pedida=[];
        var id_tallas=[];
        var precio=[];


        $('.codigo_producto').each(function () {
            codigo_productos.push($(this).val());
        });

        $('.cant_producto_pedido').each(function () {
            cant_pro_pedida.push($(this).val());
        });

        $('.id_talla').each(function () {
            id_tallas.push($(this).val());
        });

        $('.precio').each(function () {
            precio.push($(this).val());
        });


           var codigo_pedido = document.querySelector('#codigo_pedido').value


        $.ajax({
            method: "POST",
            dataType: "json",
            data: { codigo_producto:codigo_productos, cant_pro_pedida:cant_pro_pedida,
                codigo_pedido:codigo_pedido,
                id_talla:id_tallas,
                precio:precio,
            },
            url: url+"Pedido/registerProducto",
            beforeSend: function () {
                console.log("Sending data...");
            },
            success: function (data) {
                console.log(data);
                if(data.status==='error'){

                    console.log(data);
                    swal({
                        title: "¡Oh no!",
                        text: "El producto " + data.producto.nombre_producto + " no cuenta con el stock suficiente. stock disponible:" + data.producto.stock_producto +".",
                        icon: "error",
                        button: {
                            text: "Aceptar",
                            visible: true,
                            value: true,
                            className: "green",
                            closeModal: true
                        }
                    });


                }else{
                    swal({
                        title: "¡Bien hecho!",
                        text: "Producto ingresado con éxito 3/4.",
                        icon: "success",
                        button: {
                            text: "Aceptar",
                            visible: true,
                            value: true,
                            className: "green",
                            closeModal: true
                        },
                    }).then(function () {
                        $('#register-product :input').attr('disabled', 'disabled');
                        $('#four-tabs').removeClass('disabled');
                        $('ul.tabs').tabs();
                        $('ul.tabs').tabs("select", "four");
                    });
                }


            },

            error: function (err) {
                console.log(err.responseText);
            }
        });



    });

    // Actualizar
    $('#update').submit(function (e) {
        e.preventDefault();
    });


    // Eliminar
    $('#delete').click(function () {
        swal({
            title: "Eliminar Pedido",
            text: "¿Esta seguro que desea eliminar este Pedido? Si lo hace, no podrá revertir los cambios.",
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
                var codigo_pedido = $('#codigo_pedido').val();
                $.ajax({
                    method: "GET",
                    dataType: "json",
                    url: url+"Pedido/delete/"+codigo_pedido,
                    beforeSend: function() {
                        console.log("Sending data...");
                    },
                    success: function() {
                        swal({
                            title: "¡Bien hecho!",
                            text: "Se ha eliminado el pedido exitosamente.",
                            icon: "success",
                            button: {
                                text: "Aceptar",
                                visible: true,
                                value: true,
                                className: "green",
                                closeModal: true
                            }
                        }).then(function () {
                            window.location.href=url+"Pedido/getAll";
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


    function addProducto(producto,codigo_producto) {

        for (var i = 0; i < producto.length; i++) {
            if(producto[i].codigo_producto==codigo_producto){
                var  texto = `
                                   <tr>
                                       <th><input type="number" name="codigo_prodcuto"  readonly class="col s4 m4 center codigo_producto" value="${producto[i].codigo_producto}" readonly></th>
                                       <th>${producto[i].nombre_producto}</th>
                                       <th>${producto[i].nombre_talla}</th>
                                       <th><input type="number" name="cant_producto_pedido[]" class="col s4 m4 center cant_producto_pedido calc" value=""></th>
                                       <th><input type="number" name="precio[]" class="col s4 m4 center precio calc" value="${producto[i].precio_producto}"></th>
                                       <th><button type="button" class="delete-product btn red "><i class="icon-delete"></button></th>
                                       <input type="hidden"  name="id_talla[]" class="id_talla" value="${producto[i].id_talla}">
                                   </tr>
                                   
         
                     
            `;
                $('#product-list').append(texto);
                $('.delete-product').click(function () {
                    $(this).parent().parent().text("");
                });
            }
        }
    }

    $('#form-pedido-details').submit(function (e) {
        e.preventDefault();
        swal({
            title: "Actualizar Pedido",
            text: "¿Esta seguro que desea actualizar este Pedido? Si lo hace, no podrá revertir los cambios.",
            icon: "warning",
            buttons: {
                confirm: {
                    text: "Actualizar",
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
            if (aceptar) {
                $('#form-pedido-details')[0].submit();
            }


        })
    });



    if($('#pedidos').val()!==undefined){
        $('#pedidos').DataTable({
            "responsive": true,
            "scrollX": true,
            "pageLength": 10,
            "language": {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "No hay pedidos registrados",
                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "<i class='icon-navigate_next'></i>",
                    "sPrevious": "<i class='icon-navigate_before'></i>"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                },
                "buttons": {
                    "copy": "Copiar",
                    "colvis": "Visibilidad"
                }
            }
        });
    }

    $('#facturaPedidos').DataTable({
        "responsive": true,
        "scrollX": true,
        "pageLength": 10,
        "language": {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "No hay pedidos registrados",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "<i class='icon-navigate_next'></i>",
                "sPrevious": "<i class='icon-navigate_before'></i>"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            },
            "buttons": {
                "copy": "Copiar",
                "colvis": "Visibilidad"
            }
        }
    });


});
