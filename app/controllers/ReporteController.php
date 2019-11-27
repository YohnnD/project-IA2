<?php
	class ReporteController extends BaseController {
		
		public function __construct() {
			
			parent::__construct();
		}

		public function orders() {
            $mpdf = new \Mpdf\Mpdf();

            $mpdf->WriteHTML('Hello World');

            $mpdf->Output();}


            public function reporteIndex() {
			
			$this->view('Reportes/Reportes');
		}

		public function index() {
			$factura = new Reporte(); // Instancia un objeto
            $allFactura = $factura->getFactura();
             
			$this->view('Reportes/Facturacion.Listado',
				['allFactura' => $allFactura]);
			//$this->view('Reportes/Reportes');
		}
		public function getAllPedido() {
			$pedido = new Reporte(); // Instancia un objeto
            $allPedido = $pedido->getPedidos();

            ob_start(); // Recoge todo el contenido de un include.
            //$this->view('Reportes/pedidos',['allPedido' => $allPedido]);
            require_once 'views/modules/Reportes/pedidos.php'; 
            $html = ob_get_clean();

            $mpdf = new \Mpdf\Mpdf();

            $mpdf->WriteHTML($html);

            $mpdf->Output();

			//$this->view('Reportes/pedidos',['allPedido' => $allPedido]);
		}

		public function getAllProducto() {
			$producto = new Reporte(); // Instancia un objeto
            $allProducto = $producto->getProductos();

            ob_start(); // Recoge todo el contenido de un include.
            require_once 'views/modules/Reportes/productos.php'; 
            $html = ob_get_clean();

            $mpdf = new \Mpdf\Mpdf();

            $mpdf->WriteHTML($html);

            $mpdf->Output();

			//$this->view('Reportes/productos',['allProducto' => $allProducto]);
		}

		
		
		public function facturaById() {
			if (isset($_GET["id"])) {
			$factur = new Reporte();
          	$id=$_GET["id"];

          	$factur->setCodigoFactura($id);
          	$factura = $factur->getFacturaId($id);
          	$servicio = $factur->getFacturaServicioById($id);
          	$producto=$factur->getFacturaProductoById($id);

          	 ob_start(); // Recoge todo el contenido de un include.
            require_once 'views/modules/Reportes/Invoice.php'; 
            $html = ob_get_clean();

            $mpdf = new \Mpdf\Mpdf();

            $mpdf->WriteHTML($html);

            $mpdf->Output();
          	
          	/*$this->view('Reportes/Invoice', 
          		['servicio' => $servicio_find,
          		'producto' => $producto_find,
          		'factura' => $factura_find
          	]);*/
			
			}
		}

	}
?>