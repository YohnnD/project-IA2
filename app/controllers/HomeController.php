<?php
	class HomeController extends BaseController {
		public function __construct() {
			parent::__construct();
		}

		public function index() {
			
			
			$get= new Estadistica();
			$producto=$get->producto();	
			$pedido=$get->pedido();
			$servicio=$get->servicio();
			$cliente=$get->cliente();
			$factura=$get->factura();
			$ingreso=$get->ingreso();

			

			$this->view('Sistema/Home',['producto'=>$producto,
										'pedido'=>$pedido,
										'servicio'=>$servicio,
										'cliente'=>$cliente,
										'factura'=>$factura,
										]);
			 
		}

		public function account() {
			$this->view('Sistema/Profile');
		}

		public function settings() {

		}

		public function getAll() {

			
		}

		public function top_producto(){

		}

	}
?>