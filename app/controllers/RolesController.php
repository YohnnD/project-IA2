<?php
	class RolesController extends BaseController {
		public function __construct() {
			parent::__construct();
		}

		public function index() {
			$this->view('Seguridad/Roles');            
		}

		public function create() {
			$this->view('Roles/Roles.Registrar');            
			
		}

		public function getAll() {
			
		}

		public function register() {

		}

		public function update() {

		}

		public function delete() {

        }
        
        public function getBy() {

        }
	}
?>