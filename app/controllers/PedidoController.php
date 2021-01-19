<?php

class PedidoController extends BaseController
{

    public function __construct(){
        parent::__construct();
    }

    public function index(){
        $this->view('Pedidos/Pedidos');
    }

    public function create()
    {
        Helpers::hasPermissions('3','1',true,'Pedido');
        $pedido = new Pedido();
        $services = $pedido->getServices();
        $this->view('Pedidos/Pedidos.Registrar', ['services' => $services]);
    }

    public function getAll()
    {
        Helpers::hasPermissions('3','2',true,'Pedido');
        $pedido = new Pedido();
        $pedidos = $pedido->getAll();
        $this->view('Pedidos/Pedidos.Consultar', ['pedidos' => $pedidos]);
    }

    public function register()
    {
        $pedido = new Pedido();
        $cedulaCliente = $this->input('cedula_cliente');
        $codigoPedido = $pedido->generatedNumberPedido();
        $fechaPedido = $this->input('fecha_pedido');
        $fechaEntregaPedido = $this->input('fecha_entrega_pedido');
        $statusPedido = $this->input('status_pedido');
        $descripcionPedido = $this->input('descripcion_pedido');

        $pedido->setCedulaCliente($cedulaCliente);
        $pedido->setFechaEntregaPedido($fechaEntregaPedido);
        $pedido->setFechaPedido($fechaPedido);
        $pedido->setCodigoPedido($codigoPedido);
        $pedido->setStatusPedido("En Proceso");
        $pedido->setDescripcionPedido($descripcionPedido);
        $pedido->save();

        $response = $codigoPedido;
        $this->sendAjax($response);
    }

    public function details()
    {

        Helpers::hasPermissions('3','5',true,'Pedido');
        $codigoPedido = $_GET['id'];
        $pedido = new Pedido();
        $pedido->setCodigoPedido($codigoPedido);
        $pedido_find = $pedido->getBy();
        $telas = $pedido->getTelas();
        $servicios_find = $pedido->getServicicio();
        $productos_find = $pedido->getProductos();

        $this->view('Pedidos/Pedidos.Detalles',
            ['pedido' => $pedido_find,
                'servicios' => $servicios_find,
                'telas' => $telas,
                'productos' => $productos_find
            ]);

    }

    public function delete()
    {
        $pedido = new Pedido();
        $codigoPedido = $_GET['id'];
        $pedido->setCodigoPedido($codigoPedido);
        $deletePedido = $pedido->delete();
        $this->sendAjax($deletePedido);
    }


    public function saveServiPedido()
    {
        $data = $this->input('json');
        $pedido = new Pedido();
        foreach ($data as $serviPedido) {
            $pedido->setIdServicio($serviPedido['id']);
            $pedido->setCodigoPedido($serviPedido['codigo_pedido']);
            $pedido->setCantidadPrenda($serviPedido['cant_prenda']);
            $pedido->setCantidadMedida($serviPedido['cant_medida']);
            $pedido->setPrecioServiPedido($serviPedido['precio_servicio']);
            $pedido->setIdTela($serviPedido['id_tela']);
            $save = $pedido->saveServiPedido();
        }

        $this->sendAjax($save);
    }


    public function verifyCedula()
    {
        $cedulaCliente = $this->input('cedula_cliente');
        $pedido = new Pedido();
        $pedido->setCedulaCliente($cedulaCliente);
        $cliente = $pedido->checkCedula();
        isset($cliente->nombre_cliente)?$cliente->nombre_cliente=Helpers::aesDecrypt($cliente->nombre_cliente):null;
        $this->sendAjax($cliente);
    }


    public function getTelas()
    {
        $pedido = new Pedido();
        $telas = $pedido->getTelas();
        $services = $pedido->getServices();
        $this->sendAjax(["telas" => $telas, "services" => $services]);
    }


