<?php
	class NotificacionController extends BaseController {
		public function __construct() {
			parent::__construct();
		}

		public function index() {
			$this->view('Notificaciones/Notificaciones');
		}

		public function getAll() {
			
		}

		public function register() {

		}
	}
?>