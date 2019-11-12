<?php
	class ReporteController extends BaseController {
		public function __construct() {
            require_once 'vendor/autoload.php';
			parent::__construct();
		}

		public function index() {
			$this->view('Reportes/Reportes');
		}


        public function FactuIndex() {
            $factura = new Reporte(); // Instancia un objeto
            $allFactura = $factura->getFactura();
            $this->view('Reportes/Facturacion.Listado',
                ['allFactura' => $allFactura]);
            //$this->view('Reportes/Reportes');
        }



        public function getAllPedido() {
            $mpdf = new \Mpdf\Mpdf();
            ob_start();
            $pedido = new Reporte(); // Instancia un objeto
            $allPedido = $pedido->getPedidos();
            $this->view('Reportes/pedidos',['allPedido' => $allPedido]);
            $html = ob_get_clean();
            $mpdf->WriteHTML($html);
            $mpdf->Output();
            exit();
        }




        public function getAllProducto() {
            $mpdf = new \Mpdf\Mpdf();
            ob_start();
            $producto = new Reporte(); // Instancia un objeto
            $allProducto = $producto->getProductos();
            $this->view('Reportes/productos',['allProducto' => $allProducto]);
            $html = ob_get_clean();
            $mpdf->WriteHTML($html);
            $mpdf->Output();
        }



        public function facturaById() {
            if (isset($_GET["id"])) {
                $mpdf = new \Mpdf\Mpdf();
                ob_start();
                $factura = new Reporte();
                $id=$_GET["id"];

                $factura->setCodigoFactura($id);
                $factura_find = $factura->getFacturaId($id);
                $servicio_find = $factura->getFacturaServicioById($id);
                $producto_find=$factura->getFacturaProductoById($id);

                $this->view('Reportes/Invoice',
                    ['servicio' => $servicio_find,
                        'producto' => $producto_find,
                        'factura' => $factura_find
                    ]);

                $html = ob_get_clean();
                $mpdf->WriteHTML($html);
                $mpdf->Output();
            }
        }

	}
?>