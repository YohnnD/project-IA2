<?php
	class Rol extends BaseModel {
		// Atributos
        private $idRol;
        private $nombreRol;
        private $descripcionRol;

		// Métodos
		public function __construct() {
			$this->table = 'roles';            
			parent::__construct();
		}

        public function getIdRol() {
            return $this->idRol;
        }

        public function getNombreRol() {
            return $this->nombreRol;
        }

        public function getDescripcionRol() {
            return $this->descripcionRol;
        }

        public function setIdRol($idRol) {
            $this->idRol = $idRol;
        }

        public function setNombreRol($nombreRol) {
            $this->nombreRol = $nombreRol;
        }

        public function setDescripcionRol($descripcionRol) {
            $this->descripcionRol = $descripcionRol;
        }

        public function save() {

        }

        public function update() {

        }

        public function delete() {

        }

        public function getAll() {

        }

        public function getBy() {
            
        }
	}
?>