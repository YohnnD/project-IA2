$(document).ready(function(){
	$('.dropdown-trigger').dropdown({
        coverTrigger: false,
        constrainWidth: false,
        alignment: 'right'
    });
    $('.sidenav').sidenav();
    $(".collapsible").collapsible();

    $('.fixed-action-btn').floatingActionButton();
    $('.tooltipped').tooltip({
        outDuration: 150
    });
    M.textareaAutoResize($('#descripcion_producto, #descripcion_pedido, #descripcion_cliente, #direccion_cliente , #descripcion_servicio, #descripcion_tela'));

    $('select').formSelect();
    $('.tabs').tabs();
    $('.datepicker').datepicker(
        {'format':'yyyy-mm-dd'}
    );
});