    public function registerFactura()
    {
        $pedido = new Pedido();
        $codigoFactura = $pedido->generateNumberFactura();

        $codigoPedido = $this->input('codigo_pedido');
        $modoPagoFactura = $this->input('modo_pago_factura');
        $porcentajeVentas = $this->input('porcentaje_pago_factura');
        $pedido->setCodigoPedido($codigoPedido);
        $pedido->setCodigoFactura($codigoFactura);
        $pedido->setModoPagoFactura($modoPagoFactura);
        $pedido->setPorcentajeVentaFactura($porcentajeVentas);
        $save = $pedido->saveFactura();
        $this->sendAjax($save);
    }


    public function productosFind()
    {
        $pedido = new Pedido();
        $find = $_GET['id'];
        $pedido->setCodigoProducto($find);
        $productos = $pedido->findProductos();




        $this->sendAjax($productos);
    }

    public function registerProducto()
    {
        $codigo_producto = $this->input('codigo_producto');
        $cant_pro_pedida = $this->input('cant_pro_pedida');
        $precio_pro=$this->input('precio');
        $codigo_pedido = $this->input('codigo_pedido');
        $id_talla = $this->input('id_talla');

        $pedido = new Pedido();
        for ($i = 0; $i < count($codigo_producto);$i++){
            $pedido->setCodigoProducto($codigo_producto[$i]);
            $pedido->setCantidadPrenda($cant_pro_pedida[$i]);
            $pedido->setIdTallas($id_talla[$i]);
            $save = $pedido->verifyProduct();

            if(is_object($save)){
                break;
            }
        }


        if(!is_object($save)){
            for ($i = 0; $i < count($codigo_producto);$i++){
                $pedido->setCodigoProducto($codigo_producto[$i]);
                $pedido->setCodigoPedido($codigo_pedido);
                $pedido->setCantidadPrenda($cant_pro_pedida[$i]);
                $pedido->setPrecioServiPedido($precio_pro[$i]);
                $pedido->setIdTallas($id_talla[$i]);
                $save = $pedido->saveProPredido();
            }

            $save=['status'=>'success'];
        }else{
            $save=['status'=>'error','producto'=>$save];
        }

        $this->sendAjax($save);
    }


    public function update()
    {
        $codigoPedido = $this->input('codigo_pedido');
        $cedulaCliente = $this->input('cedula_cliente');
        $fechaPedido = $this->input('fecha_pedido');
        $fechaEntregaPedido = $this->input('fecha_entrega_pedido');
        $statusPedido = $this->input('status_pedido');
        $descripcionPedido = $this->input('descripcion_pedido');

        $codigoProducto = $this->input('codigo_producto');
        $cant_producto_pedido = $this->input('cant_producto_pedido');


        $pedido = new Pedido();
        $pedido->setCedulaCliente($cedulaCliente);
        $pedido->setFechaEntregaPedido($fechaEntregaPedido);
        $pedido->setFechaPedido($fechaPedido);
        $pedido->setCodigoPedido($codigoPedido);
        $pedido->setStatusPedido($statusPedido);
        $pedido->setDescripcionPedido($descripcionPedido);

        $pedido->update();


        $id_servicio = $this->input('id_servicio');
        $cantidadPrenda = $this->input('cantidad_prenda');
        $cantidadMedida = $this->input('cantidad_medida');
        $idTela = $this->input('id_tela');


        for ($i = 0; $i < count($id_servicio); $i++) {
            $pedido->setIdServicio($id_servicio[$i]);
            $pedido->setCantidadPrenda($cantidadPrenda[$i]);
            $pedido->setCantidadMedida($cantidadMedida[$i]);
            $pedido->setIdTela($idTela[$i]);
            $pedido->updateServiPedido();
        }


        for ($i = 0; $i < count($cant_producto_pedido); $i++) {
            $pedido->setCantidadPrenda($cant_producto_pedido[$i]);
            $pedido->setCodigoProducto($codigoProducto[$i]);
            $pedido->updateProducto();
        }

        $_SESSION['message']=true;
        header('Location:http://localhost/project-IA2/Pedido/details/' . $codigoPedido);
    }



}

?>
