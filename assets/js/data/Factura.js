$(document).ready(function () {

	var status_factura = $('#status_factura').val();

	if (status_factura==="Vigente"){

	$('#anular').on('click',function () {
        
        // Getting form data
        var codigo_factura = $('#codigo_factura').val();
        var status_factura = $('#status_factura').val();
       

        swal({
            title: "Anular Facura ????",
            text: "¿Esta seguro que desea anular esta factura? Si lo hace, no podrá revertir los cambios.",
            icon: "warning",
            buttons: {
                confirm: {
                    text: "Anular",
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
        }).then(function(terminar){
            $.ajax({
                method: "POST",
                dataType: "json",
                url:"http://localhost/project-IA2/Factura/anular",
                data: {
                    codigo_factura: codigo_factura,
                    status_factura: status_factura,
                }
            });
            console.log(terminar);
            if(terminar){
            swal({
                title: "¡Bien hecho!",
                text: "Se ha Anulado la factura " + codigo_factura + " exitosamente.",
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
                location.href = "http://localhost/project-IA2/Factura/getAll";
            });
            }
            else{
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
	}
	else{
		$('#anular').on('click',function () {
		 swal({
                title: "¡Uppps!",
                text: "No puedes Anular esta factura " + " Ya ha sido Anulada",
                icon: "warning",
                button: {
                    text: "Aceptar",
                    visible: true,
                    value: true,
                    className: "orange",
                    closeModal: true
                },
                timer: 30000
        });
		});
	}

    $('#Factura').DataTable({
        "pageLength":5,
        "language": {
            "search":"Buscar:  ",
            "lengthMenu": "",
            "zeroRecords": "Upps, No Se Encontraron Datos",
            "info": "Pagina _PAGE_ de _PAGES_",
            "infoEmpty": "No Hay Registro Para Mostrar",
            "infoFiltered": "(Filtro De _MAX_ Resultado)",
            "paginate":{
                "first":"<i class='icon-first_page'></i>",
                "last":"<i class='icon-last_page'></i>",
                "next":"<i class='icon-navigate_next'></i>",
                "previous":"<i class='icon-navigate_before'></i>"
            },
        }
    });
});