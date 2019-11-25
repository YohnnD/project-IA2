<?php
	class SeguridadController extends BaseController {
		public function __construct() {
			parent::__construct();
		}

		public function index() {
			$this->view('Seguridad/Seguridad');
		}

		public function bitacora() {
			$this->view('Seguridad/Bitacora');
		}

		public function modules() {
			$this->view('Seguridad/Modulos');
		}

		public function roles() {
		    $rol=new Rol();
		    $permisos=$rol->getPermisos();
		    $modulos=$rol->getModule();
			$this->view('Seguridad/Roles');
		}

		public function permissions() {





			$this->view('Seguridad/Permisos');			

		}

		public function store(){














        }
	}
?>