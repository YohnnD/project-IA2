<?php
	class ReporteController extends BaseController {
		public function __construct() {
            require_once 'vendor/autoload.php';
			parent::__construct();
		}

		public function index() {
			$this->view('Reportes/Reportes');
		}

		public function orders() {
            $mpdf = new \Mpdf\Mpdf();

            $mpdf->WriteHTML('Hello World');

            $mpdf->Output();

        }

		public function products() {

		}

		public function invoices() {
			
		}
	}
?>